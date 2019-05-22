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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
  <header class="app-header"><a class="app-header__logo" href="utama.php">Apotik Gowok</a>
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
        <li><a class="app-menu__item" href="utama.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="profil_user.php"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Manage Administrator</span></a></li>
        <li><a class="app-menu__item active" href="profil_pelanggan.php"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Manage Customer</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Inventory</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="profil_obat.php"><i class="icon fa fa-circle-o"></i> Medicine</a></li>
             <li><a class="treeview-item" href="profil_category.php"><i class="icon fa fa-circle-o"></i> Category</a></li>
             <li><a class="treeview-item" href="profil_suppliers.php"><i class="icon fa fa-circle-o"></i> Suppliers</a></li>
          </ul>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             <li><a class="treeview-item" href="profil_penjualan.php"><i class="icon fa fa-circle-o"></i> Sales</a></li>
             <li><a class="treeview-item" href="profil_pembelian.php"><i class="icon fa fa-circle-o"></i> Purchase</a></li>
          </ul>
      </ul>
    </aside>

    <main class="app-content">
      <div class="app-title">
        <div>
        <h1><i class="fa fa-edit"></i> Edit Customer Data </h1>
          <p>Displaying customer data</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Profil Customer</li>
          <li class="breadcrumb-item active"><a href="#">Edit Customer Data</a></li>
        </ul>
      </div>
      <?php
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
        while ($data = mysqli_fetch_array($query)) {
    ?>
      <div class="row">
        <div class="col-md-6">
           <div class="tile">
              <h3 class="tile-title">Form Update</h3>
                 <div class="tile-body">
                    <form method="POST" action="proses_edit_pelanggan.php">
                      <input name="id" hidden="hidden" value="<?php echo $data['id_user'];?>">
                        <div class="form-group row">
                          <label class="control-label col-md-3">Username</label>
                            <div class="col-md-8">
                              <input class="form-control" type="text" name="username" value="<?php echo $data['username']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">Name</label>
                             <div class="col-md-8">
                                <input class="form-control" type="text" name="nama" value="<?php echo $data['nama'];?>">
                             </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">Password</label>
                            <div class="col-md-8">
                              <input class="form-control" type="password" name="password" value="<?php echo $data['password'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">Address</label>
                            <div class="col-md-8">
                              <textarea class="form-control" rows="4" name="alamat"><?php echo $data['alamat'];?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label col-md-3">Telephone</label>
                            <div class="col-md-8">
                              <input class="form-control" type="text" name="nomor" value="<?php echo $data['no_telp'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                           <label class="control-label col-md-3">Gender</label>
                              <div class="col-md-9">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="jk" value="M" <?php if($data['jenis_kelamin'] == "M") echo "checked";?>>Male
                                  </label>
                                </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                   <input class="form-check-input" type="radio" name="jk" value="F" <?php if($data['jenis_kelamin'] == "F") echo "checked";?>>Female
                                </label>
                               </div>
                              </div>
                        </div>
                        </div>
                      <div class="tile-footer">
                        <div class="row">
                           <div class="col-md-8 col-md-offset-3">
                              <button class="btn btn-primary" type="submit">
                                 <i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="profil_pelanggan.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                           </div>
                        </div>
                        <?php } ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</html>