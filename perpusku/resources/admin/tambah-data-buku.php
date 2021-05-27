<?php

    include('../config.php');
    error_reporting(E_ALL ^ E_NOTICE);
    error_reporting(E_ERROR | E_PARSE);

    // Button check
    if ($_POST['Submit'] == 'Submit') {

        $isbn_buku      = $_POST['isbn_buku'];
        $judul          = $_POST['judul'];
        $penerbit       = $_POST['penerbit'];
        $penerbit_baru  = $_POST['penerbit_baru'];
        $penulis        = $_POST['penulis'];
        $penulis_baru   = $_POST['penulis_baru'];
        $kategori       = $_POST['kategori'];
        $halaman        = $_POST['halaman'];
        $stok           = $_POST['stok'];
        $tahun_terbit   = $_POST['tahun_terbit'];

        // Validate data penerbit
        // Jika data penerbit baru tidak kosong
        if (!empty($_POST['penerbit_baru']) && $_POST['penerbit'] == '-') {
            
            include('../config.php');

            // Check data sudah ada atau belum di database
            // Data penerbit_baru tidak boleh ada duplikat
            $sql_cek_penerbit = "SELECT penerbit FROM penerbit";
            $query_cek_penerbit = mysqli_query($conn, $sql_cek_penerbit);

            $duplicate_penerbit = false;

            while ($data = mysqli_fetch_assoc($query_cek_penerbit)) {
                
                if ($data['penerbit'] == $penerbit_baru) {

                    $duplicate_penerbit = true;
                }
            }

            if (!$duplicate_penerbit) {

                $sql_insert_penerbit = "INSERT INTO penerbit (penerbit) VALUES ('$penerbit_baru')";
                $query_insert_penerbit = mysqli_query($conn, $sql_insert_penerbit);

                if ($sql_insert_penerbit) {

                    $sql_get_id = "CALL getIdPenerbit('$penerbit_baru')";
                    $query_get_id = mysqli_query($conn, $sql_get_id);

                    if ($data = mysqli_fetch_assoc($query_get_id)) {

                        $penerbit = $data['id_penerbit'];
                    }
                }
                mysqli_close($conn);
            }
        }

        // Validate data penulis
        // Jika data penulis baru tidak kosong
        if (!empty($_POST['penulis_baru']) && $_POST['penulis'] == '-') {

            include('../config.php');

            // Check data sudah ada atau belum di database
            // Data penulis_baru tidak boleh ada duplikat
            $sql_cek_penulis = "SELECT penulis FROM penulis";
            $query_cek_penulis = mysqli_query($conn, $sql_cek_penulis);

            $duplicate_penulis = false;

            while ($data = mysqli_fetch_assoc($query_cek_penulis)) {
                
                if ($data['penulis'] == $penulis_baru) {

                    $duplicate_penulis = true;
                }
            }

            if (!$duplicate_penulis) {
                
                $sql_insert_penulis = "INSERT INTO penulis (penulis) VALUES ('$penulis_baru')";
                $query_insert_penulis = mysqli_query($conn, $sql_insert_penulis);

                if ($sql_insert_penulis) {

                    $sql_get_id = "CALL getIdPenulis('$penulis_baru')";
                    $query_get_id = mysqli_query($conn, $sql_get_id);

                    if ($data = mysqli_fetch_assoc($query_get_id)) {

                        $penulis = $data['id_penulis'];
                    }
                }

                mysqli_close($conn);
            }
        }

        // Validate rest of the data
        if (empty($_POST['isbn_buku']) || empty($_POST['judul']) || empty($_POST['kategori']) || empty($_POST['halaman']) ||
            empty($_POST['stok']) || empty($_POST['tahun_terbit'])) {
            
            ?> 
                <script type="text/javascript">
                    confirm('Harap Cek Kelengkapan Data!');
                    window.location = '../../views/admin/tambah-data-buku.php';
                </script>
            <?php
            return;
        }
        else {
            
            include('../config.php');

            // Check data sudah ada atau belum di database
            // Data buku (isbn_buku) tidak boleh ada duplikat
            $sql = "SELECT isbn_buku FROM buku";
            $query_cek_buku = mysqli_query($conn, $sql);

            $duplicate = false;

            while ($data2 = mysqli_fetch_assoc($query_cek_buku)) {
                
                if ($data2['isbn_buku'] == $isbn_buku) {

                    $duplicate = true;
                }
            }
            
            if ($duplicate) {

                // Jika ditemukan duplikat data
                ?> 
                    <script type="text/javascript">
                        alert('Data Tersebut Sudah Ada!');
                        window.location = '../../views/admin/tambah-data-buku.php';
                    </script>
                <?php
                return;
            }
            
            // Debugging Variabel:
            // echo "isbn_buku:".$isbn_buku."<br>";
            // echo "judul:".$judul."<br>";
            // echo "penerbit:".$penerbit."<br>";
            // echo "penerbit_baru:".$penerbit_baru."<br>";
            // echo "penulis:".$penulis."<br>";
            // echo "penerbit_baru:".$penulis_baru."<br>";
            // echo "kategori:".$kategori."<br>";
            // echo "halaman:".$halaman."<br>";
            // echo "stok:".$stok."<br>";
            // echo "tahun_terbit:".$tahun_terbit."<br>";

            // Insert Data ke Tabel Buku
            $sql = "CALL tambahBuku('$isbn_buku', '$judul', $penerbit, $penulis, $kategori, $halaman, $stok, '$tahun_terbit')";
            // $sql = "INSERT INTO buku (isbn_buku, judul, id_penerbit, id_penulis, id_kategori, halaman, stok, tahun_terbit) 
            //         VALUES ('$isbn_buku', '$judul', $penerbit, $penulis, $kategori, $halaman, $stok, '$tahun_terbit')";
            $query_insert = mysqli_query($conn, $sql);

            if ($query_insert) {

                // If Success
                ?> 
                    <script type="text/javascript">
                        alert('Input Data Buku Berhasil');
                        window.location = '../../views/admin/tambah-data-buku.php';
                    </script>
                <?php
            }
            else {

                // If Failed
                ?> 
                    <script type="text/javascript">
                        alert('Input Data Buku Gagal! Silahkan ulangi lagi!');
                        window.location = '../../views/admin/tambah-data-buku.php';
                    </script>
                <?php
            }

            mysqli_close($conn);
        }
    }

?>