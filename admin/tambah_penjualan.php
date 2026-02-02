<?php 
include 'header.php';
include '../koneksi.php'; 
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading"><h4>Transaksi Penjualan Baru</h4></div>
        <div class="panel-body">
            <form action="aksi_penjualan.php" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Jual</label>
                            <input type="date" name="tgl_jual" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kasir (User)</label>
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ussername']; ?>" readonly>
                            <input type="hidden" name="user_id" value="1"> </div>
                    </div>
                </div>

                <hr>
                <h4>Daftar Barang</h4>
                <table class="table table-bordered" id="tabelBarang">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th width="15%">Harga</th>
                            <th width="10%">Jumlah</th>
                            <th width="20%">Subtotal</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="itemlist">
                        <tr>
                            <td>
                                <select name="id_barang[]" class="form-control barang-select" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?php 
                                    $barang = mysqli_query($koneksi, "SELECT * FROM barang");
                                    while($b = mysqli_fetch_array($barang)){
                                        echo "<option value='".$b['id_barang']."' data-harga='".$b['harga_jual']."'>".$b['nama_barang']." (Stok: ".$b['stok'].")</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="number" name="harga[]" class="form-control harga" readonly></td>
                            <td><input type="number" name="jumlah[]" class="form-control jumlah" min="1" required></td>
                            <td><input type="number" name="subtotal[]" class="form-control subtotal" readonly></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-sm" id="addMore">Tambah Item</button>
                <hr>
                <div class="pull-right">
                    <h3>Total Harga: Rp. <span id="total_akhir">0</span></h3>
                    <input type="hidden" name="total_harga_input" id="total_harga_input">
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(document).on('change', '.barang-select', function(){
        var harga = $(this).find(':selected').data('harga');
        $(this).closest('tr').find('.harga').val(harga);
        hitungSubtotal($(this).closest('tr'));
    });

    $(document).on('input', '.jumlah', function(){
        hitungSubtotal($(this).closest('tr'));
    });

    function hitungSubtotal(row){
        var harga = row.find('.harga').val() || 0;
        var jumlah = row.find('.jumlah').val() || 0;
        var subtotal = harga * jumlah;
        row.find('.subtotal').val(subtotal);
        hitungTotalAkhir();
    }

    function hitungTotalAkhir(){
        var total = 0;
        $('.subtotal').each(function(){
            total += parseFloat($(this).val() || 0);
        });
        $('#total_akhir').text(total.toLocaleString());
        $('#total_harga_input').val(total);
    }

    $('#addMore').click(function(){
        var newRow = $('#itemlist tr:first').clone();
        newRow.find('input').val('');
        newRow.find('td:last').html('<button type="button" class="btn btn-danger btn-sm remove">X</button>');
        $('#itemlist').append(newRow);
    });

    $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
        hitungTotalAkhir();
    });
});
</script>