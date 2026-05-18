<?php
include 'koneksi.php';
$query = mysqli_query($konek, "SELECT * FROM paket ORDER BY id_paket ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paket Haji & Umroh - HN Amanah Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg site-navbar">
  <div class="container">
    <a href="index.php" class="navbar-brand brand">HN Amanah Travel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Kami</a></li>
        <li class="nav-item"><a class="nav-link active" href="paket.php">Paket Haji & Umroh</a></li>
        <li class="nav-item"><a class="nav-link" href="testimoni.php">Testimoni</a></li>
        <li class="nav-item"><a class="nav-link" href="hubungi.php">Hubungi Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="daftar.php">Daftar Jamaah</a></li>
        <li class="nav-item ms-lg-2"><a href="login.php" class="btn-login">Login Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
<header class="package-hero">
  <div class="container">
    <span class="eyebrow">Paket Pilihan</span>
    <h1>Paket Haji &amp; Umroh</h1>
  </div>
</header>
<main class="section">
  <div class="container">
    <div class="card-grid-3">
      <?php while ($data = mysqli_fetch_array($query)) { ?>
      <article class="package-card">
        <div class="package-head">
          <h3><?php echo htmlspecialchars($data['nama_paket']); ?></h3>
          <div class="package-price">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></div>
        </div>
        <div class="package-body">
          <p><?php echo htmlspecialchars($data['deskripsi']); ?></p>
          <ul>
            <li>Jenis: <?php echo htmlspecialchars($data['jenis_paket']); ?></li>
            <li>Durasi: <?php echo htmlspecialchars($data['durasi']); ?></li>
            <li>Fasilitas: <?php echo htmlspecialchars($data['fasilitas']); ?></li>
          </ul>
          <a href="daftar.php?paket=<?php echo urlencode($data['nama_paket']); ?>" class="btn-small">Daftar Paket</a>
        </div>
      </article>
      <?php } ?>
    </div>
  </div>
</main>
<footer class="footer"><div class="container footer-inner"><div class="footer-brand">HN Amanah Travel</div></div></footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>