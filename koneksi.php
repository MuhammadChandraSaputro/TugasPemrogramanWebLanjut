<?php
$host = "127.0.0.1"; 
$username = "root";
$password = "";
$database = "mahasiswa";


$koneksi = mysqli_connect($host, $username, $password, $database);


if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>