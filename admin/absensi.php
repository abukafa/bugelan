<?php 
include 'navbar.php';

$p = date('M Y');
$n = date('Y-m-d');
$w = date('Y-m-d', strtotime('-1 week'));
$m = date('Y-m-d', strtotime('-1 month'));
$s = date('Y-m-d', strtotime('-6 month'));
$y = date('Y-m-d', strtotime('-1 year'));

if(isset($_GET['pesan'])){
  if($_GET['pesan'] == "gagal"){
    echo "<script>alert('NISN Tidak ditemukan..! Coba lagi..');</script>";
  }
}
?>

<style>
#webcodecam-canvas, #scanned-img {
    background-color: #2d2d2d;
}
#camera-select {
    display: inline-block;
    width: auto;
}
.well {
    position: relative;
    display: inline-block;
}
.panel-heading {
    display: inline-block;
    width: 100%;
}
pre {
    border: 0;
    border-radius: 0;
    background-color: #333;
    margin: 0;
    line-height: 125%;
    color: whitesmoke;
}
#webcodecam-canvas {
    background-color: #272822;
}
#scanned-QR{
    word-break: break-word;
}
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Absensi</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
      <a class="btn btn-outline-secondary btn-sm" id="cam-on" onclick=camon()><span data-feather="camera"></span></a>
      <div class="btn-group me-2">
        <a class="btn btn-outline-secondary btn-sm" style="display:none" id="cam-of" onclick=camof()><span data-feather="camera-off"></span></a>
        <a title="Stop streams" class="btn btn-outline-secondary btn-sm" style="display:none" id="stop"><span data-feather="pause"></span></a>
        <a title="Play" class="btn btn-outline-secondary btn-sm" style="display:none" id="play" onclick=focus()><span data-feather="play"></span></a>
      </div>
        <form action="" method="get">
          <select type="submit" name="tgl_awl" class="btn btn-sm btn-outline-secondary" onchange="this.form.submit()">
            <option value="">.. Filter ..</option>
            <option value="<?php echo $n ?>">Hari ini</option>
            <option value="<?php echo $w ?>">Pekan ini</option>
            <option value="<?php echo $m ?>">Bulan ini</option>
            <option value="<?php echo $s ?>">Semester ini</option>
            <option value="<?php echo $y ?>">Tahun ini</option>
          </select>
        </form>
      </div>
    </div>
  </div>
  
  <div class="container" id="QR-Code" style="display:none">
    <div class="navbar-form navbar-right" style="display: none;">
      <select class="form-control" id="camera-select"></select>
      <div class="form-group">
        <input id="image-url" type="text" class="form-control" placeholder="Image url">
        <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"></button>
        <button title="Image shoot" class="btn btn-info btn-sm" id="grab-img" type="button" data-toggle="tooltip"></button>
        <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"></button>
      </div>
    </div>
    <div class="panel-body text-center">
      <div class="col-md-12">
        <div class="well" style="position: relative;display: inline-block;">
        <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
        <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
        <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
        <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
        <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
      </div>
    <div class="caption">
      <!-- <button title="Stop streams" class="btn btn-danger btn-sm" id="stop"><span data-feather="pause"></span></button> -->
      <!-- <button title="Play" class="btn btn-success btn-sm" id="play"><span data-feather="play"></span></button><br> -->
      <!-- <label id="scanned-QR" onchange="this.form.submit()">QR-Code</label> -->
    </div>
    </div>
      <div class="col-md-12" style="display: none;">
        <div class="thumbnail" id="result">
          <div class="well" style="overflow: hidden;">
            <img width="320" height="240" id="scanned-img" src="">
          </div>
        </div>
      </div>
    </div>
  </div>      
  <br>

  <script>
    var oof = document.getElementById('cam-of');
    var oon = document.getElementById("cam-on");
    var ply = document.getElementById('play');
    var stp = document.getElementById("stop");
    var con = document.getElementById("QR-Code")
    function camof(){
      oof.style.display = "none";
      oon.style.display = "block";
      ply.style.display = "none";
      stp.style.display = "none";
      con.style.display = "none";
    }
    function camon(){
      oof.style.display = "block";
      oon.style.display = "none";
      ply.style.display = "block";
      stp.style.display = "block";
      con.style.display = "block";
    }
  </script>

  <div class="container-fluid">
    <div class="bd-heading align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
      <form class="row g-2" action="absensi_act" method="post">
        <div class="col-md-3">
          <label for="nisn" class="form-label">NISN</label>
          <textarea type="text" class="form-control" name="nisn" id="scanned-QR" autofocus oninput="this.form.submit()">
          </textarea>
          <script>
            function focus(){
              document.getElementById('scanned-QR').focus();
            }
          </script>
        </div>
        <div class="col-md-3">
          <label for="sesi" class="form-label">Sesi</label>
          <input type="text" class="form-control" name="sesi" value="1" required>
        </div>
        <div class="col-md-6">
          <label for="ket" class="form-label">Keterangan</label>
          <input type="text" class="form-control" name="ket" value="-" required>
        </div>
      </form>
    </div>
  </div>
  <br>
  <center>
  <h3 id="clock"></h3>
  </center>
  <br>
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Jam</th>
            <th scope="col">nisn</th>
            <th scope="col" class="d-none d-md-table-cell">nama</th>
            <th scope="col" class="d-none d-md-table-cell">Sesi</th>
            <th scope="col" class="d-none d-md-table-cell">Ket</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            $absen=mysqli_query($GLOBALS["___mysqli_ston"], "select * from absen order by date, time desc");
            $no=1;
            while($a=mysqli_fetch_array($absen)){
            ?>
            <td><?= $a['date'] ?></td>
            <td><?= $a['time'] ?></td>
            <td><?= $a['nisn'] ?></td>
            <td class="d-none d-md-table-cell"><?= $a['name'] ?></td>
            <td class="d-none d-md-table-cell"><?= $a['session'] ?></td>
            <td class="d-none d-md-table-cell"><?= $a['note'] ?></td>
            <th>
            <a onclick="if(confirm('Hapus data : <?= $a['name'] ?> [<?php echo $a['id']; ?>] <?= $a['time'] ?> ??')){ location.href='absensi_del?id=<?php echo $a['id']; ?>' }" class="btn btn-sm btn-secondary float-md-end"><span data-feather="trash-2"></span></a>
            </th>
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

<script type="text/javascript" src="../assets/js/qrcodelib.js"></script>
<script type="text/javascript" src="../assets/js/webcodecamjs.js"></script>
<script type="text/javascript" src="../assets/js/main.js"></script>
<script type="text/javascript">   
    function zeroPad(num, plc){
      var z = plc - num.toString().length + 1;
      return Array(+(z > 0 && z)).join("0") + num;
    }
    var clockElement = document.getElementById('clock');

    function clock() {
        var today = new Date();
        var date = today.getFullYear()+'-'+zeroPad((today.getMonth()+1), 2)+'-'+zeroPad(today.getDate(), 2)+' '+zeroPad(today.getHours(), 2) + ":" + zeroPad(today.getMinutes(), 2) + ":" + zeroPad(today.getSeconds(), 2);

        // Replace '400px' below with where you want the format to change.
        if (window.matchMedia('(max-width: 400px)').matches) {
            // Use this format for windows with a width up to the value above.
            clockElement.textContent = date.toLocaleString();
        } else {
            // While this format will be used for larger windows.
            clockElement.textContent = date.toString();
        }
    }

    setInterval(clock, 1000);
    
    feather.replace({ 'aria-hidden': 'true' })
</script>