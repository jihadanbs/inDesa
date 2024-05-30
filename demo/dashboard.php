<?php 
    session_start();
    require "function/functions.php";
    
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
    
    $totalPemasukan = query("SELECT * FROM pemasukkan WHERE username = '$ambilNama'");
    $totalPengeluaran = query("SELECT * FROM pengeluaran WHERE username = '$ambilNama'");
    
    foreach ( $totalPemasukan as $rowMasuk ) {
        $hargaMasuk[] = $rowMasuk["jumlah"];
        $convertHarga = str_replace('.', '', $hargaMasuk);
        $totalMasuk = array_sum($convertHarga);
    }

    foreach ( $totalPengeluaran as $rowKeluar ) {
        $hargaKeluar[] = $rowKeluar["jumlah"];
        $convertHarga2 = str_replace('.', '', $hargaKeluar);
        $totalKeluar = array_sum($convertHarga2);
    }

    global $totalMasuk, $totalKeluar;
    $saldo = $totalMasuk - $totalKeluar;
    $saldoFix = number_format($saldo, 0, ',', '.'); 

    $month = date('m');
    $day = date('d');
    $year = date('Y');
    
    $today = $year . '-' . $month . '-' . $day;


    // pemasukkan rekening
    $rekeningMasuk = query("SELECT * FROM rekening_masuk WHERE username = '$ambilNama'");
    foreach ($rekeningMasuk as $rowRekIn) {
        $jumlah[] = $rowRekIn['jumlah'];
        $jumlahConvert = str_replace('.', '', $jumlah);
        $totalRekIn = array_sum($jumlahConvert);
    }
    
    // pengeluaran rekening
    $rekeningKeluar = query("SELECT * FROM rekening_keluar WHERE username = '$ambilNama'");
    foreach ($rekeningKeluar as $rowRekOut) {
        $jumlah2[] = $rowRekOut['jumlah'];
        $jumlahConvert2 = str_replace('.', '', $jumlah2);
        $totalRekOut = array_sum($jumlahConvert2);
    }

    // saldo rekening
    global $totalRekIn, $totalRekOut;
    $saldoRek = $totalRekIn - $totalRekOut;
    $saldoRekFix = number_format($saldoRek, 0, ',', '.');
    $no = 1;

    // get no rekening
    $query = "SELECT * FROM users WHERE username = '$ambilNama'";
    $ambilQuery = mysqli_query($koneksi, $query);
    $ambilData = mysqli_fetch_assoc($ambilQuery);

    $dataAwal = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$_SESSION[user]'") or die(mysqli_error());
    $akhir = mysqli_fetch_assoc($dataAwal);

?>

<?php
    @session_start();
    $UserRegDate = $akhir['awal_buat'];
    $MembershipEnds = date("Y-m-d", strtotime(date("Y-m-d", strtotime($UserRegDate)). " + 30 days"));
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/oglogo.png">
    <title>inDesa | Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" href="css/dashboard.css?v=1.0">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="js/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <style>
    
.rentang {
    padding-bottom: 75px;
}
    </style>
</head>

