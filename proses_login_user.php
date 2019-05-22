<?php
    include 'koneksi.php';
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['username'] = $username;
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $query = mysqli_query($koneksi,$sql);
    $data = mysqli_fetch_assoc($query);
    $jabatan = "Pelanggan";
    $_SESSION['jabatan'] = $data['jabatan'];
    if ((strcmp($username,$data['username'])==0) && (strcmp($password,$data['password'])==0)) {
        
        if (strcmp($jabatan,$data['jabatan'])==0) {
            echo "<script type='text/javascript'>alert('Success')</script>";
            echo "<script language='javascript' type='text/javascript'> location.href='cust/utama_customer.php'</script>";
        } else {
            echo "<script language='javascript' type='text/javascript'> location.href='utama.php'</script>";
        }
    } else {
        header("Location:index.html");
    }
?>