<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Reporte General<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url() ?>/public/admin/plugins/chart.js/Chart.min.js"></script>
<script>
    $(function() {
        "use strict";

        var ticksStyle = {
            fontColor: "#495057",
            fontStyle: "bold",
        };

        var mode = "index";
        var intersect = true;

        <?php $contador = 1;
        foreach ($array_to_grafic as $infografic) : ?>

            var $salesChart = $("#sales-chart<?= $contador ?>");
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart($salesChart, {
                type: "bar",
                data: {
                    labels: [<?= $infografic['cadenaproducts'] ?>],
                    datasets: [{
                        backgroundColor: "#76b119",
                        borderColor: "#76b119",
                        data: [<?= $infografic['cadenaquantities'] ?>],
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

                                        return value;
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

        <?php $contador += 1;
        endforeach; ?>

    });
</script>

<?= $this->endSection() ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <br>
        <h1 class="h1reportdaily">REPORTE ENTRE FECHAS</h1>
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="row">

                    <?php $contador = 1;
                    foreach ($array_to_grafic as $infografic) : ?>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title"><?= $infografic['name_category'] ?></h3>
                                        <a href="javascript:void(0);">PeRa Burger</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">$18,230.00</span>
                                            <span>Cantidad</span>
                                        </p>
                                        <p class="ml-auto d-flex flex-column text-right">
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i> 33.1%
                                            </span>
                                            <span class="text-muted"><?= $initial_date . ' <b>a</b> ' . $final_date ?></span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->
                                    <div class="position-relative mb-4">
                                        <canvas id="sales-chart<?= $contador ?>" height="200"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            Productos
                                        </span>


                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $contador += 1;
                    endforeach; ?>
                </div>
            </div>
            <div class="col-lg-1">
            </div>


        </div>


    </div>

</section>
<?= $this->endSection() ?>