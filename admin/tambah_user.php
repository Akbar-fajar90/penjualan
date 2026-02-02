<!DOCTYPE html>
<html>
<head>
    <title>Tambah User - Sistem Penjualan</title>
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="panel" style="margin-top: 50px;">
            <div class="panel-heading">
                <h4>Tambah User Baru</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-6 col-md-offset-3">
                    <form action="aksi_user.php" method="post">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_user" class="form-control" placeholder="Masukkan nama lengkap.." required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="ussername" class="form-control" placeholder="Masukkan username.." required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password.." required>
                        </div>
                        <div class="form-group">
                            <label>Status User</label>
                            <select name="user_status" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Admin (Full Akses)</option>
                                <option value="2">Kasir (Penjualan)</option>
                            </select>
                            <p class="help-block">1 = Admin, 2 = Kasir</p>
                        </div>
                        
                        <br/>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                        <a href="user.php" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>