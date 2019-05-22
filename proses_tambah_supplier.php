<?php
    include 'koneksi.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location:index.html");
    }
    if (empty($_SESSION['username'])) {
        echo "<script type='text/javascript'>alert('Success, please sign in first!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='index.html'</script>";
    }
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat_supplier'];
    $telephone = $_POST['telephone'];

    $sql = "INSERT INTO supplier (nama_supplier, alamat, no_telp)
            VALUES ('$nama_supplier','$alamat','$telephone')";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script type='text/javascript'>alert('Success!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_suppliers.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=tambah_supplier.php>";
    }
?>