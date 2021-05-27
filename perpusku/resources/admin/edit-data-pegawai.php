<?php

    include('../config.php');

    // Button check
    if ($_POST['Submit'] == 'Submit') {

        $id_pegawai         = $_POST['id_pegawai'];
        $nama_pegawai       = $_POST['nama_pegawai'];
        $username           = $_POST['username'];
        $password           = $_POST['password'];
        $re_password        = $_POST['re_password'];
        $role               = $_POST['role'];
        $email              = $_POST['email'];
        $nik                = $_POST['nik'];
        $alamat             = $_POST['alamat'];
        $no_telp            = $_POST['no_telp'];

        // echo $id_pegawai."<br>";
        // echo $nama_pegawai."<br>";
        // echo $username."<br>";
        // echo $password."<br>";
        // echo $re_password."<br>";
        // echo $role."<br>";
        // echo $email."<br>";
        // echo $nik."<br>";
        // echo $alamat."<br>";
        // echo $no_telp."<br>";

        // Validate empty data
        if (empty($_POST['nama_pegawai']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['re_password']) ||
            empty($_POST['role']) || empty($_POST['email']) || empty($_POST['nik']) || empty($_POST['alamat']) || empty($_POST['no_telp'])) {
            
            ?> 
                <script type="text/javascript">
                    confirm('Harap Cek Kelengkapan Data!');
                    window.location = '../../views/admin/kelola-data-pegawai.php?';
                </script>
            <?php
        }
        else {
            
            // Check password dan re_password sama
            if ($password != $re_password) {
                ?> 
                    <script type="text/javascript">
                        confirm('Password yang Anda Input Tidak Sama! Silahkan ulangi lagi!');
                        window.location = '../../views/admin/kelola-data-pegawai.php';
                    </script>
                <?php
                return;
            }
            
            // Update Data Tabel pegawai
            $sql = "CALL editPegawai($id_pegawai, '$username', '$password', '$role', '$nama_pegawai', '$email', '$nik', '$alamat', '$no_telp')";
            $query = mysqli_query($conn, $sql);

            if ($query) {

                // If Success
                ?> 
                    <script type="text/javascript">
                        confirm('Input Data Pegawai Berhasil');
                        window.location = '../../views/admin/kelola-data-pegawai.php';
                    </script>
                <?php
            }
            else {

                // If Failed
                ?> 
                    <script type="text/javascript">
                        confirm('Input Data Pegawai Gagal! Silahkan ulangi lagi!');
                        window.location = '../../views/admin/kelola-data-pegawai.php?';
                    </script>
                <?php
            }
        }
    }

?>