<?php 
include 'navbar.php';

$uname = $_SESSION['uname'];
$admin = mysqli_query($GLOBALS["___mysqli_ston"], "select * from admin where uname='$uname'");
while($u=mysqli_fetch_array($admin)){
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Surat Keluar</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive"><span data-feather="plus-circle"></span>
            Buat Baru
          </button>
        </div>
        <div class="btn-group me-2">
          <a  href="suratin"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="send"></span>
            Surat Masuk
          </button></a>
        </div>
      </div>
    </div>
    <?php flash() ?>
    
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>No</th>
            <th class="d-none d-md-table-cell">Lamp</th>
            <th class="d-none d-md-table-cell">Perihal</th>
            <th class="d-none d-lg-table-cell">Tujuan</th>
            <th class="d-none d-lg-table-cell">Keterangan</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php 
          $no=1;
          $surat=mysqli_query($GLOBALS["___mysqli_ston"], "select * from letter order by id");
          while($a=mysqli_fetch_array($surat)){
          ?>
            <td><?php echo $a['no'] ?></td>
            <td class="d-none d-md-table-cell"><?php echo $a['lamp'] ?></td>
            <td class="d-none d-md-table-cell"><?php echo $a['hal'] ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $a['kpd'] ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $a['ket'] ?></td>
            <td align="right">
              <a type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $a['id']; ?>"><span data-feather="edit"></span></a>
              <a href="surat_lprt?id=<?php echo $a['id'] ?>" target="_blank" class="d-none d-xl-inline-block btn btn-sm btn-primary"><span data-feather="printer"></span></a>
              <?php
              if ($u['access']=="Programmer" or $u['access']=="Manager"){
              ?>
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
                  location.href="surat_act?hapus=<?php echo $a['id']; ?>";
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
                  <h5 class="modal-title" id="staticBackdropLiveLabel">Edit Data Surat Keluar</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <form role="form" action="surat_act?ubah" method="post">
                    <?php

                    ?>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="eno">Nomor</label>
                      <input type="hidden" name="eid" id="eid" value="<?php echo $a['id']; ?>">
                      <input type="text" class="form-control form-control-sm" name="eno" id="eno" value="<?php echo $a['no']; ?>" readonly>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                          <label class="form-label fw-bold" for="eunit">Unit</label>
                          <select type="text" class="form-select form-select-sm" name="eunit" id="eunit" onchange="editNo()">
                          <option value="">.. pilih ..</option>
                          <option value="01">01 - Yayasan Bugelan</option>
                          <option value="02">02 - SMPT Bugelan</option>
                          <option value="03">03 - TKA TA Bugelan</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label fw-bold" for="ejenis">Jenis</label>
                          <select type="text" class="form-select form-select-sm" name="ejenis" id="ejenis" onchange="editNo()">
                          <option value="">.. pilih ..</option>
                          <option value="SK">Surat Keputuran</option>
                          <option value="ST">Surat Keterangan</option>
                          <option value="SB">Surat Pemberitahuan</option>
                          <option value="SP">Surat Pemberitahuan</option>
                          <option value="SE">Surat Edaran</option>
                          <option value="SU">Surat Undangan</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label fw-bold" for="eurut">No. Urut</label>
                          <input type="text" class="form-control form-control-sm" name="eurut" id="eurut" onchange="editNo()">
                        </div>
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="ehal">Perihal</label>
                      <input type="text" class="form-control form-control-sm" name="ehal" id="ehal" value="<?php echo $a['hal']; ?>">
                    </div>
                    <script>    
                      function zeroPad(num, plc){
                        var z = plc - num.toString().length + 1;
                        return Array(+(z > 0 && z)).join("0") + num;
                      }
                      function romanize(num) {
                          if (isNaN(num))
                              return NaN;
                          var digits = String(+num).split(""),
                              key = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM",
                                    "","X","XX","XXX","XL","L","LX","LXX","LXXX","XC",
                                    "","I","II","III","IV","V","VI","VII","VIII","IX"],
                              roman = "",
                              i = 3;
                          while (i--)
                              roman = (key[+digits.pop() + (i * 10)] || "") + roman;
                          return Array(+digits.join("") + 1).join("M") + roman;
                      }
                      function editNo(){  
                      var unit = document.getElementById('eunit').value;
                      var urut = document.getElementById('eurut').value;
                      var jenis = document.getElementById('ejenis').value;
                      var now = new Date();
                      var bln = romanize(now.getMonth() + 1);
                      var thn = now.getFullYear();
                      var urt = zeroPad(urut, 3);
                      switch(unit){
                          case '02' :
                              sek = 'SMPT-BGL';
                              break;
                          case '03' :
                              sek = 'TKA-BGL';
                              break;
                          default :
                              sek = 'Y-BGL';
                              break;
                      }
                      switch(jenis){
                          case 'SK' :
                              phal = 'Surat Keputusan';
                              break;
                          case 'ST' :
                              phal = 'Surat Keterangan';
                              break;
                          case 'SB' :
                              phal = 'Surat Pemberitahuan';
                              break;
                          case 'SP' :
                              phal = 'Surat Peringatan';
                              break;
                          case 'SE' :
                              phal = 'Surat Edaran';
                              break;
                          case 'SU' :
                              phal = 'Surat Undangan';
                              break;
                          default :
                              phal = 'Surat';
                              break;
                      }
                      document.getElementById('eno').value = unit + '.' + urt + '/' + jenis + '/' + sek + '/' + bln + '/' + thn;
                      document.getElementById('ehal').value = phal;
                      document.getElementById('elamp').value = '-';
                      document.getElementById('ekpd').value = 'Yth. ';
                      };
                    </script>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="elamp">Lampiran</label> 
                      <input type="text" class="form-control form-control-sm" name="elamp" id="elamp" value="<?php echo $a['lamp']; ?>">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="ekpd">Kepada</label> 
                      <input type="text" class="form-control form-control-sm" name="ekpd" id="ekpd" value="<?php echo $a['kpd']; ?>">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="esatu">Isi Surat - bag 1</label>
                      <textarea class="form-control" name="esatu" rows="5"><?php echo $a['main_1']; ?></textarea>
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="edua">Isi Surat - bag 2</label>
                      <textarea class="form-control" name="edua" rows="5"><?php echo $a['main_2']; ?></textarea>
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="etiga">Isi Surat - bag 3</label>
                      <textarea class="form-control" name="etiga" rows="5"><?php echo $a['main_3']; ?></textarea>
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold">Tanda tangan</label>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-6">
                          <input class="form-control form-control-sm" type="text" name="ettd1" value="<?php echo $a['sign_1']; ?>">
                      </div>
                      <div class="col-md-6">
                          <input class="form-control form-control-sm" type="text" name="entd1" value="<?php echo $a['name_1']; ?>">
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-6">
                          <input class="form-control form-control-sm" type="text" name="ettd2" value="<?php echo $a['sign_2']; ?>">
                      </div>
                      <div class="col-md-6">
                          <input class="form-control form-control-sm" type="text" name="entd2" value="<?php echo $a['name_2']; ?>">
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-6">
                          <input class="form-control form-control-sm" type="text" name="ettd3" value="<?php echo $a['sign_3']; ?>">
                      </div>
                      <div class="col-md-6">
                          <input class="form-control form-control-sm" type="text" name="entd3" value="<?php echo $a['name_3']; ?>">
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-6">
                          <input class="form-control form-control-sm" type="text" name="ettd4" value="<?php echo $a['sign_4']; ?>">
                      </div>
                      <div class="col-md-6">
                          <input class="form-control form-control-sm" type="text" name="entd4" value="<?php echo $a['name_4']; ?>">
                      </div>
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="enote">Foot Note</label>
                      <textarea class="form-control" name="enote" rows="3"><?php echo $a['note']; ?></textarea>
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-bold" for="eket">Keterangan</label>
                      <input type="textarea" class="form-control form-control-sm" name="eket" value="<?php echo $a['ket']; ?>">
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
            <h5 class="modal-title" id="staticBackdropLiveLabel">Input Data Surat Keluar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form role="form" action="surat_act?tambah" method="post">
              <?php

              ?>
              <div class="mb-2">
                <label class="form-label fw-bold" for="no">Nomor</label>
                <input type="text" class="form-control form-control-sm" name="no" id="no" readonly>
              </div>
              <div class="row mb-2">
                  <div class="col-md-4">
                    <label class="form-label fw-bold" for="unit">Unit</label>
                    <select type="text" class="form-select form-select-sm" name="unit" id="unit" onchange="nomor()" required>
                    <option value="">.. pilih ..</option>
                    <option value="01">01 - Yayasan Bugelan</option>
                    <option value="02">02 - SMPT Bugelan</option>
                    <option value="03">03 - TKA TA Bugelan</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold" for="jenis">Jenis</label>
                    <select type="text" class="form-select form-select-sm" name="jenis" id="jenis" onchange="nomor()" required>
                    <option value="">.. pilih ..</option>
                    <option value="SK">Surat Keputuran</option>
                    <option value="ST">Surat Keterangan</option>
                    <option value="SB">Surat Pemberitahuan</option>
                    <option value="SP">Surat Pemberitahuan</option>
                    <option value="SE">Surat Edaran</option>
                    <option value="SU">Surat Undangan</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold" for="urut">No. Urut</label>
                    <input type="text" class="form-control form-control-sm" name="urut" id="urut" onchange="nomor()" required>
                  </div>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="hal">Perihal</label>
                <input type="text" class="form-control form-control-sm" name="hal" id="hal">
              </div>
              <script>    
                function zeroPad(num, plc){
                  var z = plc - num.toString().length + 1;
                  return Array(+(z > 0 && z)).join("0") + num;
                }
                function romanize(num) {
                    if (isNaN(num))
                        return NaN;
                    var digits = String(+num).split(""),
                        key = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM",
                              "","X","XX","XXX","XL","L","LX","LXX","LXXX","XC",
                              "","I","II","III","IV","V","VI","VII","VIII","IX"],
                        roman = "",
                        i = 3;
                    while (i--)
                        roman = (key[+digits.pop() + (i * 10)] || "") + roman;
                    return Array(+digits.join("") + 1).join("M") + roman;
                }
                function nomor(){  
                var unit = document.getElementById('unit').value;
                var urut = document.getElementById('urut').value;
                var jenis = document.getElementById('jenis').value;
                var now = new Date();
                var bln = romanize(now.getMonth() + 1);
                var thn = now.getFullYear();
                var urt = zeroPad(urut, 3);
                switch(unit){
                    case '02' :
                        sek = 'SMPT-BGL';
                        break;
                    case '03' :
                        sek = 'TKA-BGL';
                        break;
                    default :
                        sek = 'Y-BGL';
                        break;
                }
                switch(jenis){
                    case 'SK' :
                        phal = 'Surat Keputusan';
                        break;
                    case 'ST' :
                        phal = 'Surat Keterangan';
                        break;
                    case 'SB' :
                        phal = 'Surat Pemberitahuan';
                        break;
                    case 'SP' :
                        phal = 'Surat Peringatan';
                        break;
                    case 'SE' :
                        phal = 'Surat Edaran';
                        break;
                    case 'SU' :
                        phal = 'Surat Undangan';
                        break;
                    default :
                        phal = 'Surat';
                        break;
                }
                document.getElementById('no').value = unit + '.' + urt + '/' + jenis + '/' + sek + '/' + bln + '/' + thn;
                document.getElementById('hal').value = phal;
                document.getElementById('lamp').value = '-';
                document.getElementById('kpd').value = 'Yth. ';
                };
              </script>
              <div class="mb-2">
                <label class="form-label fw-bold" for="lamp">Lampiran</label> 
                <input type="text" class="form-control form-control-sm" name="lamp" id="lamp" required>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="kpd">Kepada</label> 
                <input type="text" class="form-control form-control-sm" name="kpd" id="kpd" required>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="satu">Isi Surat - bag 1</label>
                <textarea class="form-control" name="satu" rows="5" required></textarea>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="dua">Isi Surat - bag 2</label>
                <textarea class="form-control" name="dua" rows="5"></textarea>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="tiga">Isi Surat - bag 3</label>
                <textarea class="form-control" name="tiga" rows="5"></textarea>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold">Tanda tangan</label>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                    <input class="form-control form-control-sm" type="text" name="ttd1" placeholder="Jabatan .." required>
                </div>
                <div class="col-md-6">
                    <input class="form-control form-control-sm" type="text" name="ntd1" placeholder="Nama ..">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                    <input class="form-control form-control-sm" type="text" name="ttd2" placeholder="Jabatan ..">
                </div>
                <div class="col-md-6">
                    <input class="form-control form-control-sm" type="text" name="ntd2" placeholder="Nama ..">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                    <input class="form-control form-control-sm" type="text" name="ttd3" placeholder="Jabatan ..">
                </div>
                <div class="col-md-6">
                    <input class="form-control form-control-sm" type="text" name="ntd3" placeholder="Nama ..">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                    <input class="form-control form-control-sm" type="text" name="ttd4" placeholder="Jabatan ..">
                </div>
                <div class="col-md-6">
                    <input class="form-control form-control-sm" type="text" name="ntd4" placeholder="Nama ..">
                </div>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="note">Foot Note</label>
                <textarea class="form-control" name="note" rows="3"></textarea>
              </div>
              <div class="mb-2">
                <label class="form-label fw-bold" for="ket">Keterangan</label>
                <input type="textarea" class="form-control form-control-sm" name="ket">
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
<?php
} 
?>

<script type="text/javascript">
    feather.replace({ 'aria-hidden': 'true' })
</script>