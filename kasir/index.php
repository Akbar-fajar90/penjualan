<?php

include 'header_kasir.php'; 
include '../koneksi.php'; 
?>

<div class="container">
    <div class="alert alert-success">
        <center>
            <strong>Selamat Datang, <?php echo $_SESSION['ussername']; ?>!</strong> 
            Anda login sebagai Kasir. Silahkan kelola transaksi penjualan di bawah ini.
        </center>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i> Menu Utama</h3>
                </div>
                <div class="panel-body text-center">
                    <h4>Mulai Transaksi Baru</h4>
                    <p>Klik tombol di bawah untuk menginput data penjualan barang.</p>
                    <a href="tambah_penjualan.php" class="btn btn-lg btn-primary">
                        <i class="glyphicon glyphicon-plus"></i> Tambah Penjualan
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-stats"></i> Performa Anda Hari Ini</h3>
                </div>
                <div class="panel-body">
                    <?php 
                    $tgl_sekarang = date('Y-m-d');
                    $username = $_SESSION['ussername'];
                    $user_query = mysqli_query($koneksi, "SELECT user_id FROM user WHERE ussername='$username'");
                    $u = mysqli_fetch_assoc($user_query);
                    $uid = $u['user_id'];

                    $transaksi_hari_ini = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE tgl_jual='$tgl_sekarang' AND user_id='$uid'");
                    $jumlah = mysqli_num_rows($transaksi_hari_ini);
                    ?>
                    <h1 class="text-center"><?php echo $jumlah; ?></h1>
                    <p class="text-center">Transaksi Berhasil Hari Ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-list"></i> Riwayat Penjualan Terakhir (Oleh Anda)</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>ID Jual</th>
                        <th>Barang</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $data = mysqli_query($koneksi, "
                    SELECT penjualan.*, barang.nama_barang 
                    FROM penjualan 
                    JOIN barang ON penjualan.id_barang = barang.id_barang 
                    WHERE penjualan.user_id = '$uid' 
                    ORDER BY id_jual DESC LIMIT 5") or die(mysqli_error($koneksi));
                
                $no = 1;
                while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>PJL-<?php echo $d['id_jual']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td>Rp <?php echo number_format($d['total_harga']); ?></td>
                    <td>
                        <a href="penjualan_cetak.php?id=<?php echo $d['id_jual']; ?>" class="btn btn-xs btn-warning">
                            <i class="glyphicon glyphicon-print"></i> Struk
                        </a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>