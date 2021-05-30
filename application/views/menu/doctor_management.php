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
        <div class="span8">
            <div class="block">
                <div class="navbar">
                    <div class="navbar-inner">
                        <h4>List Doctor</h4>
                    </div>
                </div>

                <div class="block-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Doctor Name</th>
                                <th style="text-align: center; width: 100px;">
                                    <i class="icon-cog"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($arr_doctor->num_rows() == 0) { ?>
                                <tr>
                                    <td colspan="2" style="text-align: center;">-Data Empty-</td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($arr_doctor->result() as $key) { ?>
                                    <tr>
                                        <td><?= $key->drname; ?></td>
                                        <td style="text-align: center; width: 100px;">
                                            <button type="button" class="btn btn-mini btn-info" onclick="modalEdit('<?= $key->id_dr; ?>', '<?= $key->drname; ?>');">Edit</button>
                                            <button type="button" class="btn btn-mini btn-danger" onclick="processDelete('<?= $key->id_dr; ?>', '<?= $key->drname; ?>');">Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="span4">
            <div class="block">
                <div class="navbar">
                    <div class="navbar-inner">
                        <h4>Add Doctor</h4>
                    </div>
                </div>

                <div class="block-content">
                    <form id="form_add" action="<?= site_url(); ?>doctor/add" method="post">
                        <fieldset>
                            <label for="drname">Doctor Name</label>
                            <input type="text" class="input-block-level" placeholder="Doctor Name" id="drname" name="drname" required>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </fieldset>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<form action="<?= site_url(); ?>doctor/update" method="post">
    <div id="modal_edit" class="modal hide fade" tabindex="-1" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="icon-remove-sign"></i>
            </button>
            <h3>Edit Doctor</h3>
        </div>
        <div class="modal-body">
            <fieldset>
                <label for="drname_edit">Doctor Name</label>
                <input type="text" class="input-block-level" placeholder="Doctor Name" id="drname_edit" name="drname_edit" required>
            </fieldset>
        </div>
        <div class="modal-footer">
            <input type="hidden" id="id_dr_edit" name="id_dr_edit" value="">
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

    function modalEdit(id, name) {
        $('#id_dr_edit').val(id);
        $('#drname_edit').val(name);
        $('#modal_edit').modal('show');
    }

    function processDelete(id, name) {
        swal({
                title: 'Delete ?',
                text: `Delete Doctor "${name}" ?`,
                icon: 'warning',
                buttons: true,
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    $.ajax({
                        url: `<?= site_url(); ?>doctor/delete`,
                        method: 'post',
                        dataType: 'json',
                        data: {
                            id_dr: id
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