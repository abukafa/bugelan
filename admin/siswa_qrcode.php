<?php 
require_once('../assets/phpqrcode-master/qrlib.php');
QRcode::png($_GET['nisn']);
