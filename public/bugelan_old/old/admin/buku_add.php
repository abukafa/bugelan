<?php 
include 'navbar.php';

flash();

?>

<link href="../assets/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap-datepicker.min.js"></script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Transaksi</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <a  href="buku"><button type="button" class="btn btn-sm btn-outline-secondary">
          <span data-feather="arrow-left"></span>
          Kembali
        </button></a>
      </div>
    </div>

    <div class="bd-heading align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
      <form class="row g-2" action="buku_act?tambah" method="post">
        <div class="col-md-2">
          <label for="inv" class="form-label">Invoice</label>
          <input type="text" class="form-control" name="inv" id="inv" value="<?php echo $_GET['inv']; ?>" readonly="yes">
        </div>
        <div class="col-md-2">
          <label for="tgl" class="form-label">Tanggal</label>
          <input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo $_GET['tgl']; ?>" required>
        </div>
        <div class="col-md-2">
          <label for="akun" class="form-label">Akun</label>
          <select type="text" class="form-select" name="akun" id="akun" onchange="getAkun(this.value)" required>
            <option value="-">.. pilih ..</option>
            <?php 
            $akun=mysqli_query($conn, "select * from account order by code");
            $jsArray = "var acc = new Array();\n";        
            while($c=mysqli_fetch_array($akun)){
            echo '<option value="' . $c['code'] . '">' . $c['code'] ." - ". $c['name'] . '</option>';
            $jsArray .= "acc['" . $c['code'] . "'] = {name:'" . addslashes($c['name']) . "',unit:'".addslashes($c['unit']) . "'};\n";
            }
            ?>
          </select>
        </div>
        <div class="col-md-2">
          <label for="vend" class="form-label">Vendor</label>
          <input class="form-control" name="vend" id="vend" value="<?php echo $_GET['vend']; ?>" required>
          <select class="form-select d-none" id="guru" onchange="namaGuru(this.value)">
            <option value="">.. pilih ..</option>
            <?php 
            $guru=myquery("SELECT nama FROM guru ORDER BY nama");
            foreach($guru as $gr) :
              echo '<option>'. $gr['nama'] .'</option>';
            endforeach;
            ?>
          </select>
        </div>
        <div class="col-md-4">
          <label for="ket" class="form-label">Keterangan</label>
          <input type="text" class="form-control" name="ket" id="ket" value="<?php echo $_GET['ket']; ?>" required>
        </div>
        <div class="col-md-6">
          <label for="des" class="form-label">Deskripsi</label>
          <input type="text" class="form-control" name="des" required>
        </div>
        <div class="col-md-2">
          <label for="jum" class="form-label">Jumlah</label>
          <input type="text" class="form-control" name="jum" required>
        </div>
        <div class="col-md-4">
        <?php 
        $inv=$_GET['inv'];
        $query=mysqli_query($conn, "select sum(debit) as dbt, sum(credit) as kdt from finance where inv='$inv' ");
        while($t=mysqli_fetch_assoc($query)){
        $total = $t['dbt'] - $t['kdt'];
        ?>
        
        <label for="tot" class="form-label">Total</label>
        <input type="text" class="form-control" id="tot" value="<?php echo number_format($total,0,'',','); ?>" readonly="yes">
        
        <?php   
        }
        ?>
        </div>
        <div class="col-12 mt-3">
          <input type="submit" class="btn btn-primary btn-sm" value="Simpan" onclick="makeReadonly()"></button>
          <a href="buku" type="button" class="btn btn-secondary btn-sm">Selesai</a>
        </div>
      </form>
    </div>
  </div>
  
