<?php
session_start();
include '../../resources/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tabel Buku</title>
        <link rel="icon" href="../img/icon-perpusku.png">
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #F1F0EB !important;" class="sb-nav-fixed">
        <nav style="background-color: #4156A1 !important;" class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a style="cursor: default;" class="navbar-brand"><strong>PERPUS</strong>KU</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../../index.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div style="background-color: #344581 !important;" class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">MAIN</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">MASTER BUKU</div>
                            <a class="nav-link" href="./tabel-buku.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Tabel Buku
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelolaBuku" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-cog" aria-hidden="true"></i></div>
                                Kelola Buku
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseKelolaBuku" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./tambah-data-buku.php">Tambah Data Buku</a>
                                    <a class="nav-link" href="./kelola-data-buku.php">Kelola Data Buku</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelolaPeminjaman" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-cog" aria-hidden="true"></i></div>
                                Kelola Peminjaman
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseKelolaPeminjaman" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./tambah-data-peminjam.php">Tambah Peminjaman</a>
                                    <a class="nav-link" href="./kelola-peminjaman.php">Kelola Peminjaman</a>
                                    <a class="nav-link" href="./kelola-denda.php">Kelola Denda</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div style="background-color: #4156A1 !important;" class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['username'] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Tabel Buku</h1>
                        <ol style="background-color: white !important;" class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tabel Buku</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Tabel Buku
                            </div>
                            <form action="tabel-buku.php" method="get" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                                <div style="top: 10px;" class="input-group">
                                    <input class="form-control" type="text" name="search" placeholder="Ketik judul buku..." aria-label="Search" aria-describedby="basic-addon2" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableBuku" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    ISBN
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=isbn_buku&sort=asc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px" class="fa fa-arrow-up"></i></a>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=isbn_buku&sort=desc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px;" class="fa fa-arrow-down"></i></a>
                                                </th>
                                                <th>
                                                    Judul
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=judul&sort=asc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px" class="fa fa-arrow-up"></i></a>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=judul&sort=desc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px;" class="fa fa-arrow-down"></i></a>
                                                </th>
                                                <th>
                                                    Penerbit
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=penerbit&sort=asc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px" class="fa fa-arrow-up"></i></a>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=penerbit&sort=desc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px;" class="fa fa-arrow-down"></i></a>
                                                </th>
                                                <th>
                                                    Penulis
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=penulis&sort=asc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px" class="fa fa-arrow-up"></i></a>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=penulis&sort=desc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px;" class="fa fa-arrow-down"></i></a>
                                                </th>
                                                <th>
                                                    Kategori
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=kategori&sort=asc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px" class="fa fa-arrow-up"></i></a>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=kategori&sort=desc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px;" class="fa fa-arrow-down"></i></a>
                                                </th>
                                                <th>
                                                    Halaman
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=halaman&sort=asc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px" class="fa fa-arrow-up"></i></a>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=halaman&sort=desc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px;" class="fa fa-arrow-down"></i></a>
                                                </th>
                                                <th>
                                                    Stok
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=stok&sort=asc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px" class="fa fa-arrow-up"></i></a>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=stok&sort=desc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px;" class="fa fa-arrow-down"></i></a>
                                                </th>
                                                <th>
                                                    Tahun
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=tahun_terbit&sort=asc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px" class="fa fa-arrow-up"></i></a>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?> ?order=tahun_terbit&sort=desc">
                                                    <i style="color: #404040; float: right; margin: 0px 4px 0px 4px;" class="fa fa-arrow-down"></i></a>
                                                </th>
                                            </tr>
                                        </thead>

                                        <?php

                                        error_reporting(E_ALL ^ E_NOTICE);
                                        error_reporting(E_ERROR | E_PARSE);

                                        $orderBy = 'isbn_buku';
                                        $sortBy = 'ASC';
                                        $search = $_GET['search'];

                                        if ($_GET['sort'] == 'asc') {
                                            
                                            $sortBy = 'ASC';
                                            if ($_GET['order'] == 'isbn_buku') $orderBy = 'isbn_buku';
                                            else if ($_GET['order'] == 'judul') $orderBy = 'judul';
                                            else if ($_GET['order'] == 'penerbit') $orderBy = 'penerbit';
                                            else if ($_GET['order'] == 'penulis') $orderBy = 'penulis';
                                            else if ($_GET['order'] == 'kategori') $orderBy = 'kategori';
                                            else if ($_GET['order'] == 'halaman') $orderBy = 'halaman';
                                            else if ($_GET['order'] == 'stok') $orderBy = 'stok';
                                            else if ($_GET['order'] == 'tahun_terbit') $orderBy = 'tahun_terbit';
                                            else $orderBy = 'isbn_buku';
                                        }
                                        else if ($_GET['sort'] == 'desc') {

                                            $sortBy = 'DESC';
                                            if ($_GET['order'] == 'isbn_buku') $orderBy = 'isbn_buku';
                                            else if ($_GET['order'] == 'judul') $orderBy = 'judul';
                                            else if ($_GET['order'] == 'penerbit') $orderBy = 'penerbit';
                                            else if ($_GET['order'] == 'penulis') $orderBy = 'penulis';
                                            else if ($_GET['order'] == 'kategori') $orderBy = 'kategori';
                                            else if ($_GET['order'] == 'halaman') $orderBy = 'halaman';
                                            else if ($_GET['order'] == 'stok') $orderBy = 'stok';
                                            else if ($_GET['order'] == 'tahun_terbit') $orderBy = 'tahun_terbit';
                                            else $orderBy = 'isbn_buku';
                                        }
                                        else $sortBy = 'ASC';
                                        
                                        $sql = "SELECT * FROM showAllDataBuku WHERE judul LIKE('%".$search."%') ORDER BY ".$orderBy." ".$sortBy;
                                        $result = mysqli_query($conn, $sql);
                                        
                                        

                                        while ($data = mysqli_fetch_assoc($result)) {

                                            echo "<tr>
                                            <td>".$data['isbn_buku']."</td>
                                            <td>".$data['judul']."</td>
                                            <td>".$data['penerbit']."</td>
                                            <td>".$data['penulis']."</td>
                                            <td>".$data['kategori']."</td>
                                            <td>".$data['halaman']."</td>
                                            <td>".$data['stok']."</td>
                                            <td>".$data['tahun_terbit']."</td></tr>";
                                        }

                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Perpusku 2021</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
        
    </body>
</html>
