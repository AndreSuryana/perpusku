<?php

    include('../config.php');

    // Button check
    if ($_POST['Submit'] == 'Submit') {

        $nama_lengkap   = $_POST['nama_lengkap'];
        $nik            = $_POST['nik'];
        $no_telp        = $_POST['no_telp'];
        $alamat         = $_POST['alamat'];

        // Validate empty data
        if (empty($_POST['nama_lengkap']) || empty($_POST['nik']) || empty($_POST['no_telp']) || empty($_POST['alamat'])) {
            
            ?> 
                <script type="text/javascript">
                    alert('Harap Cek Kelengkapan Data!');
                    window.location = '../../views/pegawai/tambah-data-peminjam.php';
                </script>
            <?php
        }
        else {

            // Check data sudah ada atau belum di database
            // Data peminjam (nama) tidak boleh ada duplikat
            $sql = "CALL showPeminjam()";
            $query_cek_peminjam = mysqli_query($conn, $sql);

            $duplicate = false;

            while ($data = mysqli_fetch_assoc($query_cek_peminjam)) {
                
                if ($data['nama_peminjam'] == $nama_lengkap) {

                    $duplicate = true;
                }
            }
            
            mysqli_close($conn);

            if ($duplicate) {

                // Jika ditemukan duplikat data
                ?> 
                    <script type="text/javascript">
                        alert('Data Tersebut Sudah Ada! Silahkan lanjut input detail peminjaman');
                        window.location = '../../views/pegawai/tambah-data-peminjaman.php';
                    </script>
                <?php
                return;
            }

            // echo $nama_lengkap."<br>";
            // echo $nik."<br>";
            // echo $no_telp."<br>";
            // echo $alamat."<br>";

            include('../config.php');

            // Insert Data ke Tabel peminjam
            $sql = "INSERT INTO peminjam (nama_peminjam, nik, no_telp, alamat)
            VALUES ('$nama_lengkap', '$nik', '$no_telp', '$alamat');";
            $query_insert = mysqli_query($conn, $sql);

            if ($query_insert) {

                // If Success
                ?> 
                    <script type="text/javascript">
                        alert('Input Data Peminjam Berhasil');
                        window.location = '../../views/pegawai/tambah-data-peminjaman.php';
                    </script>
                <?php
            }
            else {

                // If Failed
                ?> 
                    <script type="text/javascript">
                        alert('Input Data Peminjam Gagal! Silahkan ulangi lagi!');
                        window.location = '../../views/pegawai/tambah-data-peminjam.php';
                    </script>
                <?php
            }
            mysqli_close($conn);
        }
    }

?>