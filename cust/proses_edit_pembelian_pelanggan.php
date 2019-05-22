<?php
    session_start();
    include '../koneksi.php';
    if (!isset($_SESSION['username'])) {
        header("Location:../index.html");
    }
    if (empty($_SESSION['username'])) {
        echo "<script type='text/javascript'>alert('Success, please sign in first!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='../index.html'</script>";
    }
    $id = $_POST['id'];
    $id_obat = $_POST['nama_obat'];
    $jumlah_obat = $_POST['jumlah_obat'];
    
    $sql = "UPDATE pembelian_pelanggan SET id_obat='$id_obat', jumlah_beli_pelanggan='$jumlah_obat' WHERE id_pembelian_pelanggan = '$id'";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script type='text/javascript'>alert('Transaction updated!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_pembelian_pelanggan.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=profil_pembelian_pelanggan.php>";
    }
?>