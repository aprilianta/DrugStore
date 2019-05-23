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
    $kategori = $_POST['kategori_obat'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $jumlah = $_POST['jumlah_obat'];
    $supplier_obat = $_POST['supplier_obat'];

    $ekstensi_diperbolehkan = array('png','jpg');
    $gmb = $_FILES['gmb']['name'];
    $x = explode('.', $gmb);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['gmb']['size'];
    $file_tmp = $_FILES['gmb']['tmp_name'];    
 
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){          
            move_uploaded_file($file_tmp, 'file/'.$gmb);
            $sql = "INSERT INTO inventory (nama_obat,id_kategori,harga_jual,harga_beli,jumlah_obat,id_supplier,gambar)
            VALUES ('$nama_obat','$kategori','$harga_jual','$harga_beli','$jumlah','$supplier_obat','$gmb')";
            if($sql){
                // echo 'File uploaded successfully';
            } else{
                echo 'File failed';
            }
       } else {
            echo 'File size too big';
          }
    } else{
        echo 'File extension does not supported';
    }

    // $sql = "INSERT INTO inventory (nama_obat,id_kategori,harga_jual,harga_beli,jumlah_obat,id_supplier)
    //         VALUES ('$nama_obat','$kategori','$harga_jual','$harga_beli','$jumlah','$supplier_obat')";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script type='text/javascript'>alert('Success!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_obat.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=tambah_obat.php>";
    }
?>