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
    $id = $_GET['id'];
    $sqlhapus = "DELETE FROM pembelian_pelanggan WHERE id_pembelian_pelanggan = '$id'";
    $queryhapus = mysqli_query($koneksi,$sqlhapus) or die (mysqli_error($koneksi));

    if ($queryhapus) {
        echo "<script type='text/javascript'>alert('Transaction deleted!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_pembelian_pelanggan.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=profil_pembelian_pelanggan.php>";
    }
?>