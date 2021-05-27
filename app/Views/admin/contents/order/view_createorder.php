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
            <?php if (!empty(session('error'))) : ?>
                <div class="alert alert-danger alert-dismissible col-md-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> <?= session('error.title') ?></h5>
                    <?= session('error.body') ?>
                </div>
            <?php endif ?>

            <div class="col-md-6">

                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">PASO 1: Agregar Producto</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <form class="form-client" action="<?= base_url() . route_to('addproductlistorder') ?>" method="post">

                            <div class="form-group row">
                                <label>Categor&iacute;a</label>
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
                                <label>Producto</label>
                                <div class="col-sm-12">
                                    <select name='products-select' id='products-select' class='form-control' required></select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Sin...</label>
                                <div class="select2-purple">
                                    <select name='ingredients-div[]' id='ingredients-div' class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label>Cantidad</label>
                                <div class="col-sm-12">
                                    <select name="quantity" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <p class="text-danger"></p>
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

            <div class="col-md-6">

                <div class="card card-dark shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">PASO 2: LISTA DEL PEDIDO</h3>

                    </div>
                    <div class="card-body padding-0">
                        <?php if (empty($list_order)) { ?>

                        <?php } else { ?>
                            <div class="card-body table-responsive p-0" style="height: 59vh;">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Catidad</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0;
                                        foreach ($list_order as $item_list) : ?>
                                            <tr>

                                                <td class="text-center">
                                                    <img src="<?= base_url() . route_to('img-menu') . '/' . $item_list['category_id_category'] . '/' . $item_list['image_product'] ?>" alt="" class="img-fluid prodimg">
                                                </td>
                                                <td class="text-center">
                                                    <?= $item_list['quantity'] ?>
                                                </td>
                                                <td>
                                                    <strong><?= $item_list['name_product'] ?></strong><br>
                                                    <?php if (empty($item_list['whitout_ingredients'])) :
                                                        $discounts = 0;
                                                    else : $discounts = 0;
                                                        foreach ($item_list['whitout_ingredients'] as $without) :
                                                            $discounts = $discounts + $without['price_ingredient'];
                                                    ?>
                                                            Sin <?= $without['name_ingredient'] . ' - $ ' . number_format($without['price_ingredient']) . '<br>' ?>

                                                    <?php endforeach;
                                                    endif; ?>
                                                </td>
                                                <td class="float-right">
                                                    <?= '$ ' . number_format(($item_list['price_product'] * $item_list['quantity']) - $discounts) ?>
                                                    <?php $total = $total + (($item_list['price_product'] * $item_list['quantity']) - $discounts) ?>
                                                </td>
                                                <td>
                                                    <form action="<?= base_url() . route_to('deleteproductlistorder') ?>" method="post">
                                                        <input type="hidden" name="id" value="<?= $item_list['id_list_order'] ?>">
                                                        <button type="submit" style="border-color: transparent; background: transparent;">
                                                            <i class="far fa-times-circle action-product icon-green"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                <strong>TOTAL</strong>
                                            </td>
                                            <td>
                                            </td>
                                            <td class="float-right">
                                                <strong> <?= '$ ' . number_format($total) ?></strong>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <form action="<?= base_url() . route_to('view_createorder_finish') ?>" method="post">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        CREAR PEDIDO
                                    </button>
                                </div>
                            </form>
                        <?php } ?>

                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<?= $this->endSection() ?>