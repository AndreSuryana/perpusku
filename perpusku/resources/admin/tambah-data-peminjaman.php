<?php
    session_start();
    include('../config.php');

    // Button check
    if ($_POST['Submit'] == 'Submit') {

        $peminjam       = $_POST['peminjam'];
        $isbn_buku      = $_POST['isbn_buku'];
        $tgl_pinjam     = date('d-m-Y', strtotime($_POST['tanggal_pinjam']));
        $tgl_kembali    = date('d-m-Y', strtotime($_POST['tanggal_kembali']));

        // Validate empty data
        if (empty($_POST['peminjam']) || empty($_POST['isbn_buku']) || empty($_POST['tanggal_pinjam']) || empty($_POST['tanggal_kembali'])) {
            
            ?> 
                <script type="text/javascript">
                    alert('Harap Cek Kelengkapan Data!');
                    window.location = '../../views/admin/tambah-data-peminjaman.php';
                </script>
            <?php
        }
        else {
            
            // Get id_pegawai
            $username_pegawai = $_SESSION['username'];
            $sql_pegawai = "CALL getIdPegawai('$username_pegawai')";
            $query_pegawai = mysqli_query($conn, $sql_pegawai);

            $result_pegawai = mysqli_fetch_assoc($query_pegawai);

            foreach ($result_pegawai as $peg_id) {
                $id_pegawai = $peg_id;
            }

            mysqli_close($conn);
            
            // Id denda = id peminjam
            $id_denda = $peminjam;

            // Debug Variabel:
            // echo $peminjam."<br>";
            // echo $isbn_buku."<br>";
            // echo $id_denda."<br>";
            // echo $id_pegawai."<br>";
            // echo $tgl_pinjam."<br>";
            // echo $tgl_kembali."<br>";
            
            // Insert Data ke Tabel peminjam
            include '../config.php';

            $sql = "INSERT INTO peminjaman (id_peminjam, isbn_buku, id_denda, id_pegawai, tanggal_pinjam, tanggal_kembali) 
                    VALUES ($peminjam, '$isbn_buku', $id_denda, $id_pegawai, STR_TO_DATE('$tgl_pinjam','%d-%m-%Y'), STR_TO_DATE('$tgl_kembali','%d-%m-%Y'));";
            $query_insert = mysqli_query($conn, $sql);

            if ($query_insert) {

                // If Success
                ?> 
                    <script type="text/javascript">
                        alert('Input Data Peminjam Berhasil');
                        window.location = '../../views/admin/kelola-peminjaman.php';
                    </script>
                <?php
            }
            else {

                // If Failed
                ?> 
                    <script type="text/javascript">
                        alert('Input Data Peminjam Gagal! Silahkan ulangi lagi!');
                        window.location = '../../views/admin/tambah-data-peminjaman.php';
                    </script>
                <?php
            }
        }
    }

?>