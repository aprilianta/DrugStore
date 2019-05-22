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
    $nama_obat = $_POST['nama_obat'];
    $kategori_obat = $_POST['kategori_obat'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $jumlah_obat = $_POST['jumlah_obat'];
    $supplier_obat = $_POST['supplier_obat'];
    
    $sql = "UPDATE inventory SET nama_obat='$nama_obat', id_kategori='$kategori_obat',harga_jual='$harga_jual',harga_beli='$harga_beli',jumlah_obat='$jumlah_obat',id_supplier='$supplier_obat'
    WHERE id_obat = '$id'";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script type='text/javascript'>alert('Medicine updated!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_obat.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=profil_obat.php>";
    }
?>