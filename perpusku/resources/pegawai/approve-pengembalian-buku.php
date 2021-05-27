<?php 

    include('../config.php');
    error_reporting(E_ALL ^ E_NOTICE);
    error_reporting(E_ERROR | E_PARSE);

    // Button check
    if ($_POST['approve'] == 'Approve') {

        $id_peminjaman  = $_POST['id_peminjaman'];

        $sql = "CALL approvePengembalianBuku($id_peminjaman)";
        $query = mysqli_query($conn, $sql);

        if($query) {

            // Berhasil
            ?>
                <script type="text/javascript">
                    alert('Buku telah diterima!');
                    window.location = '../../views/pegawai/kelola-peminjaman.php';
                </script>
            <?php
        }
        else {

            // Gagal
            ?>
                <script type="text/javascript">
                    alert('Buku gagal diterima!');
                    window.location = '../../views/pegawai/kelola-peminjaman.php';
                </script>
            <?php
        }

    }

?>