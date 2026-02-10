<?php
include("../koneksi.php");
include("header.php");


$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';
?>

<body>

    <center>
        <h2>LAPORAN PENJUALAN</h2>
        
        <?php if (!empty($tanggal_awal) && !empty($tanggal_akhir)): ?>
            <h4>Periode: <?php echo date('d-m-Y', strtotime($tanggal_awal)); ?> s/d <?php echo date('d-m-Y', strtotime($tanggal_akhir)); ?></h4>
        <?php endif; ?>
        
        <p>Dicetak oleh: <?php echo $_SESSION['username']; ?> pada <?php echo date('d-m-Y H:i:s'); ?></p>
    </center>

    <br/>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="1%">NO</th>
                <th>Invoice</th>
                <th>Kasir</th>
                <th>Barang</th>
                <th>Tgl. Transaksi</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $id_user = $_SESSION["user_id"];
            
            $query = "
                SELECT penjualan.*, barang.nama_barang, user.user_nama 
                FROM penjualan 
                JOIN barang ON penjualan.id_barang = barang.id_barang 
                JOIN user ON penjualan.user_id = user.user_id
                WHERE penjualan.user_id = '$id_user' 
            ";
            
            if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
                $query .= " AND DATE(penjualan.tgl_jual) BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ";
            }
            
            $query .= " ORDER BY penjualan.id_jual DESC";
            
            $data = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
            
            $no = 1;
            $grand_total = 0;
            while ($d = mysqli_fetch_array($data)) {
                $grand_total += $d['total_harga'];
            ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo "INV-".$d['id_jual']; ?></td>
                <td><?php echo $d['user_nama']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                <td class="text-right">Rp <?php echo number_format($d['total_harga']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">TOTAL PENDAPATAN 
                    <?php if (!empty($tanggal_awal) && !empty($tanggal_akhir)): ?>
                        (<?php echo date('d-m-Y', strtotime($tanggal_awal)); ?> - <?php echo date('d-m-Y', strtotime($tanggal_akhir)); ?>)
                    <?php endif; ?>
                </th>
                <th class="text-right">Rp <?php echo number_format($grand_total); ?></th>
            </tr>
        </tfoot>
    </table>

    <br/>
    
    <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4 text-center">
            <p>Tertanda,</p>
            <br/><br/><br/>
            <p><b><?php echo $_SESSION['username']; ?></b></p>
        </div>
    </div>

    <script>
        window.print();
    </script>

</body>