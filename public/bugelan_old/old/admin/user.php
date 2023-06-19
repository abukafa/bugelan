<?php 
include 'navbar.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data Pengguna</h1>
      <?php
      if ($u['access']=="Programmer" or $u['access']=="Manager"){
      ?>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive"><span data-feather="user-plus"></span>
          Pengguna Baru
        </button>
      </div>
      <?php
      } 
      ?>
    </div>
    <?php flash(); ?>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col" class="d-none d-md-table-cell">Name</th>
            <th scope="col">Access</th>
            <th scope="col" class="d-none d-md-table-cell">Remark</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php 
          $admin=mysqli_query($GLOBALS["___mysqli_ston"], "select * from admin order by id");
          $no=1;
          while($a=mysqli_fetch_array($admin)){
            $no = sprintf('%04d', $a['id']) ;
          ?>
            <td><?php echo $no ?></td>
            <td><?php echo $a['uname'] ?></td>
            <td class="d-none d-md-table-cell"><?php echo $a['name'] ?></td>
            <td><?php echo $a['access'] ?></td>
            <td class="d-none d-md-table-cell"><?php echo $a['remark'] ?></td>
            <td>
              <?php
              if ($u['access']=="Programmer" or $u['access']=="Manager"){
              ?>
              <button class="btn btn-sm btn-danger float-end delete-<?php echo $a['id']; ?>" <?php if($a['access']=="Programmer"){echo "disabled";} ?>><span data-feather="trash-2"></span></button></button>
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
                  location.href="user_act?hapus=<?php echo $a['id']; ?>";
                });
                };
              </script>
              <?php
              }
              ?>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>


		<article class="pb-2 mb-3 <?= $u['access'] == "Programmer" ? "d-block" : "d-none" ?>">
			<!-- Menu mysql -->
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
			<h1 class="h2 mb-3">Edit Database</h1>
			</div>
			<div>
			<div class="accordion" id="accordionExample">
				<div class="accordion-item">
				<h4 class="accordion-header" id="headingOne">
					<button class="accordion-button <?= isset($_GET['userSQL']) ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					<b>User SQL Query</b>
					</button>
				</h4>
				<div id="collapseOne" class="accordion-collapse collapse <?= isset($_GET['userSQL']) ? 'show' : '' ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
					<div class="accordion-body">
					<form action="user_act.php?userSQL=edit" method="post">
						<div class="row">
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Aksi</label>
								<select type="text" class="form-select" id="opsi" onchange="generateQuery()">
									<option>Update</option>
									<option>Delete</option>
								</select>
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Tabel</label>
								<select name="tabel" id="tabel" class="form-select" onchange="generateQuery()">
								<option>.. pilih ..</option>
                  <?php
                  $tables = myquery("SHOW TABLES");
                  foreach($tables as $table) :
                    echo "<option>". $table['Tables_in_buge5123_bugelan'] ."</option>";
                  endforeach
                  ?>
								</select>
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Kolom</label>
								<select id="kolom" class="form-select" onchange="generateQuery()">
									<option>.. pilih ..</option>
								</select>
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Data Baru</label>
								<input id="newValue" type="text" class="form-control" onkeyup="generateQuery()">
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Konsidi</label>
								<select id="kondisi" class="form-select" onchange="setKondisi(this.value)">
									<option>.. pilih ..</option>
								</select>
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Data Lama</label>
								<input id="oldValue" type="text" class="form-control" onkeyup="setKondisi(this.value)">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12">
								<div class="input-group">
									<input type="text" class="form-control" name="query" id="query"  autocomplete="off">
									<button type="submit" id="io_submit" class="btn btn-primary float-md-end">
									<span data-feather="save" class="feather-15"></span>
									</button>
									<button type="reset" id="refresh" class="btn btn-primary float-md-end" data-bs-dismiss="modal">
									<span data-feather="refresh-cw" class="feather-15"></span>
									</button>
								</div>
							</div>
						</div>
					</form>
					<br>
					<?php flash(); ?>
					</div>
				</div>
				</div>
				<div class="accordion-item">
				<h4 class="accordion-header" id="headingOne">
					<button class="accordion-button <?= isset($_GET['userSQL']) ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<b>Overview</b>
					</button>
				</h4>
				<div id="collapseTwo" class="accordion-collapse collapse <?= isset($_GET['userSQL']) ? 'show' : '' ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
					<div class="accordion-body overflow-auto">
					<table class="table table-striped table-bordered">
						<tr class="text-center">
						<?php
						$tables = myquery("SHOW TABLES");
						$jum = myNumRow("SHOW TABLES");
						foreach($tables as $table) :
						echo "<td class='align-content-center'>". $table['Tables_in_buge5123_bugelan'] ."</td>";
						endforeach;
						// var_dump($tables);
						echo "</tr><tr class='text-center'>";
						for($i=0; $i<$jum; $i++){
						$tab = $tables[$i]['Tables_in_buge5123_bugelan'];
						$tabRows = myNumRow("SELECT * FROM ". $tab);
						echo "<td>" . $tabRows . "</td>";
						}
						?>
						</tr>
					</table>
					</div>
				</div>
				</div>
			</div>
		</article>

    <!-- Modal Entri Data-->
    <div class="modal fade" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLiveLabel">Tambah Pengguna Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form role="form" action="user_act?tambah" method="post">
              <div class="mb-2">
                <label class="form-label" for="uname">Username</label>
                <input type="text" class="form-control form-control-sm" name="uname" required>
              </div>
              <div class="mb-2">
                <label class="form-label" for="name">Nama Lengkap</label>
                <select type="text" class="form-select form-select-sm" name="name" required>
                  <option value="">.. pilih ..</option>
                  <?php 
                  $guru=myquery("SELECT nama FROM guru ORDER BY nama");
                  foreach($guru as $gr) :
                    echo '<option>'. $gr['nama'] .'</option>';
                  endforeach;
                  ?>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label" for="pass">Password</label> 
                <input type="password" class="form-control form-control-sm" name="pass" id="pass" placeholder="Ketik Password .." required>
              </div>
              <div class="mb-2">
                <input type="password" class="form-control form-control-sm" name="repass" id="repass" placeholder="Ulangi password .." onkeyup="changeFunction()">
                <div class="invalid-feedback">Password tidak sama ..</div>
                <div class="valid-feedback">Password Sesuai ..</div>
              </div>
              <script>    
                function changeFunction(){  
                var pas = document.getElementById('pass');
                var rpas = document.getElementById('repass');
                  if (rpas.value !== pas.value){
                    rpas.className = "form-control form-control-sm is-invalid";
                  }else if (rpas.value == pas.value){
                    rpas.className = "form-control form-control-sm is-valid";
                  }
                };  
              </script>
              <div class="mb-2">
                <label class="form-label" for="akses">Akses</label>   
                <select class="form-select form-select-sm" name="akses" required>
                  <option value="-">.. pilih ..</option>
                  <option value="User">USER</option>
                  <option value="Superuser">SUPERUSER</option>
                  <option value="Manager">MANAGER</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label" for="ket">Keterangan</label>
                <input type="text" class="form-control form-control-sm" name="ket" id="ket" required>
              </div>
              <div class="modal-footer">  
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>    
  </div>
