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
    $gmb = $_FILES['gmb']['name'];
    $ukuran = $_FILES['gmb']['size'];
    $ekstensi_diperbolehkan = array('png','jpg');
    $x = explode('.', $gmb);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gmb']['tmp_name'];
    
    if ($ukuran > 0){
        if ($ukuran < 1044070) {
               if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'file/'.$gmb);
                // query SQL untuk update data file
                // $sql = "UPDATE inventory SET gambar = '$gmb' WHERE id_obat = '$id'";
                $sql = updategambar($gmb,$id);
            } else {
                echo 'File extension does not supported';
            }
        } else {
            echo 'File size too big';
        }
    } else {
        $sql = "UPDATE inventory SET nama_obat='$nama_obat', id_kategori='$kategori_obat',harga_jual='$harga_jual',harga_beli='$harga_beli',jumlah_obat='$jumlah_obat',id_supplier='$supplier_obat' WHERE id_obat = '$id'";
    }

    function updategambar($gmb, $id) {
        $sql = "UPDATE inventory SET gambar = '$gmb' WHERE id_obat = '$id'";
        if ($sql) {
             #do nothing
        } else {
            echo 'File failed';
        }
        return $sql;
    }
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