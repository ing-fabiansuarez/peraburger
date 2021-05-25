<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Nuevo Pedido<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url() ?>/public/admin/dist/js/ajax_product.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Crear Nuevo Pedido</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Pedido</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-3">

                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Agregar Producto</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <form class="form-client" action="<?= base_url() . route_to('addproductlistorder') ?>" method="post">

                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Categor&iacute;a</label>
                                <div class="col-sm-12">
                                    <select id="categories-select" name="categories-select" class="form-control">
                                        <?php foreach ($categories as $cat) { ?>
                                            <option value="<?= $cat['id_category'] ?>"><?= $cat['name_category'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Producto</label>
                                <div class="col-sm-12">
                                    <select name='productossss' id='productossss' class='form-control' required></select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Sin...</label>
                                <div class="select2-purple">

                                    <select  name='ingredients-div[]' id='ingredients-div' class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    AGREGAR
                                </button>
                            </div>

                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>

            <div class="col-md-9">
                <div class="card card-dark shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">LISTA DEL PEDIDO</h3>

                    </div>
                    <div class="card-body">
                        <div class="card-body table-responsive p-0" style="height: 59vh;">
                            <table class="table table-head-fixed table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>numero</th>
                                        <th>Producto</th>
                                        <th>Observaci&oacute;n</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>
                                            <img src="https://www.tienda.peradk.com/public/pictures/miniatures/14-1054-Serenidad.jpg" alt="ne" class="img-fluid prodimg">
                                        </td>
                                        <td>
                                            <input type="hidden" name="reference" value="1054">
                                            1054
                                        </td>
                                        <td>
                                            <input name="nameproduct" type="text" class="form-control" value="Serenidad">
                                        </td>
                                        <td>
                                            <input type="hidden" name="idcategory" value="14">
                                            14
                                        </td>
                                        <td>

                                            <input name="activeproduct" type="text" class="form-control" value="si">

                                        </td>
                                        <td>
                                            <button type="submit" style="border-color: transparent; background: transparent;">
                                                <i class="far fa-save action-product icon-green"></i>
                                            </button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection() ?>