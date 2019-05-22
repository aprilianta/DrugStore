<?php
$_HOST="localhost";
$_USER="root";
$_PASS="";
$_DBNM="gowok";

$koneksi=mysqli_connect($_HOST, $_USER, $_PASS, $_DBNM)or die("koneksi ke Database Gagal");
?>