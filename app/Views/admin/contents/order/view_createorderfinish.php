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
                        <?php } ?>
                        <a href="<?= base_url() . route_to('view_createorder') ?>">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    ATRAS
                                </button>
                            </div>
                        </a>



                        <!-- <div class="text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                    CREAR PEDIDO
                                </button>
                            </div>
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Deseas crear el nuevo pedido?</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Debes cobrar <strong><?= '$ ' . number_format($total) ?></strong></p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary">Si, crear</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">PASO 3: INFORMACION DEL PEDIDO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <input type="text" class="form-control" placeholder="Cedula">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control">
                                            <option>Local</option>
                                            <option>Domicilio</option>
                                          
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Textarea</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Textarea Disabled</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- input states -->
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
                                    success</label>
                                <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
                                    warning</label>
                                <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
                                    error</label>
                                <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Checkbox</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" checked="">
                                            <label class="form-check-label">Checkbox checked</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" disabled="">
                                            <label class="form-check-label">Checkbox disabled</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- radio -->
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radio1">
                                            <label class="form-check-label">Radio</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radio1" checked="">
                                            <label class="form-check-label">Radio checked</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" disabled="">
                                            <label class="form-check-label">Radio disabled</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Select</label>
                                        <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select Disabled</label>
                                        <select class="form-control" disabled="">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Select multiple-->
                                    <div class="form-group">
                                        <label>Select Multiple</label>
                                        <select multiple="" class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select Multiple Disabled</label>
                                        <select multiple="" class="form-control" disabled="">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>

            </div>



        </div>
    </div>

</section>
<?= $this->endSection() ?>