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
            <li><a class="treeview-item" href="profil_obat.php"><i class="icon fa fa-circle-o"></i> Medicine</a></li>
             <li><a class="treeview-item" href="profil_category.php"><i class="icon fa fa-circle-o"></i> Category</a></li>
             <li><a class="treeview-item active" href="profil_suppliers.php"><i class="icon fa fa-circle-o"></i> Suppliers</a></li>
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
          <h1><i class="fa fa-laptop"></i> Suppliers Inventory </h1>
          <p>Table to display suppliers of medicine</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Inventory</li>
          <li class="breadcrumb-item active"><a href="">Suppliers</a></li>
        </ul>
      </div>
      <ul class="app-nav">
        <li class="app-search"><a href="tambah_supplier.php"> <button type="button" class="btn btn-primary"> + Add Supplier </button> </a></li>
         <li class="app-search">
          <form action="profil_suppliers_act.php" method="GET">
            <input class="app-search__input" type="text" placeholder="Search supplier" name="cari">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
          </form>
        </li>
      </ul>
            <?php 
                // $no=1; 
                $tampil = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier");
                if (mysqli_num_rows($tampil) > 0) { ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="tile">
                        <div class="tile-body">
                          <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                              <tr align="center">
                                <th>ID Supplier</th>
                                <th>Supplier Name</th>
                                <th>Address</th>
                                <th>Telephone Number</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
            <?php if(isset($_GET['cari'])){
                $cari=mysqli_real_escape_string($koneksi, $_GET['cari']);
                if ($cari!="") {
                    // $tampil=mysqli_query($koneksi, "SELECT * FROM supplier where nama_supplier LIKE '%$cari%'");
                  $tampil=mysqli_query($koneksi, "CALL GetSupplier('$cari')");
                }
            } while ($data=mysqli_fetch_array($tampil)) {?>
            <td align="center"> <?php echo $data['id_supplier'];?> </td>
            <td align="center"> <?php echo $data['nama_supplier'];?> </td>
            <td align="center"> <?php echo $data['alamat'];?> </td>
            <td align="center"> <?php echo $data['no_telp'];?> </td>
            <td align="center"> 
                    <a href="edit_supplier.php?id= <?php echo $data['id_supplier']; ?>"> <button class="btn btn-warning"><i class="icon fa fa-pencil"></i> Edit</button></a>
                    <a href="hapus_supplier.php?id= <?php echo $data['id_supplier']; ?>"> <button class="btn btn-danger"> <i class="icon fa fa-trash"></i> Hapus</button></a>
            </td>
            <!-- <?php $no++; ?> -->
        </tr>
                <?php } }?>
    </table>
</button>
</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</button>
</main>
<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
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
</html>