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
        <li class="treeview"><a class="app-menu__item" href="" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Inventory</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="profil_obat.php"><i class="icon fa fa-circle-o"></i> Medicine</a></li>
             <li><a class="treeview-item" href="profil_category.php"><i class="icon fa fa-circle-o"></i> Category</a></li>
             <li><a class="treeview-item" href="profil_suppliers.php"><i class="icon fa fa-circle-o"></i> Suppliers</a></li>
          </ul>
        <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             <li><a class="treeview-item active" href="profil_penjualan.php"><i class="icon fa fa-circle-o"></i> Sales</a></li>
             <li><a class="treeview-item" href="profil_pembelian.php"><i class="icon fa fa-circle-o"></i> Purchase</a></li>
          </ul>
      </ul>
    </aside>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Sales Transaction </h1>
          <p>Table to display sales transaction data</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Transaction</li>
          <li class="breadcrumb-item active"><a href="">Sales</a></li>
        </ul>
      </div>
      <ul class="app-nav">
        <li class="app-search"><a href="tambah_penjualan.php"> <button type="button" class="btn btn-primary"> + Add Sales Transaction </button> </a></li>
         <li class="app-search">
          <form action="profil_penjualan_act.php" method="GET">
            <input class="app-search__input" type="text" placeholder="Search by medicine" name="cari">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
          </form>
        </li>
      </ul>
            <?php 
                // $no=1; 
                $tampil = mysqli_query($koneksi, "SELECT * FROM data_penjualan");
                if (mysqli_num_rows($tampil) > 0) { ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="tile">
                      <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                            <tr align="center">
                              <th>ID Transaction</th>
                                <th>ID Receipt</th>
                                <th>Date</th>
                                <th>Medicine Name</th>
                                <th>Quantity Sales</th>
                                <th>Unit Sales Price</th>
                                <th>Total Sales</th>
                                <th colspan="2">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
            <?php if(isset($_GET['cari'])){
                $cari=mysqli_real_escape_string($koneksi, $_GET['cari']);
                if ($cari!="") {
                    // $tampil=mysqli_query($koneksi, "SELECT * FROM data_penjualan where nama_obat LIKE '%$cari%'");
                    $tampil=mysqli_query($koneksi, "CALL GetPenjualan('$cari')");
                }
            } while ($data=mysqli_fetch_array($tampil)) { ?>

            <td align="center"> <?php echo $data['id_penjualan'];?> </td>
            <td align="center"> <?php echo $data['id_receipt_jual'];?> </td>
            <td align="center"> <?php echo $data['tgl_jual'];?> </td>
            <td align="center"> <?php echo $data['nama_obat'];?> </td>
            <td align="center"> <?php echo $data['jumlah_jual'];?> </td>
            <td align="center"> <?php echo $data['harga_jual'];?> </td>
            <td align="center"> <?php echo $data['total'];?> </td>
            <td align="center" colspan="2">
                     
            <a href="hapus_penjualan.php?id= <?php echo $data['id_penjualan']; ?>">
                <button class="btn btn-danger"> <i class="icon fa fa-trash"></i> Hapus
                </button>
            </a>
            </td>
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