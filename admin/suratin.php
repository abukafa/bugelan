<?php 
include 'navbar.php';

$uname = $_SESSION['uname'];
$admin = mysqli_query($GLOBALS["___mysqli_ston"], "select * from admin where uname='$uname'");
while($u=mysqli_fetch_array($admin)){
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Surat Masuk</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive"><span data-feather="plus-circle"></span>
            Buat Baru
          </button>
        </div>
        <div class="btn-group me-2">
          <a  href="surat"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="send"></span>
            Surat Keluar
          </button></a>
        </div>
      </div>
    </div>
    <?php flash() ?>
    
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th class="d-none d-sm-table-cell">Pengirim</th>
            <th>No</th>
            <th class="d-none d-md-table-cell">Lamp</th>
            <th class="d-none d-lg-table-cell">Perihal</th>
            <th class="d-none d-lg-table-cell">Keterangan</th>
            <th class="d-none d-xl-table-cell">File</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php 
          $no=1;
          $surat=mysqli_query($GLOBALS["___mysqli_ston"], "select * from letterin order by id");
          while($a=mysqli_fetch_array($surat)){
          ?>
            <td class="d-none d-sm-table-cell"><?php echo $a['sip'] ?></td>
            <td><?php echo $a['no'] ?></td>
            <td class="d-none d-md-table-cell"><?php echo $a['lamp'] ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $a['hal'] ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $a['ket'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $a['file'] ?></td>
            <td align="right">
              <!-- float-md-end -->
              <a type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $a['id']; ?>"><span data-feather="edit"></span></a>
              <a href="../public/surat/<?php echo $a['file'] ?>" type="button" class="btn btn-primary btn-sm" target="_blank"><span data-feather="eye"></span></a>
              <?php
              if ($u['access']=="Programmer" or $u['access']=="Manager"){
              ?>
              <!-- <a onclick="if(confirm('Apakah anda yakin akan menghapus data dengan Kode : <?php echo $a['id']; ?> ??')){ location.href='suratin_del?id=<?= $a['id']; ?>&file=<?= $a['file']; ?>' }" class="d-none d-xl-inline-block btn btn-sm btn-secondary"><span data-feather="trash-2"></span></a> -->
              <button class="btn btn-sm btn-danger delete-<?php echo $a['id']; ?>"><span data-feather="trash-2"></span></button></button>
              <script>
                document.querySelector('.delete-<?php echo $a['id']; ?>').onclick = function(){
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
                  location.href="suratin_act?hapus=<?php echo $a['id']; ?>&file=<?= $a['file']; ?>";
                });
                };
              </script>
              <?php
              } 
              ?>
            </td>
          </tr>

          <!-- Modal Edit Data-->
          <div class="modal fade" id="edit<?php echo $a['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLiveLabel">Edit Data Surat Masuk</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <form role="form" action="suratin_act?ubah" method="post" enctype="multipart/form-data">
                    <?php

                    ?>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="eno">Nomor</label>
                      <input type="hidden" name="eid" id="eid" value="<?php echo $a['id']; ?>">
                      <input type="text" class="form-control form-control-sm" name="eno" id="eno" value="<?php echo $a['no']; ?>">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="efrom">Pengirim</label>
                      <input type="text" class="form-control form-control-sm" name="efrom" id="efrom" value="<?php echo $a['sip']; ?>">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="ehal">Perihal</label>
                      <input type="text" class="form-control form-control-sm" name="ehal" id="ehal" value="<?php echo $a['hal']; ?>">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="elamp">Lampiran</label> 
                      <input type="text" class="form-control form-control-sm" name="elamp" id="elamp" value="<?php echo $a['lamp']; ?>">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="efile">Berkas</label>
                      <br><img src="../public/surat/<?php echo $a['file']; ?>" width="100%" id="img-preview"><br>
                      <input type="hidden" name="eold" id="eold" value="<?php echo $a['file']; ?>">
                      <input type="file" class="form-control form-control-sm" name="efile" id="efile" accept=".jpg" onchange="previewImg()">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="eket">Keterangan</label>
                      <input type="textarea" class="form-control form-control-sm" name="eket" value="<?php echo $a['ket']; ?>">
                    </div>
                    <div class="modal-footer">  
                      <button type="submit" class="btn btn-primary btn-sm">Save</button>
                      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>           

          <?php
          $no++;
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Modal Entri Data-->
    <div class="modal fade" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLiveLabel">Input Data Surat Masuk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form role="form" action="suratin_act?tambah" method="post" enctype="multipart/form-data">
              <?php

              ?>
              <div class="mb-2">
                <label class="form-label fw-bold" for="no">Nomor</label>
                <input type="text" class="form-control form-control-sm" name="no" id="no" required>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="from">Pengirim</label>
                <input type="text" class="form-control form-control-sm" name="from" id="from" required>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="hal">Perihal</label>
                <input type="text" class="form-control form-control-sm" name="hal" id="hal" required>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="lamp">Lampiran</label> 
                <input type="text" class="form-control form-control-sm" name="lamp" id="lamp" required>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="file">Berkas</label>
                <br><img width="100%" class="preview"><br>
                <input type="file" class="form-control form-control-sm" name="file" id="file" accept=".jpg" onchange="preview()" required>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="ket">Keterangan</label>
                <input type="textarea" class="form-control form-control-sm" name="ket">
              </div>
              <div class="modal-footer">  
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>    
  </div>
  </main>
<?php
} 
?>

<script type="text/javascript">
    feather.replace({ 'aria-hidden': 'true' })
    function preview(){
      const img = document.querySelector('#file');
      const preview = document.querySelector('.preview');

      preview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(img.files[0]);

      oFReader.onload = function(oFREvent){
        preview.src = oFREvent.target.result;
      }
    }
    function previewImg(){
      const img = document.querySelector('#efile');
      const preview = document.querySelector('#img-preview');

      preview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(img.files[0]);

      oFReader.onload = function(oFREvent){
        preview.src = oFREvent.target.result;
      }
    }
</script>