<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Caja Diaria<?= $this->endSection() ?>
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
<script src="<?= base_url() ?>/public/admin/plugins/chart.js/Chart.min.js"></script>

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

        "use strict";
        var ticksStyle = {
            fontColor: "#495057",
            fontStyle: "bold",
        };
        var mode = "index";
        var intersect = true;
        var $salesChart = $("#sales-chart");
        // eslint-disable-next-line no-unused-vars

        <?php
        $cadena = "";
        foreach ($all_products as $product) {
            $cadena .= "'" . $product['name_product'] . "',";
        }

        ?>
        var salesChart = new Chart($salesChart, {
            type: "bar",
            data: {
                labels: [<?= $cadena ?>],
                datasets: [{
                    backgroundColor: "#007bff",
                    borderColor: "#007bff",
                    data: [1000, 2000, 3000, 2500, 2700, 2500, 3000],
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect,
                },
                hover: {
                    mode: mode,
                    intersect: intersect,
                },
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: "4px",
                            color: "rgba(0, 0, 0, .2)",
                            zeroLineColor: "transparent",
                        },
                        ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function(value) {
                                    if (value >= 1000) {
                                        value /= 1000;
                                        value += "k";
                                    }

                                    return "$" + value;
                                },
                            },
                            ticksStyle
                        ),
                    }, ],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false,
                        },
                        ticks: ticksStyle,
                    }, ],
                },
            },
        });



    });
</script>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">


        <br>
        <h1 class="h1reportdaily">REPORTE DIARIO</h1>
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
        <?php endif;  ?>
        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>$ 500,150</h3>

                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-store"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Local - 30</span>
                                <span class="info-box-number">$ 59,760</span>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-motorcycle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Domicilios</span>
                                <span class="info-box-number">760</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-trash-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Deshabilitados</span>
                                <span class="info-box-number">760</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>

            </div>



        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">COMBOS</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">$18,230.00</span>
                                <span>Sales Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted">Since last month</span>
                            </p>
                        </div>

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This year
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Last year
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">HABURGUESAS</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">$18,230.00</span>
                                <span>Sales Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted">Since last month</span>
                            </p>
                        </div>

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This year
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Last year
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">HELADOS</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">$18,230.00</span>
                                <span>Sales Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted">Since last month</span>
                            </p>
                        </div>

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This year
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Last year
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card" style="width: 100%;">
                <div class="card-header header-list">
                    <h3 class="card-title" style="color: #fff;"> <b> LOCAL</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body body-background">
                    <table id="example1" class="table table-bordered table-striped projects">
                        <thead>
                            <tr>

                                <th>N° Pedido</th>
                                <th>Detalle</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Tipo de Env&iacute;o</th>
                                <th>Estado</th>
                                <th>Turno</th>
                                <th>Consecutivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_orders as $order) : ?>
                                <tr>
                                    <td><?= '<b>' . $order->id_order . '</b><br>' . $order->getNameClient() ?></td>
                                    <td>
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>
                                                        <i class="fas fa-caret-right fa-fw"></i>
                                                        Productos
                                                    </td>
                                                </tr>
                                                <tr class="expandable-body">
                                                    <td>
                                                        <div class="p-0">
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                    <?php foreach ($order->getListofProducts() as $item) : ?>
                                                                        <tr>
                                                                            <td><?= $item['quantity_detailorder'] . ' x ' . $item['name_product'] ?></td>
                                                                            <td><?= '$' . number_format($item['priceunit_detailorder'] * $item['quantity_detailorder']) ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <?= $order->hour_order . '<br>' . $order->date_order . '<br><b>' . $order->getNameEmployee() . '</b>' ?>
                                    </td>
                                    <td><?= '$ ' . number_format($order->getTotalWthitOutDomicilio()) ?></td>
                                    <td><span class="badge <?php switch ($order->getTypeofShipping()['id_typeshipping']) {
                                                                case 1:
                                                                    echo 'bg-warning';
                                                                    break;
                                                                case 2:
                                                                    echo 'bg-primary';
                                                                    break;
                                                            }
                                                            ?>"><?= $order->getTypeofShipping()['name_typeshipping'] ?></span></td>
                                    <td>
                                        <span class="badge <?php switch ($order->getState()['id_state']) {
                                                                case 1:
                                                                    echo 'badge-info';
                                                                    break;
                                                                case 2:
                                                                    echo 'badge-secondary';
                                                                    break;
                                                                case 3:
                                                                    echo 'badge-success';
                                                                    break;
                                                                case 4:
                                                                    echo 'badge-danger';
                                                                    break;
                                                            }
                                                            ?>"><?= $order->getState()['name_state'] ?></span>
                                    </td>
                                    <td>
                                        <?= $order->turnmachine_order ?>
                                    </td>
                                    <td>
                                        <?= $order->consecutive_order ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>