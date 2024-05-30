<?php 
    session_start();
    require "function/functions.php";
    
    if ( isset($_SESSION["login"]) ) {
        header("Location: dashboard");
        exit;
    } elseif(isset($_COOKIE['login'])) {
        header("Location: dashboard");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/oglogo.png">
    <title>inDesa</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <style>
        .parallax {
            background: url(img/desaku.png);
            background-attachment: fixed;
            /* background-size: cover; */
            background-repeat: no-repeat;
        }   

        .parallax2 {
            background: url(img/paket2.png);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top main-nav" id="mainNav">
        <div class="container">
            <a class="js-scroll-trigger" href="#page-top">
                <img src="img/logo.png" width="20px" style="margin-right: 10px; margin-bottom: 2px;">
            </a>
            <a class="navbar-brand js-scroll-trigger" href="#page-top">inDesa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">Paket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Kontak Kami</a>
                    </li>
                    <li class="nav-item">
                        <a href="login" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="admin/login.php" class="nav-link">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation -->

    <!-- header -->
    <header id="home" class="text-light parallax">
        <div class="container konten">
            <h1 style="font-size: 36pt;">Selamat Datang di inDesa</h1>
            <p class="lead" style="font-size: 16pt;">Indesa kini hadir membantu pencatatan dana desa yang lebih
            efektif dan mudah untuk diproses</p>
            <a href="demo/login" class="btn btn-outline-light button">DEMO</a>
        </div>
    </header>
    <!-- header -->

    <!-- features -->
    <section id="features" class="bg-light">
        <div class=" container konten2">
            <div class="garis text-center">FITUR</div>

            <div class="col-lg-12 foot-fitur">
                <h4 class="headline text-center">inDesa</h4>
                <p class="isi-fitur text-center">inDesa adalah sebuah layanan website yang memberikan kemudahan
                    dalam mendukung pencatatan anggaran desa dengan fitur-fitur yang selalu diupdate</p>
            </div>

            <div class="row row2">
                <div class="col-lg-6 fiturs">
                    <div class="gbr">
                        <div class="box">
                            <img src="img/transaksi2.png" class="gambar-fitur img" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fiturs">
                    <h4 class="headline">Transaksi Harian</h4>
                    <p class="isi-fitur">
                        Kami memberikan fitur transaksi harian yang akan menampilkan data
                        hasil pencatatan harian yang bisa mempermudah desa dalam mengelola keuangan. dan data keuangan desa akan
                        tersimpan dengan aman di dalam aplikasi ini.</p>
                </div>
            </div>

            <div class="row row2">
                <div class="col-lg-6 fiturs text-right">
                    <h4 class="headline">Rekening Desa</h4>
                    <p class="isi-fitur">Kami menyediakan fitur rekening desa yang dapat mempermudah desa dalam
                        melakukan pengelolaan keuangan di kas dan juga di rekening. Dengan fitur ini,
                        pengelolaan
                        uang desa di rekening menjadi lebih mudah dan terkelola dengan baik.</p>
                </div>
                <div class="col-lg-6 fiturs">
                    <div class="gbr">
                        <div class="box">
                            <img src="img/rekening2.png" class="gambar-fitur img" width="100%">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row2">
                <div class="col-lg-6 fiturs">
                    <div class="gbr">
                        <div class="box">
                            <img src="img/monitor2.png" class="gambar-fitur img" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fiturs">
                    <h4 class="headline">Monitoring Keuangan</h4>
                    <p class="isi-fitur">Monitoring keuangan tentunya sangat diperlukan untuk mengelola pengeluaran dan
                        pemasukan desa. kami menyediakan dashboard yang berisi beberapa fitur, seperti saldo, total
                        uang yang masuk dan keluar, dan rekening.</p>
                </div>
            </div>

        </div>
    </section>
    <!-- features -->

    <!-- about us -->
    <section id="about" class="bg-primary parallax2">
        <div class="container">
            <div style="color: white;" class="garis garis3 text-center">PAKET</div>
            <div class="row text-center">
                <div class="col-lg-4">
                    <div class="team">
                        <div class="gbr">
                            <div class="box">
                                <a href="premium/registrasi.php">
                                    <img class="img" src="profile/premium1.png" width="100%">
                                </a>
                            </div>
                        </div>
                        <div class="teks">
                            <h3 class="job-desk">PAKET 1</h3>
                            <h3 class="job-desk">Rp. 100.000/bulan</h3>
                            <p>Bisa Mendapatkan Semua Fitur</p>
                            <p>PREMIUM</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team">
                        <div class="gbr">
                            <div class="box">
                                <a href="premium/registrasi.php">
                                <img class="img" src="profile/premium2.png" width="100%">
                            </a>
                            </div>
                        </div>
                        <div class="teks">
                            <h3 class="job-desk">PAKET 2</h3>
                            <h3 class="job-desk">Rp. 100.000/bulan</h3>
                            <p>Bisa Mendapatkan Semua Fitur</p>
                            <p>PREMIUM</p>
                        </div>
                    </div>
                </div>
               <div class="col-lg-4">
                    <div class="team">
                        <div class="gbr">
                            <div class="box">
                                <a href="premium/registrasi.php">
                                <img class="img" src="profile/premium3.png" width="100%">
                            </a>
                            </div>
                        </div>
                        <div class="teks">
                            <h3 class="job-desk">PAKET 3</h3>
                            <h3 class="job-desk">Rp. 100.000/bulan</h3>
                            <p>Bisa Mendapatkan Semua Fitur</p>
                            <p>PREMIUM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us -->

    <!-- contact -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="garis garis2 text-center">KONTAK KAMI</div>
                    <div class="row text-center">
                        <div class="col col1">
                            <a href="https://www.facebook.com" target="_blank">
                                <!-- <img src="icons/facebook.png" width="70%"> -->
                                <img src="https://img.icons8.com/color/480/000000/facebook.png" width="70%">
                            </a>
                        </div>
                        <div class="col col2">
                            <a href="https://plus.google.com" target="_blank">
                                <!-- <img src="icons/google-plus.png" width="70%"> -->
                                <img src="https://img.icons8.com/color/96/000000/google-plus-squared.png" width="70%">
                            </a>
                        </div>
                        <div class="col col3">
                            <a href="https://www.instagram.com" target="_blank">
                                <!-- <img src="icons/instagram.png" width="70%"> -->
                                <img src="https://img.icons8.com/color/480/000000/instagram-new.png" width="70%">
                            </a>
                        </div>
                        <div class="col col4">
                            <a href="https://www.linkedin.com" target="_blank">
                                <!-- <img src="icons/linkedin.png" width="70%"> -->
                                <img src="https://img.icons8.com/color/480/000000/linkedin.png" width="70%">
                            </a>
                        </div>
                        <div class="col col5">
                            <a href="https://www.pinterest.com" target="_blank">
                                <!-- <img src="icons/pinterest.png" width="70%"> -->
                                <img src="https://img.icons8.com/color/480/000000/pinterest.png" width="70%">
                            </a>
                        </div>
                    </div>
                    <div class="row row3 text-center">
                        <div class="col-4 text-right">
                            <a href="https://twitter.com" target="_blank">
                                <!-- <img src="icons/twitter.png" width="38%"> -->
                                <img src="https://img.icons8.com/color/480/000000/twitter.png" width="38%">
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="https://www.whatsapp.com" target="_blank">
                                <!-- <img src="icons/whatsapp.png" width="38%"> -->
                                <img src="https://img.icons8.com/color/480/000000/whatsapp.png" width="38%">
                            </a>
                        </div>
                        <div class="col-4 text-left">
                            <a href="https://www.youtube.com" target="_blank">
                                <!-- <img src="icons/youtube.png" width="38%"> -->
                                <img src="https://img.icons8.com/color/480/000000/youtube-squared.png" width="38%">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact -->

    <!-- Footer -->
    <div class="py-3 bg-dark">
        <div class="container text-light">
            <div class="row">
                <div class="col-lg-3 col-6 p-3">
                    <h5> <b>Utama</b> </h5>
                    <ul class="list-unstyled">
                        <li> <a href="#home" class="js-scroll-trigger foot-link">Beranda</a> </li>
                        <li> <a href="#features" class="js-scroll-trigger foot-link">Fitur</a> </li>
                        <li> <a href="#about" class="js-scroll-trigger foot-link">Tentang Kami</a> </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6 p-3">
                    <h5> <b>Lainnya</b> </h5>
                    <ul class="list-unstyled">
                        <li> <a href="faq" class="foot-link">FAQ</a> </li>
                        <li> <a href="#" class="foot-link">Vidio Promosi</a> </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 p-3">
                    <h5> <b>Tentang</b> </h5>
                    <p class="mb-0">Aplikasi inDesa dilengkapi dengan fitur menarik yang dapat mempermudah desa mengelola anggarannya.</p>
                </div>
                <div class="col-lg-3 col-md-6 p-3">
                    <h5> <b>Follow us</b> </h5>
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center justify-content-between my-2">
                            <a href="https://www.facebook.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-facebook-official warna-icon fa-lg mr-2"></i>
                            </a>
                            <a href="https://www.instagram.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-instagram warna-icon fa-lg mx-2"></i>
                            </a>
                            <a href="https://plus.google.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-google-plus-official warna-icon fa-lg mx-2"></i>
                            </a>
                            <a href="https://www.pinterest.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-pinterest-p warna-icon fa-lg mx-2"></i>
                            </a>
                            <a href="https://www.reddit.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-reddit warna-icon fa-lg mx-2"></i>
                            </a>
                            <a href="https://twitter.com" class="foot-link" target="_blank">
                                <i class="d-block fa fa-twitter warna-icon fa-lg ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0 mt-2">Copyright © 2023 inDesa. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->

    <!-- <footer class="bg-dark foot">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; 2018 Semicolon SQUAD</p>
        </div>
    </footer> -->

    <!-- js utama -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-easing/jquery.easing.min.js"></script>

    <!-- js scrolling -->
    <script src="js/scrolling-nav.js"></script>

</body>

</html>