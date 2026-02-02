<?php 
include 'header.php'; 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'");
while($d = mysqli_fetch_array($data)){
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading"><h4>Edit Data Barang</h4></div>
        <div class="panel-body">
            <form method="post" action="edit_barang_aksi.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $d['id_barang']; ?>">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $d['nama_barang']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Foto Barang (Kosongkan jika tidak diganti)</label>
                    <br>
                    <?php if($d['foto'] != ""){ ?>
                        <img src="../assets/img/barang/<?php echo $d['foto']; ?>" style="width: 100px; margin-bottom: 10px;">
                    <?php } ?>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" value="<?php echo $d['harga_beli']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input type="number" class="form-control" name="harga_jual" value="<?php echo $d['harga_jual']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" class="form-control" name="stok" value="<?php echo $d['stok']; ?>" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Update Data">
                <a href="barang.php" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?php } ?>