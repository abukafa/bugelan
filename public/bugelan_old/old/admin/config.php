<?php 
($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "buge5123_abukafa", "margaluyu"));
mysqli_select_db($GLOBALS["___mysqli_ston"], 'buge5123_bugelan');

$conn = mysqli_connect("localhost","buge5123_abukafa","margaluyu","buge5123_old");

// FUNGSI DATA QUERY ROWS ------------------------------------------------------------------------------
function myquery($query){
    // global $conn;
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
// FUNGSI QUERY NUM ROWS -------------------------------------------------------------------------------
function myNumRow($query){
    // global $conn;
    $myQue = mysqli_query($GLOBALS["___mysqli_ston"], $query);
    $numRow = mysqli_num_rows($myQue);
    return $numRow;
}
// FUNGSI POPUP MESSAGE -------------------------------------------------------------------------------
function flasher($pesan, $ket, $tipe){
    session_start();
    $_SESSION['flashin'] = [
        'pesan' => $pesan,
        'ket' => $ket,
        'tipe' => $tipe     
    ];
}
function flash(){
    if(isset($_SESSION['flashin'])){
        echo
        '<script>
            swal("' . $_SESSION['flashin']['pesan'] . '", "' . $_SESSION['flashin']['ket'] . '", "' . $_SESSION['flashin']['tipe'] . '")
        </script>';

        unset($_SESSION['flashin']);
    }
}