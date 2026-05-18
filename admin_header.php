<?php

if (!isset($page_title)) { $page_title = 'Dashboard Admin'; }
if (!isset($active_menu)) { $active_menu = ''; }
$nama_admin = isset($_SESSION['nama_lengkap']) ? htmlspecialchars($_SESSION['nama_lengkap']) : 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?> - HN Amanah Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg site-navbar admin-navbar">
  <div class="container">
    <a href="dashboard.php" class="navbar-brand brand">HN Amanah Travel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item"><a href="dashboard.php" class="nav-link <?php if($active_menu=='dashboard') echo 'active'; ?>">Dashboard</a></li>
        <li class="nav-item"><a href="admin.php?page=paket" class="nav-link <?php if($active_menu=='paket') echo 'active'; ?>">Data Paket</a></li>
        <li class="nav-item"><a href="admin.php?page=testimoni" class="nav-link <?php if($active_menu=='testimoni') echo 'active'; ?>">Data Testimoni</a></li>
        <li class="nav-item"><a href="admin.php?page=pendaftaran" class="nav-link <?php if($active_menu=='pendaftaran') echo 'active'; ?>">Data Pendaftaran</a></li>
        <li class="nav-item"><a href="index.php" class="nav-link">Lihat Website</a></li>
        <li class="nav-item"><span class="admin-name">👤 <?php echo $nama_admin; ?></span></li>
        <li class="nav-item ms-lg-2"><a href="logout.php" class="btn-admin-logout">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>