<body>
    <div class="header">
        <img src="img/oglogo.png" width="25px" height="25px" class="float-left logo-fav">
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
                <li class="rentang">
                    <img src="img/profile.png" class="img-fluid profile float-left" width="60px">
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
                <a href="dashboard" style="text-decoration: none;">
                    <li class="aktif" style="border-left: 5px solid #306bff;">
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

                <a href="pemasukkan" class="linkAktif">
                    <li id="panel" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>Data Pemasukkan</span>
                        </div>
                    </li>
                </a>

                <a href="pengeluaran" class="linkAktif">
                    <li id="panel2" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-hand-holding-usd"></i></span>
                            <span>Data Pengeluaran</span>
                        </div>
                    </li>
                </a>
               
                <!-- laporan -->
                <a href="laporan" style="text-decoration: none;">
                    <li>
                        <div>
                            <span><i class="fas fa-clipboard-list"></i></span>
                            <span>Laporan</span>
                        </div>
                    </li>
                </a>

                <!--kelola user-->
                 <a href="pengguna" style="text-decoration: none;">
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
                <h2 class="heade" style="color: #4b4f58;">Dashboard</h2>
                <hr style="margin-top: -2px;">
                <div class="container" id="container" style="border: none;">
                    <div class="row tampilCardview" id="row">

                        <div class="col-md-4 jarak">
                            <a href="tambahPengeluaran" style="text-decoration: none;">
                                <div class="card card-stats card-warning" style="background: #d95350;">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fa fa-file-invoice-dollar ikon"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center tulisan">
                                                <div class="numbers">
                                                    <p class="card-category ket head">Pengeluaran</p>
                                                    <?php foreach ($totalPengeluaran as $row) : ?>
                                                    <?php
                                                        $hargaPengeluaran[] = $row["jumlah"];
                                                        $hargaConvert = str_replace('.', '', $hargaPengeluaran);
                                                        $totalPeng = array_sum($hargaConvert);
                                                        $hasilHargaPengeluaran = number_format($totalPeng, 0, ',', '.');   
                                                    ?>                                     
                                                    <?php endforeach; ?>

                                                    <?php global $hasilHargaPengeluaran;
                                                    if ( $hasilHargaPengeluaran != "" ) : ?>
                                                    <h4 class="card-title ket total">Rp. <?= $hasilHargaPengeluaran; ?></h4>
                                                    <?php else : ?>
                                                    <h4 class="card-title ket total">Rp. 0</h4>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overlay" style="background: #e45351;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-plus-circle ikon2"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <p class="tulisan">Tambah Data</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4 jarak">
                            <a href="tambahPemasukkan" style="text-decoration: none;">
                                <div class="card card-stats card-warning" style="background: #5db85b;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fa fa-hand-holding-usd ikon"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center tulisan">
                                                <div class="numbers">
                                                    <p class="card-category ket head">Pemasukkan</p>
                                                    <?php foreach ($totalPemasukan as $row) : ?>
                                                        <?php
                                                            $hargaPemasukkan[] = $row["jumlah"];
                                                            $hargaConvert = str_replace('.', '', $hargaPemasukkan);
                                                            $totalPem = array_sum($hargaConvert);
                                                            $hasilHarga = number_format($totalPem, 0, ',', '.');    
                                                        ?>     
                                                    <?php endforeach ?>

                                                    <?php global $hasilHarga;
                                                    if ( $hasilHarga != "" ) : ?>
                                                    <h4 class="card-title ket total">Rp. <?= $hasilHarga ?> </h4>
                                                    <?php else : ?>
                                                    <h4 class="card-title ket total">Rp. 0 </h4>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overlay">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-plus-circle ikon2"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <p class="tulisan">Tambah Data</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


    <!-- Modal dana masuk -->
    <div class="modal fade" id="myModal2" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Dana masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- isi form -->
                <script type="text/javascript" src="js/pisahTitik.js"></script>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" value="<?= $today ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlahRek">Jumlah nominal</label>
                        <input type="text" class="form-control" id="jumlahRek" onkeydown="return numbersonly(this, event);"
                                onkeyup="javascript:tandaPemisahTitik(this);" required>
                    </div>
                </div>
                <!-- footer form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-primary tambahRek">Tambah</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal dana masuk -->
    
    <!-- Modal dana keluar -->
    <div class="modal fade" id="myModal3" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Dana keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- isi form -->
                <script type="text/javascript" src="js/pisahTitik.js"></script>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalRekOut" value="<?= $today ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlahRekOut">Jumlah nominal</label>
                        <input type="text" class="form-control" id="jumlahRekOut" onkeydown="return numbersonly(this, event);"
                                onkeyup="javascript:tandaPemisahTitik(this);" required>
                    </div>
                </div>
                <!-- footer form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-primary tambahRekOut">Tambah</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal dana keluar -->
    
    <!-- Modal history -->
    <div class="modal fade" id="myModal4" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Riwayat transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- isi form -->
                <script type="text/javascript" src="js/pisahTitik.js"></script>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Kode transaksi</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                            <th>Tanggal</th>
                        </tr>
                        <?php foreach($rekeningMasuk as $row) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['kode'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td><?= $row['aksi'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>

                        <?php foreach($rekeningKeluar as $row) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['kode'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td><?= $row['aksi'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <!-- footer form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal history -->

    <!-- Modal transfer -->
    <div class="modal fade" id="myModal5" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- isi form -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlahRekOut">No rekening</label>
                        <input type="text" class="form-control" id="no_rek" required>
                    </div>
                </div>
                <!-- footer form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-primary tambah_norek">Cari</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal transfer -->

    <!-- banyak modal -->
    <script>
        $('#openBtn').click(function () {
            $('#myModal2').modal({
                show: true
            });
        })
        $('#openBtn2').click(function () {
            $('#myModal3').modal({
                show: true
            });
        })
        $('#openBtn3').click(function () {
            $('#myModal4').modal({
                show: true
            });
        })
        $('#openBtn4').click(function () {
            $('#myModal5').modal({
                show: true
            });
        })
    </script>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ["Saldo masuk", "Saldo keluar"],
                datasets: [{
                    label: 'Data rekening',
                    data: [
                        <?= $totalRekIn ?>, 
                        <?= $totalRekOut ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        stacked: true
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });
    </script>

    <script src="js/bootstrap.js"></script>
    <script src="js/kirimNoRek.js"></script>
    <script src="ajax/js/tambahRekeningIn.js"></script>
    <script src="ajax/js/tambahRekeningOut.js"></script>
</body>

</html>