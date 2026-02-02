<?php 
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$stok = $_POST['stok'];

$rand = rand();
$allowed = array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

if($filename == ""){
    
    mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok' WHERE id_barang='$id'");
    header("location:barang.php?pesan=update");
} else {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(in_array($ext, $allowed)){
        
        $lama = mysqli_query($koneksi, "SELECT foto FROM barang WHERE id_barang='$id'");
        $l = mysqli_fetch_array($lama);
        if($l['foto'] != "") { unlink('../assets/img/barang/'.$l['foto']); }

        $file_gambar = $rand.'_'.$filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/barang/'.$file_gambar);
        
        mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama', foto='$file_gambar', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok' WHERE id_barang='$id'");
        header("location:barang.php?pesan=update");
    } else {
        header("location:barang.php?pesan=gagal_ekstensi");
    }
}
?>