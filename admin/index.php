<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sistem Informasi Penjualan</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='asset/css/bootstrap.css'>
    <script src='asset/js/jquery.js'></script>
    <script src='asset/js/bootstrap.js'></script>
</head>
<body style="background: #f0f0f0">

    <?php 
    include 'header.php';
    include '../koneksi.php'; 
    
    if($_SESSION['status'] == "Login"){
        echo "<div class='alert alert-info'><center>Selamat Datang di Sistem Penjualan Skanega</center></div>";
    }
    ?>

    <div class="panel">
        <div class="panel-heading">
            <h4>Dashboard Penjualan</h4>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1>
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                            <span class="pull-right">
                                <?php 
                                    $penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan");
                                    echo mysqli_num_rows($penjualan);
                                ?>
                            </span>
                        </h1>
                        Total Transaksi Penjualan
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h1>
                            <i class="glyphicon glyphicon-list-alt"></i>
                            <span class="pull-right">
                                <?php 
                                    $barang = mysqli_query($koneksi, "SELECT * FROM barang");
                                    echo mysqli_num_rows($barang);
                                ?>
                            </span>
                        </h1>
                        Jumlah Item Barang
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h1>
                            <i class="glyphicon glyphicon-usd"></i>
                            <span class="pull-right">
                                <?php 
                                    $total = mysqli_query($koneksi, "SELECT SUM(total_harga) AS pendapatan FROM penjualan");
                                    $res = mysqli_fetch_assoc($total);
                                    echo number_format($res['pendapatan'] ?? 0);
                                ?>
                            </span>
                        </h1>
                        Total Pendapatan (Rp)
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h4>Riwayat Penjualan Terakhir</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>ID Jual</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Total Harga</th>
                        <th>Petugas (User)</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $data = mysqli_query($koneksi, "
                    SELECT penjualan.*, barang.nama_barang, user.user_nama 
                    FROM penjualan 
                    JOIN barang ON penjualan.id_barang = barang.id_barang 
                    JOIN user ON penjualan.user_id = user.user_id 
                    ORDER BY penjualan.id_jual DESC 
                    LIMIT 10") or die(mysqli_error($koneksi));
                
                $no = 1;
                while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>PJL-<?php echo $d['id_jual']; ?></td>
                    <td><?php echo $d['tgl_jual']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td>Rp. <?php echo number_format($d['total_harga']); ?></td>
                    <td><?php echo $d['user_nama']; ?></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>