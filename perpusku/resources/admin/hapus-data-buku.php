<?php 

    include('../config.php');
    
    error_reporting(E_ALL ^ E_NOTICE);
    error_reporting(E_ERROR | E_PARSE);

    // Button check
    if ($_POST['delete'] == 'Delete') {

        $isbn_buku  = $_POST['isbn_buku'];

        $sql = "CALL hapusBuku('$isbn_buku')";
        $query = mysqli_query($conn, $sql);

        if($query) {

            // Berhasil
            ?>
                <script type="text/javascript">
                    alert('Buku berhasil dihapus!');
                    window.location = '../../views/admin/kelola-data-buku.php';
                </script>
            <?php
        }
        else {

            // Gagal
            ?>
                <script type="text/javascript">
                    alert('Buku gagal dihapus!');
                    window.location = '../../views/admin/kelola-data-buku.php';
                </script>
            <?php
        }

    }

?>