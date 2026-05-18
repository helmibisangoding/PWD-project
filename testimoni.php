<?php
include 'koneksi.php';
$query = mysqli_query($konek, "SELECT * FROM testimoni ORDER BY id_testimoni DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Testimoni - HN Amanah Travel</title>
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
        <li class="nav-item"><a class="nav-link" href="paket.php">Paket Haji & Umroh</a></li>
        <li class="nav-item"><a class="nav-link active" href="testimoni.php">Testimoni</a></li>
        <li class="nav-item"><a class="nav-link" href="hubungi.php">Hubungi Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="daftar.php">Daftar Jamaah</a></li>
        <li class="nav-item ms-lg-2"><a href="login.php" class="btn-login">Login Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
<header class="testi-hero">
  <div class="container">
    <h1>Suara Hati Jamaah</h1>
  </div>
</header>
<main class="section">
  <div class="container">
    <div class="testi-grid">
      <?php while ($data = mysqli_fetch_array($query)) { ?>
      <article class="testi-card">
        <span class="badge"><?php echo htmlspecialchars($data['nama_paket']); ?></span>
        <div>
          <div class="testi-stars"><?php for($i=1; $i <= $data['rating']; $i++){ echo '★'; } ?></div>
          <p class="testi-text">"<?php echo htmlspecialchars($data['isi_testimoni']); ?>"</p>
        </div>
        <div class="testi-author">
          <div class="avatar"><?php echo strtoupper(substr($data['nama_jamaah'], 0, 1)); ?></div>
          <div>
            <div class="author-name"><?php echo htmlspecialchars($data['nama_jamaah']); ?></div>
            <div class="author-meta"><?php echo htmlspecialchars($data['tanggal']); ?></div>
          </div>
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