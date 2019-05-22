<?php
    session_start();
    include 'koneksi.php';
    if (!isset($_SESSION['username'])) {
        header("Location:index.html");
    }
    if (empty($_SESSION['username'])) {
        echo "<script type='text/javascript'>alert('Success, please sign in first!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='index.html'</script>";
    }
    $id = $_POST['id'];
    $jumlah_beli = $_POST['jumlah_beli'];

    $sqljumlah = "SELECT * FROM inventory WHERE id_obat = '$id'";
    $queryjumlah = mysqli_query($koneksi,$sqljumlah) or die (mysqli_error($koneksi));
    $datajumlah = mysqli_fetch_assoc($queryjumlah);
    $j = $datajumlah['jumlah_obat'];

    $stok_baru = $j - $jumlah_beli;

    $sql = "UPDATE inventory SET jumlah_obat='$stok_baru' WHERE id_obat = '$id'";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script type='text/javascript'>alert('Transaction deleted!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_pembelian.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=profil_pembelian.php>";
    }
?>