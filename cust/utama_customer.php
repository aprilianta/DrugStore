<?php
    session_start();
    include '../koneksi.php';
    if (!isset($_SESSION['username'])) {
        header("Location:../index.html");
    }
    if (empty($_SESSION['username'])) {
        echo "<script type='text/javascript'>alert('Success, please sign in first!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='../index.html'</script>";
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
  <header class="app-header"><a class="app-header__logo" href="">Apotik Gowok</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="logout_user.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">Hello, <?php echo $_SESSION['username'];?></p>
          <p class="app-sidebar__user-designation"> <?php echo $_SESSION['jabatan'];?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="utama_customer.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Inventory</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             <li><a class="treeview-item" href="profil_obat_pelanggan.php"><i class="icon fa fa-circle-o"></i> Medicine</a></li>
             <li><a class="treeview-item" href="profil_category_pelanggan.php"><i class="icon fa fa-circle-o"></i> Category</a></li>
             <li><a class="treeview-item" href="profil_suppliers_pelanggan.php"><i class="icon fa fa-circle-o"></i> Suppliers</a></li>
          </ul>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             <li><a class="treeview-item" href="profil_pembelian_pelanggan.php"><i class="icon fa fa-circle-o"></i> Purchase</a></li>
          </ul>
        </li>
      </ul>
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>latest login : <?php $timestamp = time(); date_default_timezone_set('Asia/Jakarta');
          echo(date("F d, Y -- h:i:s A", $timestamp));?></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <?php
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username ='".$_SESSION['username']."'");
        while ($data = mysqli_fetch_array($query)) {
      ?>
      <div class="row">
        <div class="col-md-6">
           <div class="tile">
              <h3 class="tile-title">Detail Information</h3>
                 <div class="tile-body">
                    <input name="id" hidden="hidden" value="<?php echo $data['id_user'];?>">
                        <div class="form-group row">
                          <label class="control-label col-md-3">Username</label>
                            <div class="col-md-8">
                               <label class="control-label col-md-6">:&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $data['username']; ?> </label>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">Name</label>
                             <div class="col-md-8">
                                <label class="control-label col-md-6">:&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $data['nama'];?> </label>
                             </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">Address</label>
                            <div class="col-md-8">
                              <label class="control-label col-md-6">:&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $data['alamat'];?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">Telephone</label>
                            <div class="col-md-8">
                              <label class="control-label col-md-6">:&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $data['no_telp'];?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                           <label class="control-label col-md-3">Gender</label>
                              <div class="col-md-8">
                                   <label class="control-label col-md-6">:&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <?php if($data['jenis_kelamin'] == "M") { $jk = "Male"; }
                                            else if($data['jenis_kelamin'] == "F") { $jk = "Female"; }?> <?php echo $jk; ?> </label>
                               </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">User Level</label>
                            <div class="col-md-8">
                              <label class="control-label col-md-6">:&nbsp&nbsp&nbsp&nbsp&nbsp
                                  <?php if($data['jabatan'] == "Pelanggan") echo "Pelanggan"; ?>
                              </label>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">Status Now</label>
                            <div class="col-md-8">
                              <label class="control-label col-md-1">:</label>
                              <span class="badge badge-primary"><?php $tmp = $data['username'];
                                    $panggil = mysqli_query($koneksi,"CALL GetStatus
                                  ('".$tmp."',@status)");
                                  $temp = mysqli_query($koneksi, "SELECT @status AS status");
                                  while ($tampilstatus = mysqli_fetch_array($temp)) {
                                    $t = $tampilstatus['status'];
                                  } echo $t;
                                  
                                  ?></span>
                              <!-- <label class="control-label col-md-6">:&nbsp&nbsp&nbsp&nbsp&nbsp
                                  <?php $tmp = $data['username'];
                                    $panggil = mysqli_query($koneksi,"CALL GetStatus
                                  ('".$tmp."',@status)");
                                  $temp = mysqli_query($koneksi, "SELECT @status AS status");
                                  while ($tampilstatus = mysqli_fetch_array($temp)) {
                                    $t = $tampilstatus['status'];
                                  } echo $t;
                                  
                                  ?>
                              </label> -->
                            </div>
                        </div>
                  </div>
                        <?php } ?>
                      <div class="tile-footer">
                        <div class="row">
                           <div class="col-md-8 col-md-offset-3">
                            <a class="btn btn-primary" href="edit_pelanggan.php?id=<?php echo $data['id_user']; ?>"><i class="icon fa fa-pencil"></i>Update</a>
                           </div>
                        </div>
                        
      
    </main>


     <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="../js/plugins/chart.js"></script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
      }
    </script>
  </body>
</html>