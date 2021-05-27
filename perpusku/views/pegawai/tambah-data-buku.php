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
        <title>Tambah Data Buku</title>
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
                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseEditBuku" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-cog" aria-hidden="true"></i></div>
                                Kelola Buku
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse show" id="collapseEditBuku" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./tambah-data-buku.php">Tambah Data Buku</a>
                                    <a class="nav-link" href="./kelola-data-buku.php">Kelola Data Buku</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEditPeminjaman" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-cog" aria-hidden="true"></i></div>
                                Kelola Peminjaman
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseEditPeminjaman" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
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
                        <h1 class="mt-4">Tambah Data Buku</h1>
                        <ol style="background-color: white !important;" class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tambah Data Buku</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-book mr-1"></i>
                                Input Data Buku
                            </div>
                            <div class="card-body">
                                <form action="../../resources/pegawai/tambah-data-buku.php" method="POST" name="form-tambah-data-buku">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputISBN">ISBN Buku</label>
                                        <input class="form-control py-4" id="inputISBN" name="isbn_buku" type="number" placeholder="Ketik isbn buku" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputJudul">Judul Buku</label>
                                        <input class="form-control py-4" id="inputJudul" name="judul" type="text" placeholder="Ketik judul buku" />
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPenerbit">Penerbit</label>
                                                <select style="overflow: scroll;" class="form-control" id="inputPenerbit" name="penerbit">
                                                
                                                    <option value="-">-- Pilih Penerbit --</option>
                                                    <?php

                                                    include '../../resources/config.php';

                                                    $sql = "SELECT * FROM penerbit";
                                                    $penerbit = mysqli_query($conn, $sql);

                                                    while ($data= mysqli_fetch_assoc($penerbit)) {
                                                        
                                                        echo "<option value=".$data['id_penerbit'].">".$data['penerbit']."</option>";
                                                    }      
                                                    
                                                    mysqli_close($conn);

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPenerbitBaru">Penerbit Tidak Ada? Input Penerbit Baru Disini</label>
                                                <input class="form-control py-4" id="inputPenerbitBaru" name="penerbit_baru" type="text" placeholder="Ketik penerbit baru" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPenulis">Penulis</label>
                                                <select style="overflow: scroll;" class="form-control" id="inputPenulis" name="penulis">
                                                
                                                    <option value="-">-- Pilih Penulis --</option>
                                                    <?php

                                                    include '../../resources/config.php';

                                                    $sql = "SELECT * FROM penulis";
                                                    $penulis = mysqli_query($conn, $sql);

                                                    while ($data= mysqli_fetch_assoc($penulis)) {
                                                        
                                                        echo "<option value=".$data['id_penulis'].">".$data['penulis']."</option>";
                                                    }      
                                                    
                                                    mysqli_close($conn);

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPenulisBaru">Penulis Tidak Ada? Input Penulis Baru Disini</label>
                                                <input class="form-control py-4" id="inputPenulisBaru" name="penulis_baru" type="text" placeholder="Ketik penulis baru" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputKategori">Kategori</label>
                                            <select style="overflow: scroll;" class="form-control" id="inputKategori" name="kategori">
                                                
                                                <option value="-">-- Pilih Kategori --</option>
                                                <?php

                                                include '../../resources/config.php';

                                                $sql = "SELECT * FROM kategori";
                                                $kategori = mysqli_query($conn, $sql);

                                                while ($data= mysqli_fetch_assoc($kategori)) {
                                                        
                                                    echo "<option value=".$data['id_kategori'].">".$data['kategori']."</option>";
                                                }      
                                                    
                                                mysqli_close($conn);

                                                ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputHalaman">Halaman</label>
                                        <input class="form-control py-4" id="inputHalaman" name="halaman" type="number" placeholder="Ketik jumlah halaman buku" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputStok">Stok</label>
                                        <input class="form-control py-4" id="inputStok" name="stok" type="number" placeholder="Ketik jumlah stok buku" />
                                    </div>   
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputTahunTerbit">Tahun Terbit</label>
                                        <input class="form-control py-4" id="inputTahunTerbit" name="tahun_terbit" type="text" placeholder="yyyy" maxlength="4"/>
                                    </div>   
                                    <div class="form-group mt-4 mb-0">
                                        <!-- <input class="btn btn-primary btn-block" type="submit" name="Submit" value="Submit"> -->
                                        <button class="btn btn-primary btn-block" type="submit" name="Submit" value="Submit">Submit</button>
                                    </div>
                                </form>
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
