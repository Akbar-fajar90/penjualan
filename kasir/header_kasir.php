<?php 
session_start();


if($_SESSION['status'] != "Login"){
header("location:../index.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kasir - Sistem Penjualan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse" style="border-radius: 0;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-kasir">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">KASIR</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-kasir">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li class="active"><a href="penjualan.php"><i class="glyphicon glyphicon-shopping-cart"></i> Transaksi Penjualan</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li><p class="navbar-text">Halo, <b><?php echo $_SESSION['ussername']; ?></b></p></li>
                    <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>