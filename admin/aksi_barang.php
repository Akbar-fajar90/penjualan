<?php 
include '../koneksi.php';

$nama = $_POST['nama'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$stok = $_POST['stok'];


$rand = rand();
$allowed = array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

if($filename == ""){
    
    mysqli_query($koneksi, "INSERT INTO barang VALUES(NULL, '$nama', '', '$harga_beli', '$harga_jual', '$stok')");
    header("location:barang.php?pesan=berhasil");
} else {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(in_array($ext, $allowed)){
        $file_gambar = $rand.'_'.$filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/barang/'.$file_gambar);
        mysqli_query($koneksi, "INSERT INTO barang VALUES(NULL, '$nama', '$file_gambar', '$harga_beli', '$harga_jual', '$stok')");
        header("location:barang.php?pesan=berhasil");
    } else {
        header("location:barang.php?pesan=gagal_ekstensi");
    }
}
?>