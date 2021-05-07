<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Restaurantly Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/public/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/public/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/public/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/public/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/public/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?= base_url() ?>/public/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/public/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Restaurantly - v1.2.1
  * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background: url(<?= base_url() ?>/public/img/backgrounds/green_background.jpg); background-size:cover;">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top oscuro">
        <div class="container d-flex align-items-center">

            <h1 class="logo mr-auto">

                <a href="index.html">PeRa<img src="<?= base_url() ?>/public/img/peraburgelogo.png" alt="">Burger</a>
            </h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a href="index.html">Home</a></li>

                    <li class="book-a-table text-center"><a href="<?= base_url() . route_to('page2') ?>">Realizar Orden</a></li>
                </ul>
            </nav><!-- .nav-menu -->

        </div>
    </header><!-- End Header -->


    <main id="main">


        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <br><br><br>
                    <h2>Escoge!</h2>
                    <p>¿Qué deseas comprar?</p>
                </div>

                <div class="row">

                    <div class="col-lg-2">
                    </div>

                    <div class="col-lg-3 mt-3 mt-lg-0 text-center">
                        <div class="card">
                            <img src="<?= base_url() ?>/public/img/products/burger.png" alt="" class="img-fluid">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="color: #000;">PeRa Burger</h5>
                                <a href="#" class="btn btn-primary">La quiero!!!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 mt-2 mt-lg-0 text-center">
                    </div>
                    <div class="col-lg-3 mt-3 mt-lg-0 text-center">
                        <div class="card">
                            <img src="<?= base_url() ?>/public/img/products/burger.png" alt="" class="img-fluid">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="color: #000;">PeRa Burger</h5>
                                <a href="#" class="btn btn-primary">La quiero!!!</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 mt-2 mt-lg-0 text-center">
                    </div>



                </div>

            </div>
        </section><!-- End Why Us Section -->




    </main><!-- End #main -->




    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/public/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/public/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>/public/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url() ?>/public/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/public/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url() ?>/public/vendor/venobox/venobox.min.js"></script>
    <script src="<?= base_url() ?>/public/vendor/aos/aos.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>/public/js/main.js"></script>

</body>

</html>