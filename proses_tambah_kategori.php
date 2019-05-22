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
    $nama_kategori = $_POST['nama_kategori'];
    $id_kategori = $_POST['id_kategori'];

    $sql = "INSERT INTO kategori (id_kategori,nama_kategori)
            VALUES ('$id_kategori','$nama_kategori')";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script type='text/javascript'>alert('Success!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_category.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=tambah_kategori.php>";
    }
?>