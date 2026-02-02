<?php 
session_start();
include '../koneksi.php';

$tgl_jual     = $_POST['tgl_jual'];
$id_user      = $_SESSION['user_id']; 
$id_barang_v  = $_POST['id_barang'];
$jumlah_v     = $_POST['jumlah'];
$subtotal_v   = $_POST['subtotal'];


for($i = 0; $i < count($id_barang_v); $i++){
    $id_barang  = $id_barang_v[$i];
    $qty        = $jumlah_v[$i];
    $total_harga = $subtotal_v[$i];


    mysqli_query($koneksi, "INSERT INTO penjualan (id_barang, tgl_jual, total_harga, user_id) 
                            VALUES ('$id_barang', '$tgl_jual', '$total_harga', '$id_user')") 
                            or die(mysqli_error($koneksi));


    mysqli_query($koneksi, "UPDATE barang SET stok = stok - $qty WHERE id_barang = '$id_barang'") 
                            or die(mysqli_error($koneksi));
}

header("location:penjualan.php?pesan=berhasil");
?>