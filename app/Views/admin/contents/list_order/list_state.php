<div class="card">
    <div class="card-header header-list">
        <h3 class="card-title" style="color: #fff;"> <b> LOCAL</b></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body body-background">
        <table id="example1" class="table table-bordered table-striped projects">
            <thead>
                <tr>
                    <th>Turno</th>
                    <th style="width: 10px;">Cant</th>
                    <th>N° Pedido</th>
                    <th>Detalle</th>
                    <th>Hora</th>
                    <th>Obser.</th>
                    <th>Precio</th>
                    <th>Acci&oacute;n</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($dailyOrdersLocal as $order) : //dd($dailyorders); 
                ?>

                    <tr>
                        <td>
                            <small style="font-size: 50px;"><?= $order->turnmachine_order ?></small>
                        </td>
                        <td>
                            <?= count($list_products = $order->getListofProducts()) ?>
                        </td>
                        <td><?= $order->id_order . '<br><b>' . $order->getNameClient() . '</b>' ?></td>
                        <td>
                            <ul class="list-inline">
                                <?php foreach ($list_products as $item) :  ?>
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="<?= base_url() . route_to('img-menu') . '/' . $item['category_id_category'] . '/' . $item['image_product'] ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td>
                            <?= $order->hour_order . '<br>' . $order->date_order . '<br><b>' . $order->getNameEmployee() . '</b>' ?>
                        </td>
                        <td style="max-width: 100px;"><?= $order->observations_order ?></td>
                        <td><?= '$ ' . number_format($order->getTotalWthitOutDomicilio()) ?></td>

                        <td class="project-actions text-right">

                            <a class="btn btn-primary btn-sm" href="<?= base_url() . route_to('view_load_order', $order->id_order) ?>">
                                <i class="fas fa-folder">
                                </i>
                                Ver
                            </a>
                            <?php if ($order->state_id_state == 1) : ?>
                                <a class="btn btn-danger btn-sm" href="<?= base_url() . route_to('chage_state', 4, $order->id_order) ?>">
                                    <i class="fas fa-trash">
                                    </i>
                                    Deshabilitar
                                </a>
                            <?php endif; ?>
                            <?php if ($order->state_id_state == 1) : ?>
                                <a class="btn btn-info btn-sm" href="<?= base_url() . route_to('print_kitchen', $order->id_order) ?>">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Pasar a Cocina
                                </a>
                            <?php endif; ?>
                            <?php if ($order->state_id_state == 1 or $order->state_id_state == 2) : ?>
                                <a class="btn btn-info btn-sm" href="<?= base_url() . route_to('chage_state', 3, $order->id_order) ?>">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Despachar
                                </a>
                            <?php endif; ?>

                        </td>
                        <td>
                            <form action="<?= base_url() . route_to('print_order') ?>" method="post" target="_blank">
                                <input type="hidden" name="reference" value="<?= $order->id_order ?>">
                                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px; margin-bottom: 5px;">
                                    <i class="fas fa-download"></i>Imprimir
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
</div>
<div class="card">
    <div class="card-header header-list">
        <h3 class="card-title" style="color: #fff;"> <b> DOMICILIO</b></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body body-background">
        <table id="example2" class="table table-bordered table-striped projects">
            <thead>
                <tr>
                    <th>Turno</th>
                    <th style="width: 10px;">Cant</th>
                    <th>N° Pedido</th>
                    <th>Detalle</th>
                    <th>Hora</th>
                    <th>Obser.</th>
                    <th>Precio</th>
                    <th>Acci&oacute;n</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($dailyOrdersDomicilio as $order) : //dd($dailyorders); 
                ?>

                    <tr>
                        <td>
                            <small style="font-size: 50px;"><?= $order->turnmachine_order ?></small>
                        </td>
                        <td>
                            <?= count($list_products = $order->getListofProducts()) ?>
                        </td>
                        <td><?= $order->id_order . '<br><b>' . $order->getNameClient() . '</b>' ?></td>
                        <td>
                            <ul class="list-inline">
                                <?php foreach ($list_products as $item) :  ?>
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="<?= base_url() . route_to('img-menu') . '/' . $item['category_id_category'] . '/' . $item['image_product'] ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td>
                            <?= $order->hour_order . '<br>' . $order->date_order . '<br><b>' . $order->getNameEmployee() . '</b>' ?>
                        </td>
                        <td style="max-width: 100px;"><?= $order->observations_order ?></td>
                        <td><?= '$ ' . number_format($order->getTotalWthitOutDomicilio()) ?></td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="<?= base_url() . route_to('view_load_order', $order->id_order) ?>">
                                <i class="fas fa-folder">
                                </i>
                                Ver
                            </a>
                            <?php if ($order->state_id_state == 1) : ?>
                                <a class="btn btn-danger btn-sm" href="<?= base_url() . route_to('chage_state', 4, $order->id_order) ?>">
                                    <i class="fas fa-trash">
                                    </i>
                                    Deshabilitar
                                </a>
                            <?php endif; ?>
                            <?php if ($order->state_id_state == 1) : ?>
                                <a class="btn btn-info btn-sm" href="<?= base_url() . route_to('print_kitchen', $order->id_order) ?>">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Pasar a Cocina
                                </a>
                            <?php endif; ?>
                            <?php if ($order->state_id_state == 1 or $order->state_id_state == 2) : ?>
                                <a class="btn btn-info btn-sm" href="<?= base_url() . route_to('chage_state', 3, $order->id_order) ?>">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Despachar
                                </a>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
</div>