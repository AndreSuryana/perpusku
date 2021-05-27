<?php

// Mengaktifkan session php dan connect ke config.php
session_start();
include './config.php';


// Mengambil data yang diinput di form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query mencari data pegawai
$sql = mysqli_query($conn, "SELECT * FROM pegawai WHERE username='$username' and password='$password'");

// Count data
$rows = mysqli_num_rows($sql);

// Cek username dan password ke database
if ($rows > 0) {

    $data = mysqli_fetch_assoc($sql);

    // Cek role -> admin
    if ($data['role'] == 'admin') {

        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        
        // Alihkan ke halaman admin
        header("location: ../views/admin/dashboard.php");
    } 
    else if ($data['role'] == 'pegawai') {

        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'pegawai';

        // Alihkan ke halaman pegawai
        header("location: ../views/pegawai/dashboard.php");
    }
    else {
        header("location: ../index.php?msg=error");
    }
}
else {
    header("location: ../index.php?msg=error");
}

?>