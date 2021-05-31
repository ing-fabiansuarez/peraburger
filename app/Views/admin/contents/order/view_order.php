<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Pedido<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <br>
        <div class="row">
            <?php if (!empty(session('error'))) : ?>
                <div class="alert alert-danger alert-dismissible col-md-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> <?= session('error.title') ?></h5>
                    <?= session('error.body') ?>
                </div>
            <?php endif ?>
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title"><?= $order->id_order . '<br>' . $client['name_client'] . ' ' . $client['surname_client'] ?><br>DESPACHADO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-dark shadow-sm">
                                    <div class="card-header">
                                        TURNO: <b><?= $order->turnmachine_order ?></b><br>
                                    </div>
                                    <div class="card-body">

                                        <b>Fecha:</b> <?= $order->date_order . ' ' . $order->hour_order ?> <br>
                                        <b>Tipo de envio:</b> <?= $typeshipping['name_typeshipping'] ?>

                                    </div>
                                </div>
                                <?php if (isset($domi)) { ?>
                                    <div class="card card-dark shadow-sm">
                                        <div class="card-header">
                                            Domicilio<br>
                                        </div>
                                        <div class="card-body">

                                            <b>Direcci&oacute;n:</b> <?= $domi['address_domicilio'] ?> <br>
                                            <b>Barrio:</b> <?= $domi['neighborhood_domicilio'] ?><br>
                                            <b>Precio:</b> <?= $domi['price_domicilio'] ?><br>
                                            <b>WhatsApp:</b> <?= $domi['whatsapp_domicilio'] ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="card card-dark shadow-sm">
                                    <div class="card-header">
                                        Acciones:
                                    </div>
                                    <div class="card-body">

                                        <div class="row no-print">

                                            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                            <form action="<?= base_url() . route_to('print_order') ?>" method="post">
                                                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-download"></i> Generate PDF
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>




                            </div>
                            <div class="col-md-8 ">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Catidad</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0;
                                            foreach ($list_of_products as $item_list) : ?>
                                                <tr>

                                                    <td class="text-center">
                                                        <img src="<?= base_url() . route_to('img-menu') . '/' . $item_list['category_id_category'] . '/' . $item_list['image_product'] ?>" alt="" class="img-fluid prodimg">
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $item_list['quantity_detailorder'] ?>
                                                    </td>
                                                    <td>
                                                        <strong><?= $item_list['name_product'] ?></strong><br>
                                                        <?php
                                                        if (empty($item_list['whitout'])) :
                                                            $discounts = 0;
                                                        else : $discounts = 0;
                                                            foreach ($item_list['whitout'] as $without) :
                                                                $discounts = $discounts + $without['price_ingredient'];
                                                        ?>

                                                                Sin <?= $without['name_ingredient'] . ' - $ ' . number_format($without['price_ingredient']) . '<br>' ?>

                                                        <?php endforeach;
                                                        endif; ?>
                                                    </td>
                                                    <td class="float-right">
                                                        <?= '$ ' . number_format(($item_list['price_product'] * $item_list['quantity_detailorder']) - $discounts) ?>
                                                        <?php $total = $total + (($item_list['price_product'] * $item_list['quantity_detailorder']) - $discounts) ?>
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

                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>


            </div>

            <div class="col-md-7">


            </div>

        </div>
    </div>

</section>
<?= $this->endSection() ?>