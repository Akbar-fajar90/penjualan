<?php
include("../koneksi.php");

$id = $_POST["id"];
$nama = $_POST["user_nama"];
$ussername = $_POST["ussername"];
$user_status = $_POST["user_status"];

$query = "UPDATE user SET user_nama='$nama', ussername='$ussername', user_status='$user_status' WHERE user_id='$id'";
$result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: user.php");
    } else {
        echo "Gagal mengupdate data";
    }
?>