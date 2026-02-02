<?php
include "header.php";
include "../koneksi.php";
?>

<div class="container">
  <div class="panel">
    <div class="panel-heading">
      <h4>Data Transaksi Penjualan</h4>
    </div>
    <div class="panel-body">
      <a href="tambah_penjualan.php" class="btn btn-sm btn-primary pull-right">
        <i class="glyphicon glyphicon-plus"></i> Transaksi Baru
      </a>
      <br><br>
      <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th width="1%">No</th>
        <th>ID Jual</th>
        <th>Tanggal</th>
        <th>Nama Barang (Qty)</th> <th>Kasir</th>
        <th>Total Harga</th>
        <th width="15%">Opsi</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      // Query tetap sama, pastikan kolom 'jumlah' ada di tabel penjualan
      $data = mysqli_query($koneksi, "
        SELECT penjualan.*, barang.nama_barang, user.user_nama 
        FROM penjualan 
        JOIN barang ON penjualan.id_barang = barang.id_barang 
        JOIN user ON penjualan.user_id = user.user_id 
        ORDER BY penjualan.id_jual DESC
      ") or die(mysqli_error($koneksi));

      $no = 1;
      while ($d = mysqli_fetch_array($data)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td>PJL-<?php echo $d['id_jual']; ?></td>
        <td><?php echo date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
        
        <td>
            <?php echo $d['nama_barang']; ?> 
            <span class="label label-info"><?php echo $d['jumlah']; ?> Pcs</span>
        </td>
        
        <td><?php echo $d['user_nama']; ?></td>
        <td>Rp. <?php echo number_format($d['total_harga'], 0, ',', '.'); ?></td>
        <td>
          <a href="penjualan_cetak.php?id=<?php echo $d['id_jual']; ?>" 
             target="_blank" class="btn btn-sm btn-warning">
             <i class="glyphicon glyphicon-print"></i> Cetak
          </a>
          <a href="javascript:void(0);" 
             onclick="konfirmasiHapus(<?php echo $d['id_jual']; ?>)" 
             class="btn btn-sm btn-danger">
             <i class="glyphicon glyphicon-trash"></i>
          </a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
</table>
    </div>
  </div>
</div>

<script>
function konfirmasiHapus(id) {
  if (confirm("Membatalkan transaksi ini tidak akan mengembalikan stok secara otomatis. Yakin ingin menghapus?")) {
    window.location = "penjualan_hapus.php?id=" + id;
  }
}
</script>