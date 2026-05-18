<?php

$hostname = "localhost";
$username_db = "root";
$password_db = "";
$database = "sacred_journey";

$konek = mysqli_connect($hostname, $username_db, $password_db, $database);

if (!$konek) {
    die("Maaf koneksi gagal: " . mysqli_connect_error());
}
?>