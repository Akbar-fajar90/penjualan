<?php   
$koneksi = mysqli_connect("localhost","root","","db_penjualan");

if ($koneksi->connect_error) {
     echo "Koneksi gagal: "
      . $koneksi->connect_error;
} else {
    echo "";
}
?>