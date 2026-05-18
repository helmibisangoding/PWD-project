<?php
session_start();
if (empty($_SESSION['username']) || empty($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("location: login.php?pesan=belum_login");
    exit();
}
?>