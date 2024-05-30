<?php 
    session_start();
    require "../function/functions.php";
    
    // session dan cookie multilevel user
    if(isset($_COOKIE['login'])) {
        if ($_COOKIE['level'] == 'user') {
            $_SESSION['login'] = true;
            $ambilNama = $_COOKIE['login'];
        } 
        
        elseif ($_COOKIE['level'] == 'admin') {
            $_SESSION['login'] = true;
            header('Location: administrator');
        }
    } 

    elseif ($_SESSION['level'] == 'user') {
        $ambilNama = $_SESSION['user'];
    } 
    
    else {
        if ($_SESSION['level'] == 'admin') {
            header('Location: administrator');
            exit;
        }
    }

    if(empty($_SESSION['login'])) {
        header('Location: login');
        exit;
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../img/oglogo.png">
    <title>inDesa | Catatan Suara</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styler.css?v=1.0">
    <link rel="stylesheet" href="../css/dashboard.css?v=1.0">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <!--<script src="js/chart.js"></script>-->
</head>

<body>
    <div class="header">
        <img src="../img/pp.png" width="25px" height="25px" class="float-left logo-fav">
        <h3 class="text-secondary font-weight-bold float-left logo">in</h3>
        <h3 class="text-secondary float-left logo2">Desa</h3>
        <a href="../logout">
            <div class="logout">
                <i class="fas fa-sign-out-alt float-right log"></i>
                <p class="float-right logout">Logout</p>
            </div>
        </a>
    </div>

    <div class="sidebar">
        <nav>
            <ul>
                <li>
                    <img src="../img/pp.png" class="img-fluid profile float-left" width="60px">
                    <h5 class="admin"><?= substr($ambilNama, 0, 10) ?></h5>
                    <div class="online online2">
                        <p class="float-right ontext">Online</p>
                        <div class="on float-right"></div>
                    </div>
                </li>
                <!-- fungsi slide -->
                <script>
                    $(document).ready(function () {
                        $("#flip").click(function () {
                            $("#panel").slideToggle("medium");
                            $("#panel2").slideToggle("medium");
                        });
                        $("#flip2").click(function () {
                            $("#panel3").slideToggle("medium");
                            $("#panel4").slideToggle("medium");
                        });
                    });
                </script>

                <!-- dashboard -->
                <a href="../dashboard" style="text-decoration: none;">
                    <li>
                        <div>
                            <span class="fas fa-tachometer-alt"></span>
                            <span>Dashboard</span>
                        </div>
                    </li>
                </a>

                <!-- data -->
                <li class="klik" id="flip" style="cursor:pointer;">
                    <div>
                        <span class="fas fa-database"></span>
                        <span>Data Harian</span>
                        <i class="fas fa-caret-right float-right" style="line-height: 20px;"></i>
                    </div>
                </li>

                <a href="../pemasukkan" class="linkAktif">
                    <li id="panel" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>Data Pemasukkan</span>
                        </div>
                    </li>
                </a>

                <a href="../pengeluaran" class="linkAktif">
                    <li id="panel2" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-hand-holding-usd"></i></span>
                            <span>Data Pengeluaran</span>
                        </div>
                    </li>
                </a>

                <!-- catatan suara -->
                <a href="pencatatan-suara/catatan-suara" style="text-decoration: none;">
                    <li class="aktif" style="border-left: 5px solid #306bff;">
                        <div>
                            <span><i class="fas fa-microphone"></i></span>
                            <span>Pencatatan Suara</span>
                        </div>
                    </li>
                </a>

                <!-- data -->

                <!-- Input -->
                <!--<li class="klik2" id="flip2" style="cursor:pointer;">
                    <div>
                        <span class="fas fa-plus-circle"></span>
                        <span>Input Data</span>
                        <i class="fas fa-caret-right float-right" style="line-height: 20px;"></i>
                    </div>
                </li>

                <a href="tambahPemasukkan" class="linkAktif">
                    <li id="panel3" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>Pemasukkan</span>
                        </div>
                    </li>
                </a>

                <a href="tambahPengeluaran" class="linkAktif">
                    <li id="panel4" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-hand-holding-usd"></i></span>
                            <span>Pengeluaran</span>
                        </div>
                    </li>
                </a>-->
                <!-- Input -->

                <!-- laporan -->
                <a href="../laporan" style="text-decoration: none;">
                    <li>
                        <div>
                            <span><i class="fas fa-clipboard-list"></i></span>
                            <span>Laporan</span>
                        </div>
                    </li>
                </a>

                <!--kelola user-->
                 <a href="../pengguna" style="text-decoration: none;">
                    <li>
                        <div>
                            <span><i class="fas fa-user"></i></span>
                            <span>User</span>
                        </div>
                    </li>
                </a>
                <!--Kelola user-->

                <!-- change icon -->
                <script>
                    $(".klik").click(function () {
                        $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
                        if ($(".klik").not(this).find("i").hasClass("fa-caret-right")) {
                            $(".klik").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
                        }
                    });
                    $(".klik2").click(function () {
                        $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
                        if ($(".klik2").not(this).find("i").hasClass("fa-caret-right")) {
                            $(".klik2").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
                        }
                    });
                </script>
                <!-- change icon -->
            </ul>
        </nav>
    </div>

<div class="main-content khusus">
    <div class="konten khusus2">
    <div class="konten_dalem khusus3">
   
    <div class="container">

        <div class="py-5 text-center">
            <h2>Pencatatan Suara</h2>
        </div>

        <form>
            <div class="form-group">
                <label for="name">Sumber</label>
                <input type="text" class="form-control" id="name" placeholder="Masukkan Sumber">
            </div>

            <div class="form-group">
                <label for="name">Kegunaan</label>
                <input type="text" class="form-control" id="hp" placeholder="Pemasukan / Pengeluaran">
            </div>

            <div class="form-row">

                <div class="form-group col">
                    <label for="dataset">Data Penyimpanan Dari</label>
                    <select class="form-control" id="dataset">
                    </select>

                </div>

                <div class="form-group col">
                    <label for="sentenceNumber">Nomer Data Suara</label>
                    <input type="number" class="form-control" id="sentenceNumber" value="1">
                </div>
            </div>

            <div class="form-group">
                <label for="sentenceField">Informasi !!</label>
                <fieldset id="sentenceField">
                    <div class="alert alert-dark" role="alert" id="sentence"></div>
                </fieldset>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label for="recordingGrp">Rekaman</label>
                    <fieldset id="recordingGrp">

                        <div class="btn-group d-flex">
                            <button type="button" class="btn btn-primary" id="record">Merekam</button>

                            <button type="button" class="btn btn-secondary" id="stop" disabled>Stop</button>
                            <button type="button" class="btn btn-secondary" id="nextSentence" disabled>Simpan Catatan Suara</button>
                            <button type="button" class="btn btn-secondary" id="skip">Hapus Data Nomor</button>
                        </div>
                    </fieldset>
                </div>

                <div class="form-group col-md-auto">
                    <label for="recordingGrp" class="text-center">Memutar</label>

                    <fieldset id="recordingGrp" class="row align-items-center">

                        <div class="col-md-auto"><input type="checkbox" checked id="autoplay"> Otomatis Memutar</label>
                        </div>
                    </fieldset>
                </div>

                <div class="form-group col">
                    <label for="previewField">Hasil Rekaman</label>
                    <fieldset id="previewField" class="">
                        <audio id="preview" controls style="width: 100%"></audio>
                    </fieldset>
                </div>
            </div>
        </form>

        <section class="main-controls">
            <canvas class="visualizer" height="60px"></canvas>
            <div id="buttons">
            </div>
        </section>

                </div>
                </div>
                </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
        
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <!--<script src="scripts/app.js"></script>-->
    <script src="scripts/voice.js"></script>
</body>

</html>