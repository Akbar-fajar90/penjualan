<?php 
include 'header_kasir.php'; 
include '../koneksi.php'; 
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus"></i> Transaksi Penjualan Baru</h4></div>
        <div class="panel-body">
            <form action="penjualan_aksi.php" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <input type="date" name="tgl_jual" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered" id="tabelBarang">
                    <thead>
                        <tr class="bg-info">
                            <th>Nama Barang</th>
                            <th width="15%">Harga Satuan</th>
                            <th width="10%">Jumlah</th>
                            <th width="20%">Subtotal</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="itemlist">
                        <tr>
                            <td>
                                <select name="id_barang[]" class="form-control select-barang" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?php 
                                    $barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE stok > 0");
                                    while($b = mysqli_fetch_array($barang)){
                                        echo "<option value='".$b['id_barang']."' data-harga='".$b['harga_jual']."'>".$b['nama_barang']." (Stok: ".$b['stok'].")</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="number" name="harga[]" class="form-control harga-satuan" readonly></td>
                            <td><input type="number" name="jumlah[]" class="form-control jumlah-jual" min="1" required></td>
                            <td><input type="number" name="subtotal[]" class="form-control subtotal" readonly></td>
                            <td></td> </tr>
                    </tbody>
                </table>
                
                <button type="button" class="btn btn-success btn-sm" id="addRow">
                    <i class="glyphicon glyphicon-plus"></i> Tambah Item Barang
                </button>

                <hr>
                <div class="row">
                    <div class="col-md-offset-8 col-md-4 text-right">
                        <h3>Total: Rp <span id="display_total">0</span></h3>
                        <input type="hidden" name="total_akhir" id="input_total">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="glyphicon glyphicon-floppy-disk"></i> Simpan Transaksi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(document).on('change', '.select-barang', function(){
        var harga = $(this).find(':selected').data('harga');
        $(this).closest('tr').find('.harga-satuan').val(harga);
        hitungBaris($(this).closest('tr'));
    });

    $(document).on('input', '.jumlah-jual', function(){
        hitungBaris($(this).closest('tr'));
    });

    function hitungBaris(row){
        var harga = row.find('.harga-satuan').val() || 0;
        var jumlah = row.find('.jumlah-jual').val() || 0;
        var subtotal = harga * jumlah;
        row.find('.subtotal').val(subtotal);
        hitungTotalSemua();
    }

    function hitungTotalSemua(){
        var totalAkhir = 0;
        $('.subtotal').each(function(){
            totalAkhir += parseFloat($(this).val() || 0);
        });
        $('#display_total').text(totalAkhir.toLocaleString());
        $('#input_total').val(totalAkhir);
    }

    $('#addRow').click(function(){
        var html = '<tr>' +
            '<td><select name="id_barang[]" class="form-control select-barang" required><option value="">-- Pilih Barang --</option><?php 
                $barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE stok > 0");
                while($b = mysqli_fetch_array($barang)){
                    echo "<option value=\"".$b['id_barang']."\" data-harga=\"".$b['harga_jual']."\">".$b['nama_barang']."</option>";
                }
            ?></select></td>' +
            '<td><input type="number" name="harga[]" class="form-control harga-satuan" readonly></td>' +
            '<td><input type="number" name="jumlah[]" class="form-control jumlah-jual" min="1" required></td>' +
            '<td><input type="number" name="subtotal[]" class="form-control subtotal" readonly></td>' +
            '<td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="glyphicon glyphicon-remove"></i></button></td>' +
            '</tr>';
        $('#itemlist').append(html);
    });

    $(document).on('click', '.removeRow', function(){
        $(this).closest('tr').remove();
        hitungTotalSemua();
    });
});
</script>