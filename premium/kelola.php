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
       
        $user1 = query("SELECT * FROM users WHERE username = '$ambilNama'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>inDesa - Kelola</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <style>
    </style>
</head>

<body>
    <div class="header">
        <img src="img/favicon.png" width="25px" height="25px" class="float-left logo-fav">
        <h3 class="text-secondary font-weight-bold float-left logo">Dompet</h3>
        <h3 class="text-secondary float-left logo2">- Qu</h3>
        <a href="logout">
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
                    <h5 class="admin"><?= substr($ambilNama, 0, 7) ?></h5>
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
                <!-- data -->

                <!-- Input -->
               <!-- <li class="klik2" id="flip2" style="cursor:pointer;">
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
                <a href="laporan" style="text-decoration: none;">
                    <li>
                        <div>
                            <span><i class="fas fa-clipboard-list"></i></span>
                            <span>Laporan</span>
                        </div>
                    </li>
                </a>

                <!--kelola user-->
                 <a href="kelola" style="text-decoration: none;">
                    <li class="aktif" style="border-left: 5px solid #306bff;">
                        <div>
                            <span><i class="fas fa-user"></i></span>
                            <span>Kelola User</span>
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
                    <h2 class="head" style="color: #4b4f58;">Manajemen User</h2>
                    <hr style="margin-top: -2px;">

                    <!-- bagian isi tabel -->
                <div class="headline" style="height: 40px;margin-top: 15px;">
                    <h4 class="ml-3 mt-1" style="color: #4b4f58">Data User</h4>
                </div>
                <div class="container tampil" id="container">
                    <div class="row" id="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-striped table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Paket</th>
                                        <!--<th>Aksi</th>-->
                                    </tr>
                                    <?php foreach($user1 as $row) : ?>
                                        <?php if ($row['username'] != 'admin') : ?>
                                            <tr id="<?= $row['id_user'] ?>" style="cursor: pointer">
                                                <td data-target="id_user" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['id_user'] ?></td>
                                                <td data-target="username" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['username'] ?></td>
                                                <td data-target="email" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['email'] ?></td>
                                                <td data-target="status" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['status']?></td>
                                                <td data-target="paket" class="data" data-id="<?= $row['id_user'] ?>"><?= $row['paket']?></td>
                                                <!--<td>
                                                    <button data-id="<?= $row['id_user'] ?>" data-role="update" class="btn btn-outline-primary openBtn">
                                                        <i class="fas fa-edit"></i> edit
                                                    </button>
                                                </td>-->
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /bagian isi tabel -->
                    
                    
            </div>
        </div>
    </div>

<!-- Modal edit data -->
    <div class="modal fade" id="myModal2" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- isi form -->
                <div class="modal-body">
                    <input type="hidden" id="userId" class="form-control">
                    <div class="form-group">
                        <label for="id_user">No</label>
                        <input type="text" class="form-control" id="id_user" disabled>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" required>
                    </div>
                </div>
                <!-- footer form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button id="save" class="btn btn-primary">simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal edit data -->

    <!-- double modal -->
    <script>
        $('#openBtn').click(function () {
            $('#myModal2').modal({
                    show: true
            });
        })
    </script>

    <script src="ajax/js/updateUser.js"></script>
    <script src="ajax/js/cariUser.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>

</html>