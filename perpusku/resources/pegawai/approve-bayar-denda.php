<?php 

    include('../config.php');
    error_reporting(E_ALL ^ E_NOTICE);
    error_reporting(E_ERROR | E_PARSE);

    // Button check
    if ($_POST['approve'] == 'Approve') {

        $id_denda       = $_POST['id_denda'];
        $jumlah_denda   = $_POST['jumlah_denda'];

        if ($jumlah_denda > 0) {
            
            $sql = "CALL approvePembayaranDenda($id_denda)";
            $query = mysqli_query($conn, $sql);
        }
        else {

            // Belum ada denda
            ?>
                <script type="text/javascript">
                    alert('Belum ada denda!');
                    window.location = '../../views/pegawai/kelola-denda.php';
                </script>
            <?php
        }

        if($query) {

            // Berhasil
            ?>
                <script type="text/javascript">
                    alert('Berhasil approve pembayaran denda!');
                    window.location = '../../views/pegawai/kelola-denda.php';
                </script>
            <?php
        }
        else {

            // Gagal
            ?>
                <script type="text/javascript">
                    alert('Gagal approve pembayaran denda!');
                    window.location = '../../views/pegawai/kelola-denda.php';
                </script>
            <?php
        }

    }

?>