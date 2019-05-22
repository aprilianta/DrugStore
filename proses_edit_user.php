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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor = $_POST['nomor'];
    $jk = $_POST['jk'];
    $jabatan = $_POST['jabatan'];

    $sql = "UPDATE user SET username='$username', password='$password',nama='$nama',alamat='$alamat',no_telp='$nomor',
    jenis_kelamin='$jk',jabatan='$jabatan' WHERE id_user = '$id'";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script type='text/javascript'>alert('User updated')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_user.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=profil_user.php>";
    }
?>