<div class="container-fluid">
  <?php
    $jum=mysqli_query($conn, "SELECT * from finance where inv='$inv' ");
    $jum=mysqli_num_rows($jum); 
    echo "<h6 class='fw-bold pt-3 pt-xl-5 pb-2 pb-xl-3'><a style='color:blue'>". $jum ." item</a></h6>";
  ?>
  <table class="table ">
    <tr>
      <th class="d-none d-md-table-cell">Tanggal</th>
      <th>Vendor</th>
      <th>Akun</th>
      <th class="d-none d-lg-table-cell">Uraian</th>       
      <th class="text-end">Jumlah</th>
      <th class="text-end">Opsi</th>
    </tr>
    <?php 
    if(isset($_GET['inv'])){
      $inv=mysqli_real_escape_string($conn, $_GET['inv']);
      $brg=mysqli_query($conn, "select * from finance where inv='$inv' order by id desc");
    }else{
      $brg=mysqli_query($conn, "select * from finance order by id desc");
    }
    $no=1;
    while($b=mysqli_fetch_array($brg)){

      ?>
      <tr>
        <td class="d-none d-md-table-cell"><?php echo $b['date'] ?></td>
        <td><?php echo $b['vendor'] ?></td> 
        <td><?php echo $b['account'] ?></td>
        <td class="d-none d-lg-table-cell"><?php echo $b['des'] ?></td>   
        <td class="text-end"><?php echo number_format($b['credit'] - $b['debit'],0,'',','); ?></td>
        <td class="text-end"> 
          <a href="#" type="button" class="btn btn-secondary btn-sm <?= $u['access']=='User' ? 'd-none' : '' ?>" data-bs-toggle="modal" data-bs-target="#edit<?php echo $b['id']; ?>"><span data-feather="edit"></span></a>
          <?php
          if ($u['access']=="Programmer" or $u['access']=="Manager"){
          ?>
          <button class="btn btn-sm btn-danger delete-<?php echo $b['id']; ?>"><span data-feather="trash-2"></span></button></button>
              <script>
                document.querySelector('.delete-<?php echo $b['id']; ?>').onclick = function(){
                swal({
                  title: "Yakin?",
                  text: "Data tidak bisa dikembalikan!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Delete",
                  closeOnConfirm: false
                },
                function(){
                  location.href="buku_act?hapus=<?php echo $b['id']; ?>";
                });
                };
              </script>
          <?php
          } 
          ?>
        </td>
      </tr>
      <?php 
    $no=$no+1;
    ?>

    <!-- Modal Edit Data-->
    <div class="modal fade" id="edit<?php echo $b['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <?php
            $id=$b['id'];
            $query_edit = mysqli_query($conn, "SELECT * FROM finance WHERE id='$id'");
            while ($row = mysqli_fetch_array($query_edit)) {  
            ?>
            <h5 class="modal-title" id="staticBackdropLiveLabel">Edit Transaksi <?php echo $row['id']; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form role="form" action="buku_act?ubah" method="post">
              <div class="mb-2">
                <label class="form-label">Invoice</label>
                <input type="hidden" class="form-control form-control-sm" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" class="form-control form-control-sm" name="inv" value="<?php echo $row['inv']; ?>" readonly="yes">
              </div>
              <div class="mb-2">
                <label class="form-label" >Tanggal</label> 
                <input type="text" class="form-control form-control-sm" name="tgl" id="tgl2" value="<?php echo $row['date']; ?>">
              </div>
              <div class="mb-2">
                <label class="form-label" >Vendor</label>
                <input type="text" class="form-control form-control-sm" name="vend" value="<?php echo $row['vendor']; ?>">
              </div>
              <div class="mb-2">
                <label class="form-label" >Keterangan</label>
                <input type="text" class="form-control form-control-sm" name="ket" value="<?php echo $row['remark']; ?>">
              </div>
              <div class="mb-2">
                <label class="form-label">Akun</label> 
                <select type="text" class="form-select form-select-sm" name="akun">
                  <option value="<?php echo $row['account']; ?>"><?php echo $row['account']; ?></option>
                  <?php 
                  $akun=mysqli_query($conn, "select * from account order by code");
                  $jsArray = "var acc = new Array();\n";        
                  while($c=mysqli_fetch_array($akun)){
                  echo '<option value="' . $c['code'] . '">' . $c['code'] ." - ". $c['name'] . '</option>';
                  $jsArray .= "acc['" . $c['code'] . "'] = {name:'" . addslashes($c['name']) . "',unit:'".addslashes($c['unit']) . "'};\n";
                  }
                  ?>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Deskripsi</label>
                <input type="textarea" class="form-control form-control-sm" name="des" value="<?php echo $row['des']; ?>">
              </div>
              <div class="mb-2">
                <label class="form-label">Jumlah</label> 
                <input type="text" class="form-control form-control-sm" name="jum" value="<?php echo $row['debit']+$row['credit']; ?>">
              </div>
              <div class="mb-2">
                <label class="form-label">Admin</label>
                <input type="textarea" class="form-control form-control-sm" name="adm" value="<?php echo $row['admin']; ?>" readonly="yes">
              </div>
              <div class="modal-footer">  
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
              </div>
            </form>
          </div>
        </div>    
      </div>
    </div>

    <?php 
    }
    }
    ?>
  </table>
</div>

  <script type="text/javascript">
    $(function() {
        $('#tgl').datepicker({ 
          autoclose: true,
          todayHighlight: true,
          format : 'yyyy-mm-dd' 
        });
      });

    $(function() {
        $('#tgl2').datepicker({ 
          autoclose: true,
          todayHighlight: true,
          format : 'yyyy-mm-dd' 
        });
      });

    function makeReadonly() {
      $('#tgl').attr('readonly', true);
      $('#vend').attr('readonly', true);
      $('#ket').attr('readonly', true);
    }
  </script>
</main>

<script type="text/javascript">
    feather.replace({ 'aria-hidden': 'true' });
    function getAkun(akun){
      if(akun == 44000){
        document.getElementById('vend').className='form-control d-none';
        document.getElementById('guru').className='form-select d-block';
        document.getElementById('guru').focus();
      }else{
        document.getElementById('guru').className='form-select d-none';
        document.getElementById('vend').className='form-control d-block';
        document.getElementById('vend').value='';
        document.getElementById('vend').focus();
      }
    }
    function namaGuru(guru){
      document.getElementById('vend').value=guru;
      document.getElementById('ket').focus();
    }
</script>