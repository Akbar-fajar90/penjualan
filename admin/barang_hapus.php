<?php 
include '../koneksi.php';
$id = $_GET['id'];


$cek = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_barang='$id'");

if(mysqli_num_rows($cek) > 0){

    header("location:barang.php?pesan=gagal_hapus");
} else {

    mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");
    header("location:barang.php?pesan=hapus");
}
?>