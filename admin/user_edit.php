<?php
include("header.php");
include("../koneksi.php");
?>


<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit User</h4>
        </div>
        <div class="panel-body">
            <?php
                $id = $_GET['id'];
            $data = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$id'");
            while($d = mysqli_fetch_array($data)){
            ?>
            <form method="post" action="edit_user_aksi.php">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="hidden" name="id" value="<?php echo $d['user_id']; ?>">
                    <input type="text" class="form-control" name="user_nama" value="<?php echo $d['user_nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Ussername</label>
                    <input type="text" class="form-control" name="ussername" value="<?php echo $d['ussername']; ?>" required>
                </div>
                <div class= "form-group">
                    <label>User Status</label>
                    <select class="form-control" name="user_status" required>
                        <option value="2" <?php if ($d['user_status'] == '2') echo 'selected'; ?>>Kasir</option>
                        <option value="1" <?php if ($d['user_status'] == '1') echo 'selected'; ?>>Admin</option>
                    </select>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
                <a href="barang.php" class="btn btn-default">Kembali</a>
            </form>
        <?php 
        } 
        ?>
        </div>
    </div>
</div>