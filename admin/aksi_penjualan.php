<?php 
include '../koneksi.php';
session_start();


$tgl_jual     = $_POST['tgl_jual'];
$user_id      = $_POST['user_id'];
$total_harga  = $_POST['total_harga_input'];

$id_barang_array = $_POST['id_barang'];
$jumlah_array    = $_POST['jumlah'];
$harga_array     = $_POST['harga'];

foreach($id_barang_array as $key => $id_barang) {
    
    $jumlah = $jumlah_array[$key];
    $harga  = $harga_array[$key];
    $subtotal = $jumlah * $harga;

    $query = "INSERT INTO penjualan (tgl_jual, id_barang, user_id, jumlah, total_harga) 
              VALUES ('$tgl_jual', '$id_barang', '$user_id', '$jumlah', '$subtotal')";
    
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

    mysqli_query($koneksi, "UPDATE barang SET stok = stok - $jumlah WHERE id_barang = '$id_barang'");
}
header("location:penjualan.php?pesan=berhasil");
?>