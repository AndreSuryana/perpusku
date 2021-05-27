<?php

    include('../config.php');

    // Button check
    if ($_POST['Submit'] == 'Submit') {

        $nama_pegawai       = $_POST['nama_pegawai'];
        $username           = $_POST['username'];
        $password           = $_POST['password'];
        $re_password        = $_POST['re_password'];
        $role               = $_POST['role'];
        $email              = $_POST['email'];
        $nik                = $_POST['nik'];
        $alamat             = $_POST['alamat'];
        $no_telp            = $_POST['no_telp'];

        // Validate empty data
        if (empty($_POST['nama_pegawai']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['re_password']) ||
            empty($_POST['role']) || empty($_POST['email']) || empty($_POST['nik']) || empty($_POST['alamat']) || empty($_POST['no_telp'])) {
            
            ?> 
                <script type="text/javascript">
                    confirm('Harap Cek Kelengkapan Data!');
                    window.location = '../../views/admin/tambah-data-pegawai.php';
                </script>
            <?php
        }
        else {
            
            // Check password dan re_password sama
            if ($password != $re_password) {
                ?> 
                    <script type="text/javascript">
                        confirm('Password yang Anda Input Tidak Sama! Silahkan ulangi lagi!');
                        window.location = '../../views/admin/tambah-data-pegawai.php';
                    </script>
                <?php
                return;
            }

            // Check data sudah ada atau belum di database
            // Data peminjam (nama) tidak boleh ada duplikat
            $sql = "SELECT username FROM pegawai";
            $query_cek_pegawai = mysqli_query($conn, $sql);

            $duplicate = false;

            while ($data = mysqli_fetch_assoc($query_cek_pegawai)) {
                
                if ($data['username'] == $username) {

                    $duplicate = true;
                }
            }
            
            if ($duplicate) {

                // Jika ditemukan duplikat data
                ?> 
                    <script type="text/javascript">
                        confirm('Data Tersebut Sudah Ada!');
                        window.location = '../../views/admin/tambah-data-pegawai.php';
                    </script>
                <?php
                return;
            }
            
            // Insert Data ke Tabel pegawai
            //$sql = "INSERT INTO pegawai (nama_pegawai, username, password, role, email, nik, alamat, no_telp) VALUES ('$nama_pegawai', '$username', '$password', '$role', '$email', '$nik', '$alamat', '$no_telp')";
            $sql = "CALL tambahPegawai('$username', '$password', '$role', '$nama_pegawai', '$email', '$nik', '$alamat', '$no_telp')";
            $query_insert = mysqli_query($conn, $sql);

            if ($query_insert) {

                // If Success
                ?> 
                    <script type="text/javascript">
                        confirm('Input Data Pegawai Berhasil');
                        window.location = '../../views/admin/tambah-data-pegawai.php';
                    </script>
                <?php
            }
            else {

                // If Failed
                ?> 
                    <script type="text/javascript">
                        confirm('Input Data Pegawai Gagal! Silahkan ulangi lagi!');
                        window.location = '../../views/admin/tambah-data-pegawai.php';
                    </script>
                <?php
            }
        }
    }

?>