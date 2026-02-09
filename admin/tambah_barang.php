<?php include 'header.php'; ?>

<div class="container">
    <div class="panel">
        <div class="panel-heading"><h4>Tambah Barang Baru</h4></div>
        <div class="panel-body">
            <form method="post" action="aksi_barang.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Foto Barang</label>
                    <input type="file" name="foto" class="form-control">
                    <small class="text-muted">Format: jpg, png, jpeg. Maks: 2MB</small>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input type="number" class="form-control" name="harga_jual" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" class="form-control" name="stok" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
                <a href="barang.php" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
</div>