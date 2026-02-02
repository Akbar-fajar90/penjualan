<?php 
include 'header.php';
include '../koneksi.php'; 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4><i class="glyphicon glyphicon-briefcase"></i> Data Master Barang</h4>
            <a href="tambah_barang.php" class="btn btn-sm btn-primary">
                <i class="glyphicon glyphicon-plus"></i> Tambah Barang
            </a>
            <hr>
        </div>
    </div>

    <div class="row">
        <?php 
        $data = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang ASC");
        while ($d = mysqli_fetch_array($data)) {
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="panel panel-default" style="border-radius: 10px; overflow: hidden; transition: 0.3s; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div style="height: 200px; background: #eee; display: flex; align-items: center; justify-content: center;">
                    <?php if($d['foto'] != "") { ?>
                        <img src="../assets/img/barang/<?php echo $d['foto']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php } else { ?>
                        <i class="glyphicon glyphicon-picture" style="font-size: 50px; color: #ccc;"></i>
                    <?php } ?>
                </div>

                <div class="panel-body text-center">
                    <h4 style="margin-top: 0; font-weight: bold; height: 40px; overflow: hidden;">
                        <?php echo $d['nama_barang']; ?>
                    </h4>
                    
                    <p class="text-primary" style="font-size: 16px; font-weight: bold;">
                        Rp <?php echo number_format($d['harga_jual']); ?>
                    </p>

                    <div style="margin-bottom: 15px;">
                        <?php 
                        if($d['stok'] <= 5) {
                            echo "<span class='label label-danger'><i class='glyphicon glyphicon-warning-sign'></i> Stok: " . $d['stok'] . " (Kritis)</span>";
                        } else {
                            echo "<span class='badge' style='background-color: #5cb85c;'>Stok: " . $d['stok'] . "</span>";
                        }
                        ?>
                    </div>

                    <div class="btn-group btn-group-justified">
                        <a href="barang_edit.php?id=<?php echo $d['id_barang']; ?>" class="btn btn-info">
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
                        <a href="javascript:void(0);" onclick="konfirmasiHapus(<?php echo $d['id_barang']; ?>)" class="btn btn-danger">
                            <i class="glyphicon glyphicon-trash"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
function konfirmasiHapus(id) {
    if (confirm("Menghapus barang ini dapat mengganggu data di riwayat penjualan. Lanjutkan?")) {
        window.location = "barang_hapus.php?id=" + id;
    }
}
</script>

<style>
    /* Efek hover agar card sedikit terangkat saat disentuh kursor */
    .panel-default:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2) !important;
    }
</style>