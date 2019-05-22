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
    $id_purchase = $_POST['id_purchase'];
    $timestamp = time(); date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d A",$timestamp);
    $nama_obat = $_POST['nama_obat'];
    $jumlah = $_POST['jumlah_obat'];

    $sql = "INSERT INTO penjualan (id_receipt_jual,tgl_jual) VALUES ('$id_purchase','$date')";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));

    $sqlpenjualan = "SELECT * FROM penjualan WHERE id_receipt_jual = '$id_purchase'";
    $querypenjualan = mysqli_query($koneksi,$sqlpenjualan) or die (mysqli_error($koneksi));
    $data = mysqli_fetch_assoc($querypenjualan);

    $i = $data['id_penjualan'];

    $sqljumlah = "SELECT * FROM inventory WHERE id_obat = '$nama_obat'";
    $queryjumlah = mysqli_query($koneksi,$sqljumlah) or die (mysqli_error($koneksi));
    $datajumlah = mysqli_fetch_assoc($queryjumlah);
    $j = $datajumlah['jumlah_obat'];

    $stok_baru = $j-$jumlah;

    $sqlupdatejumlah = "UPDATE inventory SET jumlah_obat='$stok_baru' WHERE id_obat = '$nama_obat'";
    $queryupdatejumlah = mysqli_query($koneksi,$sqlupdatejumlah) or die (mysqli_error($koneksi));

    $sqldetail = "INSERT INTO detail_penjualan (id_receipt_jual,id_penjualan,id_obat,jumlah_jual,stok_awal,stok_baru)
            VALUES ('$id_purchase','$i','$nama_obat','$jumlah','$j','$stok_baru')";
    $querydetail = mysqli_query($koneksi,$sqldetail) or die (mysqli_error($koneksi));    

    if ($query && $querypenjualan && $queryjumlah && $queryupdatejumlah && $querydetail) {
        echo "<script type='text/javascript'>alert('Transaction success!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_penjualan.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=tambah_penjualan.php>";
    }
?>