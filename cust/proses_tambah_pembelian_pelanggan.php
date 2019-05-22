<?php
    include '../koneksi.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location:../index.html");
    }
    if (empty($_SESSION['username'])) {
        echo "<script type='text/javascript'>alert('Success, please sign in first!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='../index.html'</script>";
    }
    $timestamp = time(); date_default_timezone_set('Asia/Jakarta');
    $username = $_SESSION['username'];
    $date = date("Y-m-d A",$timestamp);
    $nama_obat = $_POST['nama_obat'];
    $jumlah = $_POST['jumlah_obat'];

    $sql = "INSERT INTO pembelian_pelanggan (username,tgl_beli_pelanggan, id_obat, jumlah_beli_pelanggan) VALUES ('$username','$date','$nama_obat','$jumlah')";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));

    if ($query) {
        echo "<script type='text/javascript'>alert('Transaction success!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_pembelian_pelanggan.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=tambah_pembelian_pelanggan.php>";
    }
?>