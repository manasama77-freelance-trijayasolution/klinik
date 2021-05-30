<link href="<?= base_url(); ?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
<style>
    .modal-large {
        width: 800px;
        margin-left: -360px;
    }

    .modal-backdrop,
    modal-backdrop.fade.in {
        background-color: rgba(0, 0, 0, .7);
    }
</style>

<div class="container">
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><?= $this->session->flashdata('success'); ?></h4>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('fail')) { ?>
        <div class="alert alert-block alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><?= $this->session->flashdata('fail'); ?></h4>
        </div>
    <?php } ?>
    <div class="row-fluid">
        <div class="span9">
            <div class="block">
                <div class="navbar">
                    <div class="navbar-inner">
                        <h4>List Expense</h4>
                    </div>
                </div>

                <div class="block-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Expense</th>
                                <th>Nama Barang</th>
                                <th>Nama Supplier</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Biaya Tambahan</th>
                                <th>Sub Total</th>
                                <th style="text-align: center; width: 100px;">
                                    <i class="icon-cog"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($arr_expense->num_rows() == 0) { ?>
                                <tr>
                                    <td colspan="9" style="text-align: center;">-Data Empty-</td>
                                </tr>
                            <?php } else { ?>
                                <?php
                                $no = 1;
                                foreach ($arr_expense->result() as $key) {
                                    $tgl_obj = new DateTime($key->created_at);
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $tgl_obj->format('Y-m-d'); ?></td>
                                        <td><?= $key->nama_barang; ?></td>
                                        <td><?= $key->nama_supplier; ?></td>
                                        <td><?= number_format($key->qty, 0); ?></td>
                                        <td><?= number_format($key->harga, 0); ?></td>
                                        <td><?= number_format($key->biaya_tambahan, 0); ?></td>
                                        <td><?= number_format($key->sub_total, 0); ?></td>
                                        <td style="text-align: center; width: 100px;">
                                            <button type="button" class="btn btn-mini btn-info" onclick="modalEdit('<?= $key->id; ?>', '<?= $tgl_obj->format('Y-m-d'); ?>', '<?= $key->nama_barang; ?>', '<?= $key->nama_supplier; ?>', '<?= $key->qty; ?>', '<?= $key->harga; ?>', '<?= $key->biaya_tambahan; ?>', '<?= $key->sub_total; ?>');">Edit</button>
                                            <button type="button" class="btn btn-mini btn-danger" onclick="processDelete('<?= $key->id; ?>', '<?= $key->nama_barang; ?>');">Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="span3">
            <div class="block">
                <div class="navbar">
                    <div class="navbar-inner">
                        <h4>Add Expense</h4>
                    </div>
                </div>

                <div class="block-content">
                    <form id="form_add" action="<?= site_url(); ?>expense/add" method="post">
                        <fieldset>

                            <label for="created_at">Tgl Expense</label>
                            <input type="date" class="input-block-level" placeholder="Tgl Expense" id="created_at" name="created_at" required>

                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="input-block-level" placeholder="Nama Barang" id="nama_barang" name="nama_barang" required>

                            <label for="nama_supplier">Nama Supplier</label>
                            <input type="text" class="input-block-level" placeholder="Nama Supplier" id="nama_supplier" name="nama_supplier" required>

                            <label for="qty">QTY</label>
                            <input type="number" min="1" max="1000" class="input-block-level" placeholder="QTY" id="qty" name="qty" onchange="update_sub_total();" required>

                            <label for="harga">Harga</label>
                            <input type="number" min="1" class="input-block-level" placeholder="Harga" id="harga" name="harga" onchange="update_sub_total();" required>

                            <label for="biaya_tambahan">Biaya Tambahan</label>
                            <input type="number" min="1" class="input-block-level" placeholder="Biaya Tambahan" id="biaya_tambahan" name="biaya_tambahan" onchange="update_sub_total();" required>

                            <label for="sub_total">Sub Total</label>
                            <input type="text" class="input-block-level" placeholder="Sub Total" id="sub_total" name="sub_total" value="0" required readonly>

                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </fieldset>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<form action="<?= site_url(); ?>expense/update" method="post">
    <div id="modal_edit" class="modal hide fade" tabindex="-1" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="icon-remove-sign"></i>
            </button>
            <h3>Edit Expense</h3>
        </div>
        <div class="modal-body">
            <fieldset>
                <label for="created_at_edit">Tgl Expense</label>
                <input type="date" class="input-block-level" placeholder="Tgl Expense" id="created_at_edit" name="created_at_edit" required>

                <label for="nama_barang_edit">Nama Barang</label>
                <input type="text" class="input-block-level" placeholder="Nama Barang" id="nama_barang_edit" name="nama_barang_edit" required>

                <label for="nama_supplier_edit">Nama Supplier</label>
                <input type="text" class="input-block-level" placeholder="Nama Supplier" id="nama_supplier_edit" name="nama_supplier_edit" required>

                <label for="qty_edit">QTY</label>
                <input type="number" min="1" max="1000" class="input-block-level" placeholder="QTY" id="qty_edit" name="qty_edit" onchange="update_sub_total_edit();" required>

                <label for="harga_edit">Harga</label>
                <input type="number" min="1" class="input-block-level" placeholder="Harga" id="harga_edit" name="harga_edit" onchange="update_sub_total_edit();" required>

                <label for="biaya_tambahan_edit">Biaya Tambahan</label>
                <input type="number" min="1" class="input-block-level" placeholder="Biaya Tambahan" id="biaya_tambahan_edit" name="biaya_tambahan_edit" onchange="update_sub_total_edit();" required>

                <label for="sub_total_edit">Sub Total</label>
                <input type="text" class="input-block-level" placeholder="Sub Total" id="sub_total_edit" name="sub_total_edit" value="0" required readonly>
            </fieldset>
        </div>
        <div class="modal-footer">
            <input type="hidden" id="id_edit" name="id_edit" value="">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url(); ?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>design/assets/scripts.js"></script>
<script src="<?= base_url(); ?>design/assets/DT_bootstrap.js"></script>
<script src="<?= base_url(); ?>public/vendor/blockui/jquery.blockUI.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {

    });

    function update_sub_total() {
        let qty = ($('#qty').val() != '') ? $('#qty').val() : 0;
        let harga = ($('#harga').val() != '') ? $('#harga').val() : 0;
        let biaya_tambahan = ($('#biaya_tambahan').val() != '') ? $('#biaya_tambahan').val() : 0;
        let sub_total = 0;

        if (qty != '' || qty != 0) {
            if (harga != '' || harga != 0) {
                sub_total = qty * parseInt(harga) + parseInt(biaya_tambahan);
            }
        }

        $('#sub_total').val(sub_total);
    }

    function update_sub_total_edit() {
        let qty_edit = ($('#qty_edit').val() != '') ? $('#qty_edit').val() : 0;
        let harga_edit = ($('#harga_edit').val() != '') ? $('#harga_edit').val() : 0;
        let biaya_tambahan_edit = ($('#biaya_tambahan_edit').val() != '') ? $('#biaya_tambahan_edit').val() : 0;
        let sub_total_edit = 0;

        if (qty_edit != '' || qty_edit != 0) {
            if (harga_edit != '' || harga_edit != 0) {
                sub_total_edit = qty_edit * parseInt(harga_edit) + parseInt(biaya_tambahan_edit);
            }
        }

        $('#sub_total_edit').val(sub_total_edit);
    }

    function modalEdit(id, created_at, nama_barang, nama_supplier, qty, harga, biaya_tambahan, sub_total) {
        $('#id_edit').val(id);
        $('#created_at_edit').val(created_at);
        $('#nama_barang_edit').val(nama_barang);
        $('#nama_supplier_edit').val(nama_supplier);
        $('#qty_edit').val(qty);
        $('#harga_edit').val(harga);
        $('#biaya_tambahan_edit').val(biaya_tambahan);
        $('#sub_total_edit').val(sub_total);
        $('#modal_edit').modal('show');
    }

    function processDelete(id, name) {
        swal({
                title: 'Delete ?',
                text: `Delete Expense "${name}" ?`,
                icon: 'warning',
                buttons: true,
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    $.ajax({
                        url: `<?= site_url(); ?>expense/delete`,
                        method: 'post',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        beforeSend: function() {
                            $.blockUI();
                        }
                    }).always(function(e) {
                        $.unblockUI();
                    }).fail(function(e) {
                        console.log(e);
                    }).done(function(e) {
                        swal(e.msg, '', 'info').then((value) => {
                            window.location.reload();
                        });
                    });
                }
            });
    }
</script>