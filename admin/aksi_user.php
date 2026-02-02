<?php 
include '../koneksi.php';

$nama     = $_POST['nama_user'];
$username = $_POST['ussername'];
$password = $_POST['password']; 
$status   = $_POST['user_status'];


mysqli_query($koneksi, "INSERT INTO user (user_nama, ussername, password, user_status) 
            VALUES ('$nama', '$username', '$password', '$status')") 
            or die(mysqli_error($koneksi));

header("location:user.php?pesan=berhasil");
?>