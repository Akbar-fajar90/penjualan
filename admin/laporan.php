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
            <form method="get" action="" class="form-inline mb-3">
                <div class="form-group mr-2">
                    <label for="tanggal_awal">Dari Tanggal:</label>
                    <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control ml-2" 
                           value="<?php echo isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : ''; ?>">
                </div>
                <div class="form-group mr-2">
                    <label for="tanggal_akhir">Sampai Tanggal:</label>
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control ml-2" 
                           value="<?php echo isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a href="laporan.php" class="btn btn-secondary">Reset</a>
            </form>

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

                $query = "
                    SELECT penjualan.*, barang.nama_barang, user.user_nama 
                    FROM penjualan 
                    JOIN barang ON penjualan.id_barang = barang.id_barang 
                    JOIN user ON penjualan.user_id = user.user_id
                    WHERE penjualan.user_id = '$id_user' 
                ";
                
                if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir']) && 
                    !empty($_GET['tanggal_awal']) && !empty($_GET['tanggal_akhir'])) {
                    
                    $tanggal_awal = $_GET['tanggal_awal'];
                    $tanggal_akhir = $_GET['tanggal_akhir'];
                    
                    $query .= " AND DATE(penjualan.tgl_jual) BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ";
                }
                
                $query .= " ORDER BY penjualan.id_jual DESC";
                
                $data = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                $no = 1;
                
                while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo "INV-".$d['id_jual']; ?></td>
                    <td><?php echo $d['user_nama']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td>Rp <?php echo number_format($d['total_harga']); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        
        <div class="panel-footer">
            <strong>Total Pendapatan: </strong> 
            <?php
            $total_query = "SELECT SUM(total_harga) AS total_pendapatan FROM penjualan WHERE user_id = '$id_user'";
            
            if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir']) && 
                !empty($_GET['tanggal_awal']) && !empty($_GET['tanggal_akhir'])) {
                
                $tanggal_awal = $_GET['tanggal_awal'];
                $tanggal_akhir = $_GET['tanggal_akhir'];
                
                $total_query .= " AND DATE(tgl_jual) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            }
            
            $result = mysqli_query($koneksi, $total_query);
            $row = mysqli_fetch_assoc($result);
            $total_pendapatan = $row['total_pendapatan'] ? $row['total_pendapatan'] : 0;
            echo "Rp ".number_format($total_pendapatan);
            ?>
        </div>
    </div>
    
    <div class="text-right mt-3">
        <?php
        $cetak_params = '';
        if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
            $cetak_params = "?tanggal_awal=" . $_GET['tanggal_awal'] . "&tanggal_akhir=" . $_GET['tanggal_akhir'];
        }
        ?>
        <a href="laporan_cetak.php<?php echo $cetak_params; ?>" target="_blank" class="btn btn-primary">Cetak Laporan</a>
    </div>
</div>