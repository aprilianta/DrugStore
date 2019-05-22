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

    $id = $_GET['id'];
    $sqllihat = "SELECT * FROM data_pembelian WHERE id_pembelian = '$id'";
    $querylihat = mysqli_query($koneksi, $sqllihat) or die(mysqli_error($koneksi));
    $data = mysqli_fetch_assoc($querylihat);
?>
    <form method="POST" action="proses_update_hapus_pembelian.php" id="myForm">
        <input name="id" hidden="hidden" value="<?php echo $data['id_obat'];?>">
        <input name="jumlah_beli" hidden="hidden" value="<?php echo $data['jumlah_beli'];?>">
        <input name="nama_obat" hidden="hidden" value="<?php echo $data['nama_obat'];?>">
    </form>
    <script type="text/javascript"> document.getElementById("myForm").submit(); </script>
<?php
    $sqlhapusdetailbeli = "DELETE FROM detail_pembelian WHERE id_pembelian = '$id'";
    $queryhapusdetailbeli = mysqli_query($koneksi,$sqlhapusdetailbeli) or die (mysqli_error($koneksi));

    $sql = "DELETE FROM pembelian WHERE id_pembelian = '$id'";
    $query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));

    if ($query && $queryhapusdetailbeli) {
        echo "<script type='text/javascript'>alert('Transaction deleted!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='profil_pembelian.php'</script>";
        // echo "<meta http-eqiv=refresh content=0;url=login_user.html>";
    } else {
        echo "<script type='text/javascript'>alert('Failed')</script>";
        echo "<meta http-eqiv=refresh content=0;url=profil_pembelian.php>";
    }
?>