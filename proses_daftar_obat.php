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
    
    $nama_obat = $_POST['nama_obat'];
    $kategori_obat = $_POST['kategori_obat'];
    $harga_obat = $_POST['harga_obat'];
    $jumlah_obat = $_POST['jumlah_obat'];
    

    $sql = "INSERT INTO inventory (nama_obat, kategori_obat, harga_obat, jumlah_obat)
            VALUES ('$nama_obat','$kategori_obat','$harga_obat','$jumlah_obat')";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));

    if ($query) {
        echo "<script type='text/javascript'>alert('Berhasil! Yuk Lihat Data Obat')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_obat.php'</script>";
        echo "<meta http-eqiv=refresh content=0;url=profil_obat.php>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=daftar_obat.html>";
    }
?>