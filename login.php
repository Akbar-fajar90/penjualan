<?php
session_start();
include 'koneksi.php';

$username = $_POST['ussername']; 
$password = $_POST['password']; 


$query = mysqli_query($koneksi, "SELECT * FROM user WHERE ussername='$username' AND password='$password'") 
         or die(mysqli_error($koneksi));

$cek = mysqli_num_rows($query);

if ($cek > 0) {

    $data = mysqli_fetch_assoc($query);
    

    $_SESSION['ussername'] = $username;
    $_SESSION['status'] = "Login";
    $_SESSION['level'] = $data['user_status']; 
    $_SESSION['user_id'] = $data['user_id'];


    if ($data['user_status'] == 1) {

        header("Location: admin/index.php");
    } else if ($data['user_status'] == 2) {

        header("Location: kasir/index.php");
    } else {

        header("Location: index.php?pesan=akses_ditolak");
    }
    exit;
} else {
    header("Location: index.php?pesan=gagal");
    exit;
}