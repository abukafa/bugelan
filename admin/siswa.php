<?php 
include 'navbar.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data Siswa</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <a href="siswa_add.php"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="plus-circle"></span>
          Tambah Baru
        </button></a>
        </div>
        <form action="" method="get">
          <select type="submit" name="kls" class="btn btn-sm btn-outline-secondary" onchange="this.form.submit()">
            <option value="">.. Filter ..</option>
            <option value="2019">Kelas 7</option>
            <option value="2020">Kelas 8</option>
            <option value="2021">Kelas 9</option>
          </select>
        </form>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">NISN</th>
            <th scope="col">Nama</th>
            <th scope="col">JK</th>
            <th scope="col">Kelas</th>
            <th scope="col">Tempat Tanggal Lahir</th>
            <th scope="col">Nama Ayah</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            $siswa=mysqli_query($GLOBALS["___mysqli_ston"], "select * from siswa order by tahun, jk, nama");
            $no=1;
            while($s=mysqli_fetch_array($siswa)){
            ?>
            <td><?= $no ?></td>
            <td><?= $s['nisn'] ?></td>
            <td><?= $s['nama'] ?></td>
            <td><?= $s['jk'] ?></td>
            <td><?= date('Y')-$s['tahun']+6 ?></td>
            <td><?= $s['tempat_lahir'] . ', ' . date_format(date_create($s['tanggal_lahir']), "d M Y") ?></td>
            <td><?= $s['nama_ayah'] ?></td>
            <td align="right">    
              <a href="siswa_edt.php?nisn=<?php echo $s['nisn'] ?>" class="btn btn-sm btn-secondary"><span data-feather="edit"></span></a>
              <a href="siswa_lprt.php?nisn=<?php echo $s['nisn'] ?>" target="_blank" class="btn btn-sm btn-secondary"><span data-feather="printer"></span></a>
            </td>
          </tr>
          <?php
          $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<script type="text/javascript">
  feather.replace({ 'aria-hidden': 'true' })
</script>