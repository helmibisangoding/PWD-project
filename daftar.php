<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = isset($_POST['nama_lengkap']) ? trim($_POST['nama_lengkap']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $no_hp = isset($_POST['no_hp']) ? trim($_POST['no_hp']) : '';
    $paket_diminati = isset($_POST['paket_diminati']) ? trim($_POST['paket_diminati']) : '';
    $catatan = isset($_POST['catatan']) ? trim($_POST['catatan']) : '';
    $tanggal_daftar = date('Y-m-d');
    $status = 'Baru';

    if ($nama_lengkap == '' || $email == '' || $no_hp == '' || $paket_diminati == '') {
        header('location: daftar.php?pesan=kosong');
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: daftar.php?pesan=email_salah');
        exit();
    }
    if (!preg_match('/^[0-9]{10,15}$/', $no_hp)) {
        header('location: daftar.php?pesan=nohp_salah');
        exit();
    }

    $nama_lengkap = mysqli_real_escape_string($konek, $nama_lengkap);
    $email = mysqli_real_escape_string($konek, $email);
    $no_hp = mysqli_real_escape_string($konek, $no_hp);
    $paket_diminati = mysqli_real_escape_string($konek, $paket_diminati);
    $catatan = mysqli_real_escape_string($konek, $catatan);

    $query = mysqli_query($konek, "INSERT INTO pendaftaran (nama_lengkap, email, no_hp, paket_diminati, tanggal_daftar, status, catatan) VALUES ('$nama_lengkap', '$email', '$no_hp', '$paket_diminati', '$tanggal_daftar', '$status', '$catatan')");
    if ($query) {
        header('location: daftar.php?pesan=berhasil');
    } else {
        header('location: daftar.php?pesan=gagal');
    }
    exit();
}

$paket_query = mysqli_query($konek, "SELECT nama_paket FROM paket ORDER BY nama_paket ASC");
$paket_terpilih = isset($_GET['paket']) ? $_GET['paket'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Jamaah - HN Amanah Travel</title>
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
        <li class="nav-item"><a class="nav-link" href="testimoni.php">Testimoni</a></li>
        <li class="nav-item"><a class="nav-link" href="hubungi.php">Hubungi Kami</a></li>
        <li class="nav-item"><a class="nav-link active" href="daftar.php">Daftar Jamaah</a></li>
        <li class="nav-item ms-lg-2"><a href="login.php" class="btn-login">Login Admin</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="register-section">
  <div class="container">
    <div class="row g-4 align-items-stretch justify-content-center">
      <div class="col-lg-5">
        <div class="register-info h-100">
          <span class="eyebrow">Pendaftaran Jamaah</span>
          <h1>Mulai Perjalanan Suci Anda</h1>
          <p>Isi data awal pendaftaran. Data akan masuk ke dashboard admin, lalu tim HN Amanah Travel akan menghubungi Anda melalui WhatsApp.</p>
          <div class="info-list">
            <div><strong>1</strong><span>Pilih paket yang diminati</span></div>
            <div><strong>2</strong><span>Admin mengecek data masuk</span></div>
            <div><strong>3</strong><span>Tim menghubungi Anda untuk konsultasi</span></div>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="form-panel register-card">
          <h2>Form Pendaftaran</h2>
          <p class="form-help">Lengkapi data berikut dengan benar agar admin mudah menghubungi Anda.</p>

          <?php if (isset($_GET['pesan'])) { ?>
            <?php if ($_GET['pesan'] == 'berhasil') { ?>
              <div class="alert alert-success">Pendaftaran berhasil dikirim. Admin akan menghubungi Anda.</div>
            <?php } else if ($_GET['pesan'] == 'kosong') { ?>
              <div class="alert alert-error">Nama, email, nomor WhatsApp, dan paket wajib diisi.</div>
            <?php } else if ($_GET['pesan'] == 'email_salah') { ?>
              <div class="alert alert-error">Format email tidak sesuai.</div>
            <?php } else if ($_GET['pesan'] == 'nohp_salah') { ?>
              <div class="alert alert-error">Nomor WhatsApp harus berupa angka 10 sampai 15 digit.</div>
            <?php } else if ($_GET['pesan'] == 'gagal') { ?>
              <div class="alert alert-error">Pendaftaran gagal dikirim. Silakan coba lagi.</div>
            <?php } ?>
          <?php } ?>

          <form method="POST" action="daftar.php" class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="nama_lengkap" class="form-control form-control-lg" placeholder="Nama sesuai identitas" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">No. WhatsApp</label>
              <input type="text" name="no_hp" class="form-control form-control-lg" placeholder="08xxxxxxxxxx" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control form-control-lg" placeholder="contoh@email.com" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Paket yang Diminati</label>
              <select name="paket_diminati" class="form-select form-select-lg" required>
                <option value="">-- Pilih Paket --</option>
                <?php while ($paket = mysqli_fetch_array($paket_query)) { ?>
                  <option value="<?php echo htmlspecialchars($paket['nama_paket']); ?>" <?php if ($paket_terpilih == $paket['nama_paket']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($paket['nama_paket']); ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Catatan Tambahan</label>
              <textarea name="catatan" class="form-control" rows="5" placeholder="Contoh: ingin konsultasi jadwal keberangkatan keluarga"></textarea>
            </div>
            <div class="col-12 d-flex flex-wrap gap-2 pt-2">
              <button type="submit" class="btn-primary">Kirim Pendaftaran</button>
              <a href="paket.php" class="btn-outline">Lihat Paket</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<footer class="footer"><div class="container footer-inner"><div class="footer-brand">HN Amanah Travel</div></div></footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>