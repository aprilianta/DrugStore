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
        <li><a class="app-menu__item active" href="utama.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="profil_user.php"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Manage Administrator</span></a></li>
        <li><a class="app-menu__item" href="profil_pelanggan.php"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Manage Customer</span></a></li>
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
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>latest login : <?php $timestamp = time(); date_default_timezone_set('Asia/Jakarta');
          echo(date("F d, Y -- h:i:s A", $timestamp));?></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Users</h4>
              <p><b><?php $tampiluser = mysqli_query($koneksi, "SELECT * FROM user");
                    $datauser = mysqli_num_rows($tampiluser); printf("%d \n",$datauser);?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-tags fa-3x"></i>
            <div class="info">
              <h4>Medicine</h4>
              <p><b><?php $tampilmedicine = mysqli_query($koneksi, "SELECT * FROM inventory");
                    $datamedicine = mysqli_num_rows($tampilmedicine); printf("%d \n",$datamedicine);?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Category</h4>
             <p><b><?php $tampilkategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori > 0");
                    $datakategori = mysqli_num_rows($tampilkategori); printf("%d \n",$datakategori);?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h4>Suppliers</h4>
              <p><b><?php $tampilsupplier = mysqli_query($koneksi, "SELECT * FROM supplier");
                    $datasupplier = mysqli_num_rows($tampilsupplier); printf("%d \n",$datasupplier);?></b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Distribution by Gender (%)</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Distribution by Occupation (%)</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="pieChartDemoDua"></canvas>
            </div>
          </div>
        </div>
      </div>
      
    </main>


     <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript">

      var pdata = [
        {
          value:
            <?php $tampiluserpria = mysqli_query($koneksi,
                    "SELECT * FROM user WHERE jenis_kelamin='M'");
                  $datauserpria = mysqli_num_rows($tampiluserpria);
                  $x = ($datauserpria/$datauser);?> <?php echo($x*100); ?>,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Male"
        },
        {
          value: 
            <?php $tampiluserwanita = mysqli_query($koneksi,
                    "SELECT * FROM user WHERE jenis_kelamin='F'");
                  $datauserwanita = mysqli_num_rows($tampiluserwanita);
                  $y = ($datauserwanita/$datauser);?> <?php echo($y*100); ?>,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "Female"
        }
      ];

      var pdatadua = [
        {
          value:
            <?php $tampiluserowner = mysqli_query($koneksi,
                    "SELECT * FROM user WHERE jabatan='Owner'");
                  $datauserowner = mysqli_num_rows($tampiluserowner);
                  $owner = ($datauserowner/$datauser);?> <?php echo($owner*100); ?>,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Owner"
        },
        {
          value: 
            <?php $tampiluserapoteker = mysqli_query($koneksi,
                    "SELECT * FROM user WHERE jabatan='Apoteker'");
                  $datauserapoteker = mysqli_num_rows($tampiluserapoteker);
                  $apoteker = ($datauserapoteker/$datauser);?> <?php echo($apoteker*100); ?>,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "Apoteker"
        },
        {
          value: 
            <?php $tampiluserapotekerpendamping = mysqli_query($koneksi,
                    "SELECT * FROM user WHERE jabatan='Apoteker Pendamping'");
                  $datauserapotekerpendamping = mysqli_num_rows($tampiluserapotekerpendamping);
                  $apotekerpendamping = ($datauserapotekerpendamping/$datauser);?> <?php echo($apotekerpendamping*100); ?>,
          color:"#bcbf46",
          highlight: "#d2d059",
          label: "Apoteker Pendamping"
        },{
          value: 
            <?php $tampiluserpelanggan = mysqli_query($koneksi,
                    "SELECT * FROM user WHERE jabatan='Pelanggan'");
                  $datauserpelanggan = mysqli_num_rows($tampiluserpelanggan);
                  $apotekerpelanggan = ($datauserpelanggan/$datauser);?> <?php echo($apotekerpelanggan*100); ?>,
          color:"#54f746",
          highlight: "#93ff5a",
          label: "Pelanggan"
        }
        
      ]
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);

      var ctxpdua = $("#pieChartDemoDua").get(0).getContext("2d");
      var pieChartDua = new Chart(ctxpdua).Doughnut(pdatadua);
    </script>
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