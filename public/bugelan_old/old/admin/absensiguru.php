<?php 
include 'navbar.php';

date_default_timezone_set("Asia/Jakarta");

$p = date('M Y');
$n = date('Y-m-d');
$w = date('Y-m-d', strtotime('-1 week'));
$m = date('Y-m-d', strtotime('-1 month'));
$s = date('Y-m-d', strtotime('-6 month'));
$y = date('Y-m-d', strtotime('-1 year'));
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
</style>

<main class="<?= isset($_GET['go']) ? '' : 'col-md-9 ms-sm-auto col-lg-10 px-md-4' ?>">
  <div class="container<?= !isset($_GET['go']) ? '-fluid' : '' ?>">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <?php  if(isset($_GET['go'])){ ?>
      <h3 class="text-danger" id="clock"></h3>
      <div class="btn-toolbar">
        <?php if($_GET['go']<>'no') { ?>
        <a href="?go=no" class="btn btn-outline-secondary btn-sm me-2"><span data-feather="camera-off"></span></a>
        <?php }else{ ?>
        <a href="?go" class="btn btn-outline-secondary btn-sm me-2"><span data-feather="camera"></span></a>
        <?php } ?>
        <a href="logout" class="btn btn-dark btn-sm"><span data-feather="log-out"></span></a>
        <?php }else{ ?>
      <h1 class="h2">Absensi Guru</h1>
      <div class="btn-toolbar">
        <form action="" method="get">
          <select type="submit" name="tgl_awl" class="btn btn-sm btn-outline-secondary me-2" onchange="this.form.submit()">
            <option value="">.. Filter ..</option>
            <option value="<?= $n ?>">Hari ini</option>
            <option value="<?= $w ?>">Pekan ini</option>
            <option value="<?= $m ?>">Bulan ini</option>
            <option value="<?= $s ?>">Semester ini</option>
            <option value="<?= $y ?>">Tahun ini</option>
          </select>
        </form>
        <a href="absensiguru?go" class="btn btn-dark btn-sm">Memulai</a>
        <?php } ?>
      </div>
    </div>
  <?php
  if(isset($_GET['tgl_awl'])){
  $awl=$_GET['tgl_awl'];
  ?>
    <div class="btn-group float-end mb-2">
      <a class="btn btn-sm btn-outline-primary" href="absensiguru_laphis?tgl_awal=<?= $awl ?>&tgl_ahir=<?= $n ?>" target="_blank" style="text-decoration:none">Rekap</a>
      <a class="btn btn-sm btn-outline-primary" href="absensiguru_lapsum" target="_blank" style="text-decoration:none">Index</a>
      <a class="btn btn-sm btn-primary"><span data-feather="printer"></span></a>
    </div><br/>
  <?php } ?>
  </div>
  
  <?php  if(isset($_SESSION['flashin'])){ ?>
  <script>
    swal({
      title: "<?= $_SESSION['flashin']['pesan'] ?>",
      text: "<?= $_SESSION['flashin']['ket'] ?>",
      type: "<?= $_SESSION['flashin']['tipe'] ?>",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false
      <?php unset($_SESSION['flashin']); ?>
    });
      var shutter = new Audio();
      shutter.autoplay = true;
      shutter.src = '../assets/audio/beep.mp3';
  </script>
  <?php } ?>

  <div class="container <?= !isset($_GET['go']) ? 'd-none' : '' ?>">
    <h3 class="text-center">Absensi Guru</h3>
    <div id="qr-reader" style="width:100%"></div>
    <div class="bd-heading align-self-start my-3">
      <form class="row g-2" action="absensiguru_act?tambah=<?= $_GET['go'] ?>" method="post">
        <div class="col-md-3">
          <label for="nisn" class="form-label">No. Induk</label>
          <div class="input-group">
            <input type="text" class="btn btn-dark" name="nisn" id="submiter" onfocus="this.form.submit()" style="max-width:15%;" value="»">
            <input type="text" class="form-control" name="nisn" id="qr-reader-results" oninput="this.form.submit()" autofocus="on">
          </div>
        </div>
        <div class="col-md-3">
          <label for="sesi" class="form-label">Sesi</label>
          <input type="text" class="form-control" name="sesi" value="08:00:00" required>
        </div>
        <div class="col-md-6">
          <label for="ket" class="form-label">Keterangan</label>
          <div class="input-group">
            <select type="text" class="form-select" name="ket" id="ket" onchange="focus_ket()">
              <option value=""></option>
              <option value="i">Izin</option>
              <option value="s">Sakit</option>
              <option value="a">Alpa</option>
            </select>
            <input type="text" class="form-control" name="note" id="note">
          </div>
        </div>
      </form>
    </div>
  </div>

  </br>
  <div class="container<?= !isset($_GET['go']) ? '-fluid' : '' ?>">
  <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col" class="d-none d-md-table-cell">Tanggal</th>
            <th scope="col">Jam</th>
            <th scope="col" class="d-none d-md-table-cell">No. Induk</th>
            <th scope="col">nama</th>
            <th scope="col" class="d-none d-md-table-cell">Terlambat</th>
            <th scope="col" class="d-none d-md-table-cell">Ket</th>
            <th scope="col" class="d-none d-md-table-cell">Note</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            if(isset($_GET['tgl_awl'])){
              $tgl=$_GET['tgl_awl'];
              $query="SELECT * from absenguru where date between '$tgl' and '$n' order by date desc, time desc";
            }else{
              $query="SELECT * from absenguru order by date desc, time desc";
            }
            $absen=mysqli_query($GLOBALS["___mysqli_ston"], $query);
            $no=1;
            while($a=mysqli_fetch_array($absen)){
            ?>
            <td class="d-none d-md-table-cell"><?= $a['date'] ?></td>
            <td><?= $a['time'] == '00:00:00' ? '' : $a['time'] ?></td>
            <td class="d-none d-md-table-cell"><?= $a['nisn'] ?></td>
            <td><?= $a['name'] ?></td>
            <td class="d-none d-md-table-cell"><?= $a['late'] == '00:00:00' ? '' : $a['late'] ?></td>
            <td class="d-none d-md-table-cell"><?= $a['ket'] ?></td>
            <td class="d-none d-md-table-cell"><?= $a['note'] ?></td>
            <td class="text-end">
            <a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-<?= $a['id'] ?>"><span data-feather="eye"></span></a>
            <button class="btn btn-sm btn-danger <?= isset($_GET['go']) || $u['access'] == 'User' ? 'd-none' : '' ?> delete-<?= $a['id']; ?>"><span data-feather="trash-2"></span></button>
              <script>
                document.querySelector('.delete-<?= $a['id']; ?>').onclick = function(){
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
                    location.href="absensiguru_act?hapus=<?= $a['id']; ?>";
                  });
                };
              </script>
            </td>
          </tr>
					<!-- Modal View Data-->
					<div class="modal fade" id="modal-<?= $a['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
						<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="modalLabel">Data Absensi</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
							<form>
								<div class="text-center">
								<?php if(file_exists("../public/foto/" . $a['id_guru'] . ".jpg")){?>
								<img class="img-responsive w-50 rounded-3" id="preview" src="../public/foto/<?= $a['id_guru'] ?>.jpg">
								<?php }else{ ?>
								<img class="img-responsive w-50 rounded-3" id="preview" src="../public/foto/no.png">
								<?php } ?>
								</div>
								<div class="my-2">
								<label class="form-label" for="kode">Nama</label>
								<input type="text" class="form-control form-control" id="kd" value="<?= $a['name'] ?>" disabled>
								</div>
								<div class="mb-2">
								<label class="form-label" for="des">NISN</label>
								<input type="textarea" class="form-control form-control" name="des" value="<?= $a['nisn'] ?>" disabled>
								</div>
								<div class="mb-2">
								<label class="form-label" for="des">Absensi</label>
								<input type="textarea" class="form-control form-control" name="des" value="<?= $a['date'] .' '. $a['time'] ?>" disabled>
								</div>
								<div class="mb-2">
								<label class="form-label" for="des">Keterlambatan</label>
								<input type="textarea" class="form-control form-control" name="des" value="<?= $a['late'] ?>" disabled>
								</div>
								<div class="mb-2">
								<label class="form-label" for="des">Ketidakhadiran</label>
                <div class="input-group">
								<input type="textarea" class="form-control form-control" name="des" value="<?= $a['ket'] ?>" disabled>
								<input type="textarea" class="form-control form-control" name="des" value="<?= $a['note'] ?>" disabled>
                </div>
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
  </div>
</main>

<?php if(isset($_GET['go']) && $_GET['go']<>'no') { ?>
<script type="text/javascript" src="../assets/js/html5-qrcode.min.js"></script>
<?php } ?>

<!-- <script type="text/javascript" src="../assets/js/main.js"></script> -->
<script type="text/javascript">   
    function focus_ket(){
      document.getElementById('note').focus();
    }
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
    
    feather.replace({ 'aria-hidden': 'true' });

    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                document.getElementById('qr-reader-results').value=lastResult;

                document.getElementById('submiter').focus();
              }
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
          "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>