<?php 

    include('../config.php');

    error_reporting(E_ALL ^ E_NOTICE);
    error_reporting(E_ERROR | E_PARSE);

    // Button check
    if ($_POST['delete'] == 'Delete') {

        $id_pegawai     = $_POST['id_pegawai'];
        $username       = $_POST['username'];
        $role           = $_POST['role'];

        $sql = "CALL hapusPegawai($id_pegawai)";
        $query = mysqli_query($conn, $sql);

        if($query) {

            // Berhasil
            ?>
                <script type="text/javascript">
                    alert('Data pegawai berhasil dihapus!');
                    window.location = '../../views/admin/kelola-data-pegawai.php';
                </script>
            <?php
        }
        else {

            // Gagal
            ?>
                <script type="text/javascript">
                    alert('Data pegawai gagal dihapus!');
                    window.location = '../../views/admin/kelola-data-pegawai.php';
                </script>
            <?php
        }

    }

?>