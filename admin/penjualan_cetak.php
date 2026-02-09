<?php
include("../koneksi.php");
include("header.php");
?>

<body>

    <?php 
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "
        SELECT penjualan.*, barang.nama_barang, barang.harga_jual, user.user_nama 
        FROM penjualan 
        JOIN barang ON penjualan.id_barang = barang.id_barang 
        JOIN user ON penjualan.user_id = user.user_id 
        WHERE penjualan.id_jual = '$id'
    ");
    $d = mysqli_fetch_array($query);
    ?>

    <div class="text-center">
        <strong>SKANEGA POS</strong><br>
        Jl. Raya No. 123, Ungaran<br>
        Telp: 08123456789
    </div>
    <hr>
    
    <table>
        <tr>
            <td>No. Nota</td>
            <td>: PJL-<?php echo $d['id_jual']; ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: <?php echo date('d/m/Y', strtotime($d['tgl_jual'])); ?></td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>: <?php echo $d['user_nama']; ?></td>
        </tr>
    </table>
    
    <hr>

    <table>
        <tr>
            <td colspan="2"><?php echo $d['nama_barang']; ?></td>
        </tr>
        <tr>
            <td>1 Pcs x <?php echo number_format($d['harga_jual'], 0, ',', '.'); ?></td>
            <td class="text-right"><?php echo number_format($d['total_harga'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <hr>
    <table>
        <tr>
            <td><strong>TOTAL HARGA</strong></td>
            <td class="text-right"><strong>Rp. <?php echo number_format($d['total_harga'], 0, ',', '.'); ?></strong></td>
        </tr>
    </table>

    <div class="footer text-center">
        <hr>
        *** TERIMA KASIH ***<br>
        Barang yang sudah dibeli tidak<br>
        dapat ditukar/dikembalikan.
    </div>

    <script type="text/javascript">
        window.print();
        window.onafterprint = function() { window.close(); }
    </script>

</body>