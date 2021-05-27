<?php

$db_servername = "localhost";
$db_name = "perpusku";
$db_username = "root";
$db_password = "";

$conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Koneksi database gagal! " .mysqli_connect_error());
}

?>