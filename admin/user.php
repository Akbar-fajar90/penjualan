<?php
include "header.php";
include "../koneksi.php";
?>

<div class="container">
  <div class="panel">
    <div class="panel-heading">
      <h4>Data User / Petugas</h4>
    </div>
    <div class="panel-body">
      <a href="tambah_user.php" class="btn btn-sm btn-info pull-right">
        <i class="glyphicon glyphicon-plus"></i> Tambah User
      </a>
      <br><br>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="1%">No</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Status / Level</th>
            <th width="15%">Opsi</th>
          </tr>
        </thead>
        <tbody>
        <?php 

          $data = mysqli_query($koneksi, "SELECT * FROM user");
          $no = 1;
          while ($d = mysqli_fetch_array($data)) {
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['user_nama']; ?></td>
            <td><?php echo $d['ussername']; ?></td>
            <td>
              <?php 

                if($d['user_status'] == 1) {
                    echo "<span class='label label-primary'>Admin</span>";
                } else if($d['user_status'] == 2) {
                    echo "<span class='label label-warning'>Kasir</span>";
                }
              ?>
            </td>
            <td>
              <a href="user_edit.php?id=<?php echo $d['user_id']; ?>" 
                 class="btn btn-sm btn-info">Edit</a>
              <a href="javascript:void(0);" 
                 onclick="konfirmasiHapus(<?php echo $d['user_id']; ?>)" 
                 class="btn btn-sm btn-danger">
                <i class="glyphicon glyphicon-trash"></i> Hapus
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
  if (confirm("Apakah Anda yakin ingin menghapus user ini?")) {
    window.location = "user_hapus.php?id=" + id;
  }
}
</script>