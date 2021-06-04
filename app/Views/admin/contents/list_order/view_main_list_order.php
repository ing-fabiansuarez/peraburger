<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Lista de Pedidos<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url() ?>/public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<?php if (session()->error) : ?>
    <div class="col-md-12 alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> <?= session('error.title') ?></h5>
        <?= session('error.body') ?>
    </div>
<?php endif; ?>
<?php if (session()->msg) :  ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> <?= session('msg.title') ?></h5>
        <?= session('msg.body') ?>
    </div>
<?php endif; ?>

<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Por pasar a la cocina</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Preparaci&oacute;n</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Despachado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-deshabilitado-tab" data-toggle="pill" href="#custom-tabs-one-deshabilitado" role="tab" aria-controls="custom-tabs-one-deshabilitado" aria-selected="false">Deshabilitado</a>
            </li>

        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <?= $this->include('admin/contents/list_order/list_state1') ?>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <?= $this->include('admin/contents/list_order/list_state2') ?>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                <?= $this->include('admin/contents/list_order/list_state3') ?>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-deshabilitado" role="tabpanel" aria-labelledby="custom-tabs-one-deshabilitado-tab">
                <?= $this->include('admin/contents/list_order/list_state4') ?>
            </div>

        </div>
    </div>
    <!-- /.card -->
</div>
<?= $this->endSection() ?>