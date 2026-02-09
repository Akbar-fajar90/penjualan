<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sistem Informasi Penjualan</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style = "background-color: darkgray;">
    <br><br><br>
    <center>
        <h2>SISTEM INFORMASI PENJUALAN <BR> REKAYASA PERANGKAT LUNAK SMKN 3 KENDAL</h2>
    </center>
    <br><br><br>
    <center>
                
    <?php
        session_start();
        if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
        echo "<p style='color: red; text-align:center;'>❌ Username atau password salah!</p>";}
    ?>

        <div class="container">
            <div class="col-md-4 col-md-offset-4">
                <form method="post" action="login.php">
                <div class="panel">
                    <br>
                    <div class="panel-heading">
                        <h4>Login Admin</h4>
                    </div>
                    <div class="panel-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="ussername" 
                               value="<?php echo isset($d['ussername']) ? $d['ussername'] : ''; ?>" 
                               placeholder="Masukkan Username" required>
                    </div>

                    <div class="form-group password-container" style="position: relative;">
                        <label>Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Masukkan Password Baru" required>

                        <i class="fa-solid fa-eye toggle-password" id="togglePassword"
                           style="position: absolute; top: 38px; right: 10px; cursor: pointer; color: #888;"></i>
                    </div>

                    <br>
                    <input type="submit" value="Log In" class="btn btn-primary">
                </div>
            </form>
            </div>
            </div>
        </div>
    </center>


</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

<style>
    .toggle-password:hover {
        color: #000;
    }
</style>
</html>