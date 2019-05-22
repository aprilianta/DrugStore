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
        <li><a class="app-menu__item" href="profil_pelanggan.php"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Manage Customer</span></a></li>
        <li class="treeview is-expanded"><a class="app-menu__item" href="" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Inventory</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item active" href="profil_obat.php"><i class="icon fa fa-circle-o"></i> Medicine</a></li>
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
        <h1><i class="fa fa-edit"></i> Add Medicine Data </h1>
          <p>Input new medicine data</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Inventory</li>
          <li class="breadcrumb-item active"><a href="">Add Medicine Data</a></li>
        </ul>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="tile">
              <h3 class="tile-title">Form Medicine</h3>
                 <div class="tile-body">
                     <form method="POST" action="proses_tambah_obat.php">
                         <div class="form-group row">
                           <label class="control-label col-md-3">Name</label>
                             <div class="col-md-8">
                                  <input class="form-control" type="text" name="nama_obat">
                              </div>
                         </div>
                        <div class="form-group row">
                           <label class="control-label col-md-3">Category</label>
                              <div class="col-md-8">
                                  <select name="kategori_obat" class="form-control">
                                    <option value="0"> -- Choose category -- </option>
                                    <?php $tampil = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori > 0");
                                        while($row = mysqli_fetch_assoc($tampil)){
                                        echo '<option>'.$row['id_kategori'].' - '.$row['nama_kategori'].'</option>';
                                      } ?>
                                   </select>
                             </div>
                           </div>
                  </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Selling Price</label>
                  <div class="col-md-8 input-group-prepend"><span class="input-group-text">Rp</span>
                        <input class="form-control" name="harga_jual" type="number" placeholder="Amount">
                        <div class="input-group-append"><span class="input-group-text">,00</span></div></div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Purchase Price</label>
                  <div class="col-md-8 input-group-prepend"><span class="input-group-text">Rp</span>
                        <input class="form-control" name="harga_beli" type="number" placeholder="Amount">
                        <div class="input-group-append"><span class="input-group-text">,00</span></div></div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Quantity</label>
                      <div class="col-md-8">
                          <input class="form-control" type="number" name="jumlah_obat">
                      </div>
                </div>
                 <div class="form-group row">
                           <label class="control-label col-md-3">Supplier</label>
                              <div class="col-md-8">
                                  <select name="supplier_obat" class="form-control">
                                    <option value="0"> -- Choose supplier -- </option>
                                    <?php $tampilsupplier = mysqli_query($koneksi, "SELECT * FROM supplier");
                                        while($rowsupllier = mysqli_fetch_assoc($tampilsupplier)){
                                        echo '<option>'.$rowsupllier['id_supplier'].' - '.$rowsupllier['nama_supplier'].'</option>';
                                      } ?>
                                   </select>
                             </div>
                           </div>
                <div class="tile-footer">
                   <div class="row">
                      <div class="col-md-8 col-md-offset-3">
                          <button class="btn btn-primary" type="submit">
                               <i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="profil_obat.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                   </div>
                </form>                                                                
             </div>
           </div>
         </div>
        </div>
       </div>