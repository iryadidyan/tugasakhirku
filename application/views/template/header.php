<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    
  <link rel="stylesheet" href="<?= base_url(); ?>asset/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/AdminLTE/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link href="<?= base_url(); ?>asset//css/jquery-ui.css" rel="stylesheet">


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="http://localhost/AdminLTE/AdminLTE/" target="blank" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>QT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Bank</b> Mini IQTI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url(); ?>img/<?= $this->session->userdata('gambar'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->session->userdata('nama'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url(); ?>img/<?= $this->session->userdata('gambar'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('nama'); ?> - <?= $this->session->userdata('status'); ?>
                  <small>Member since <?= date('d M Y',strtotime($this->session->userdata('tanggal'))); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url(); ?>profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url(); ?>logout" class="btn btn-default btn-flat tombol-aktif">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url(); ?>img/<?= $this->session->userdata('gambar'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Utama</li>
        <li>
          <a href="<?= base_url(); ?>home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li >
          <a href="<?= base_url(); ?>nasabah">
            <i class="fa fa-users"></i> <span>Master Nasabah</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url(); ?>transaksi/data"><i class="fa fa-circle-o"></i> Data transaksi</a></li>
            <li><a href="<?= base_url(); ?>transaksi/menabung"><i class="fa fa-circle-o"></i> Tabungan</a></li>
            <li><a href="<?= base_url(); ?>transaksi/tarik"><i class="fa fa-circle-o"></i> Tarik tunai</a></li>
          </ul>
        </li>
        <li >
          <a href="<?= base_url(); ?>laporan/keuangan">
            <i class="fa fa-newspaper-o"></i> <span>Kelolda laporan keuangan</span>
          </a>
        </li>

        <?php if($this->session->userdata('status') == 'admin'): ?>
        <li class="header">Menu Admin</li>
        <li >
          <a href="<?= base_url(); ?>petugas">
            <i class="fa fa-table"></i> <span>Master petugas</span>
          </a>
        </li>
        <li >
          <a href="<?= base_url(); ?>akun">
            <i class="fa fa-table"></i> <span>Master Akun</span>
          </a>
        </li>
        <li >
          <a href="<?= base_url(); ?>validasi_laporan">
            <i class="fa fa-table"></i> <span>Check Laporan</span>
          </a>
        </li>
        <?php endif ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small><?= $judulHalaman; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $judulHalaman; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

