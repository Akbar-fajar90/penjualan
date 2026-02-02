<?php 
include '../koneksi.php';
$id = $_GET['id'];

// Cek dulu apakah barang ini ada di tabel penjualan
$cek = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_barang='$id'");

if(mysqli_num_rows($cek) > 0){
    // Jika ada di tabel penjualan, jangan hapus, arahkan kembali dengan pesan
    header("location:barang.php?pesan=gagal_hapus");
} else {
    // Jika tidak ada relasi, silakan hapus
    mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");
    header("location:barang.php?pesan=hapus");
}
?>