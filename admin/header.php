<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <center><title>Penjualan App</title></center>
</head>
<body style="background: #f3f3f3ff">
<?php
session_start();

if($_SESSION['status'] != "Login"){
  header("location:index.php?pesan=belum_login");
  exit();
}

?>

<nav class="navbar navbar-inverse" style="border-radius: 0px; margin-bottom:0;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Penjualan</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
            <a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'user.php' ? 'active' : ''; ?>">
            <a href="user.php"><i class="glyphicon glyphicon-user"></i> User</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'barang.php' ? 'active' : ''; ?>">
            <a href="barang.php"><i class="	glyphicon glyphicon-shopping-cart"></i> Barang</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'penjualan.php' ? 'active' : ''; ?>">
            <a href="penjualan.php"><i class="	glyphicon glyphicon-random"></i> Penjualan</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'laporan.php' ? 'active' : ''; ?>">
            <a href="laporan.php"><i class="glyphicon glyphicon-list-alt"></i> Laporan</a>
          </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="glyphicon glyphicon-wrench"></i> Pengaturan <span class="caret"></span>
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><p style="color:white;">Selamat Datang, <b><?php echo $_SESSION['ussername']; ?></b></p></li>
        <li>
          <a href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="glyphicon glyphicon-log-out"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="logout.php" class="btn btn-danger">Ya, Logout</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>