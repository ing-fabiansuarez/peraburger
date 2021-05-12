<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Nuevo Pedido<?= $this->endSection() ?>



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

                        <form class="form-client" action="https://localhost/pera/createclient" method="post">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Producto</label>
                                <div class="col-sm-8">
                                    <select id="departments" name="departments" class="form-control">
                                        <option value="1">PeRa Burguer</option>
                                        <option value="2">PeRa Felicidad</option>
                                        <option value="3">PeRa Amor</option>
                                        <option value="4">Brutos Pero Decididos</option>
                                        <option value="5">PeRa Locura</option>
                                        <option value="6">Barquilla en cono</option>
                                        <option value="7">Barquilla en vaso</option>
                                        <option value="7">Porsion de papitas</option>


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

            <div class="col-md-9">
                <div class="card card-dark shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">LISTA DEL PEDIDO</h3>
                        
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Task</th>
                                    <th>Progress</th>
                                    <th style="width: 40px">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">55%</span></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Clean database</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-warning">70%</span></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Cron job running</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-primary" style="width: 30%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary">30%</span></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Fix and squish bugs</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-success" style="width: 90%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success">90%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection() ?>