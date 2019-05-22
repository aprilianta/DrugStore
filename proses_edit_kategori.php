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
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    
    $sql = "UPDATE kategori SET nama_kategori='$nama_kategori', id_kategori='$id_kategori' WHERE id_kategori = '$id'";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script type='text/javascript'>alert('Category updated!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_category.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=profil_category.php>";
    }
?>