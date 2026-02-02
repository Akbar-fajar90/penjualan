<?php 
include("header.php");
include("../koneksi.php");
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
        <h4>Laporan Penjualan</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th widht="1%">NO</th>
                    <th>Invoice</th>
                    <th>Kasir</th>
                    <th>Barang</th>
                    <th>Total Harga</th>
                    <th>Tgl. Transaksi</th>
                </tr>
                <?php 
                $id_user = $_SESSION["user_id"];
                $data = mysqli_query($koneksi, "
                    SELECT penjualan.*, barang.nama_barang, user.user_nama 
                    FROM penjualan 
                    JOIN barang ON penjualan.id_barang = barang.id_barang 
                    JOIN user ON penjualan.user_id = user.user_id
                    WHERE penjualan.user_id = '$id_user' 
                    ORDER BY penjualan.id_jual DESC
                    ") or die(mysqli_error($koneksi));
                    $no=1;
                    while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo "INV-".$d['id_jual']; ?></td>
                    <td><?php echo $d['user_nama']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td><?php echo $d['total_harga']; ?></td>
                    <td><?php echo $d['tgl_jual']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <strong>Total Pendapatan: </strong> 
                <?php
                $result = mysqli_query($koneksi, "SELECT SUM(total_harga) AS total_pendapatan FROM penjualan");
                $row = mysqli_fetch_assoc($result);
                $total_pendapatan = $row['total_pendapatan'];
                echo "Rp ".number_format($total_pendapatan);
                ?>
    </div>
        <div class="text-right">
            <a href="laporan_cetak.php" target="_blank" class="btn btn-primary">Cetak Laporan</a>
        </div>
</div>