<?php
include "header_kasir.php";
include "../koneksi.php";
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-list-alt"></i> Data Penjualan Saya</h4>
        </div>
        <div class="panel-body">
            <a href="tambah_penjualan.php" class="btn btn-sm btn-primary pull-right">
                <i class="glyphicon glyphicon-plus"></i> Input Penjualan Baru
            </a>
            <br><br>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-info">
                        <th width="1%">No</th>
                        <th>ID Jual</th>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Total Bayar</th>
                        <th width="10%">Struk</th>
                    </tr>
                </thead>
                <tbody>
                <?php 

                    $username_aktif = $_SESSION['ussername'];
                    $user_query = mysqli_query($koneksi, "SELECT user_id FROM user WHERE ussername='$username_aktif'");
                    $user_data = mysqli_fetch_assoc($user_query);
                    $id_kasir = $user_data['user_id'];

                    $data = mysqli_query($koneksi, "
                        SELECT penjualan.*, barang.nama_barang 
                        FROM penjualan 
                        JOIN barang ON penjualan.id_barang = barang.id_barang 
                        WHERE penjualan.user_id = '$id_kasir' 
                        ORDER BY penjualan.id_jual DESC
                    ") or die(mysqli_error($koneksi));

                    $no = 1;
                    while ($d = mysqli_fetch_array($data)) {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td>PJL-<?php echo $d['id_jual']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                        <td><?php echo $d['nama_barang']; ?></td>
                        <td>Rp <?php echo number_format($d['total_harga']); ?></td>
                        <td class="text-center">
                            <a href="penjualan_cetak.php?id=<?php echo $d['id_jual']; ?>" 
                               target="_blank" class="btn btn-xs btn-warning">
                                <i class="glyphicon glyphicon-print"></i> Cetak
                            </a>
                        </td>
                    </tr>
                <?php 
                    } 
                    if(mysqli_num_rows($data) == 0){
                        echo "<tr><td colspan='6' class='text-center'>Belum ada transaksi hari ini.</td></tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>