</main>

<script type="text/javascript">
  feather.replace({ 'aria-hidden': 'true' });
  var tab = document.getElementById('tabel');
  var kol = document.getElementById('kolom');
  var kon = document.getElementById('kondisi');
  var baru = document.getElementById('newValue');
  var lama = document.getElementById('oldValue');
  var opsi = document.getElementById('opsi');
  tab.addEventListener('change', function(){
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
          if( xhr.readyState == 4 && xhr.status == 200 ){
              kol.innerHTML = xhr.responseText;
              kon.innerHTML = xhr.responseText;
          }
      }
      xhr.open('GET', 'user_act.php?showCollumn=' + tab.value, true);
      xhr.send();
  });
  function generateQuery(){
    var dis = document.createAttribute('disabled');
    if(opsi.value=="Update"){
      document.getElementById('query').value = "UPDATE " + tab.value + " SET " + kol.value + "='" + baru.value + "'";
      kol.removeAttribute('disabled');
      baru.removeAttribute('disabled');
    }else if(opsi.value=="Delete"){
      document.getElementById('query').value = "DELETE FROM " + tab.value;
      kol.setAttributeNode(dis);
      baru.setAttributeNode(document.createAttribute('disabled'));
    }
  }
  function setKondisi(isi){
    var kondisi = " WHERE " + kon.value + "='" + lama.value + "'";
    if(isi !== ""){
      if(opsi.value=="Update"){
        document.getElementById('query').value = "UPDATE " + tab.value + " SET " + kol.value + "='" + baru.value + "'" + kondisi;
      }else if(opsi.value=="Delete"){
        document.getElementById('query').value = "DELETE FROM " + tab.value + kondisi;
      }
    }else{
      if(opsi.value=="Update"){
        document.getElementById('query').value = "UPDATE " + tab.value + " SET " + kol.value + "='" + baru.value + "'";
      }else if(opsi.value=="Delete"){
        document.getElementById('query').value = "DELETE FROM " + tab.value;
      }
    }
  }
</script>