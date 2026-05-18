<?php
include 'auth.php';
include 'koneksi.php';
$page_title = 'Dashboard Admin';
$active_menu = 'dashboard';
include 'admin_header.php';
$jml_paket = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM paket"));
$jml_testimoni = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM testimoni"));
$jml_pendaftaran = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM pendaftaran"));
?>
<header class="member-hero">
  <div class="container">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></strong>. Halaman ini digunakan untuk mengelola data paket, testimoni, dan pendaftaran jamaah.</p>
  </div>
</header>
<main class="section section-light">
  <div class="container">
    <?php if (isset($_GET['pesan'])) { ?>
      <div class="alert alert-success">Proses berhasil dilakukan.</div>
    <?php } ?>
    <div class="dashboard-grid">
      <article class="dashboard-card">
        <div class="icon-circle">▣</div>
        <h3>Data Paket</h3>
        <p><?php echo $jml_paket; ?> paket tersimpan di database.</p>
        <a href="admin.php?page=paket" class="btn-small">Kelola Paket</a>
      </article>
      <article class="dashboard-card">
        <div class="icon-circle">★</div>
        <h3>Data Testimoni</h3>
        <p><?php echo $jml_testimoni; ?> testimoni jamaah tersimpan.</p>
        <a href="admin.php?page=testimoni" class="btn-small">Kelola Testimoni</a>
      </article>
      <article class="dashboard-card">
        <div class="icon-circle">☰</div>
        <h3>Data Pendaftaran</h3>
        <p><?php echo $jml_pendaftaran; ?> data jamaah terdaftar.</p>
        <a href="admin.php?page=pendaftaran" class="btn-small">Kelola Pendaftaran</a>
      </article>
    </div>
  </div>
</main>
<?php include 'admin_footer.php'; ?>