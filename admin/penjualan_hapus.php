<?php 
include '../koneksi.php';

$id = $_GET['id'];


$data = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_jual='$id'");
$d = mysqli_fetch_array($data);

$id_barang = $d['id_barang'];
$jumlah_beli = $d['jumlah']; 



mysqli_query($koneksi, "UPDATE barang SET stok = stok + $jumlah_beli WHERE id_barang='$id_barang'");


mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_jual='$id'");
header("location:penjualan.php?pesan=hapus");
?>