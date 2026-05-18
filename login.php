<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['username']) && $_SESSION['status'] == 'login') {
    header('location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($konek, $_POST['username']);
    $password = mysqli_real_escape_string($konek, $_POST['password']);
    $query = mysqli_query($konek, "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_array($query);
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['status'] = 'login';
        header('location: dashboard.php');
        exit();
    } else {
        header('location: login.php?pesan=gagal');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - HN Amanah Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth-page">
  <section class="auth-visual">
    <div class="auth-visual-content">
      <div class="auth-mark">▟</div>
      <h1>Portal Admin HN Amanah Travel</h1>
    </div>
  </section>
  <section class="auth-form-side">
    <div class="auth-card">
      <h2>Login Admin</h2>
      <p class="subtitle">Masukkan username dan password admin.</p>
      <div class="login-card-box">
        <?php if (isset($_GET['pesan'])) { ?>
          <?php if ($_GET['pesan'] == 'gagal') { ?>
            <div class="alert alert-error">Username atau password salah.</div>
          <?php } else if ($_GET['pesan'] == 'logout') { ?>
            <div class="alert alert-success">Anda berhasil logout.</div>
          <?php } else if ($_GET['pesan'] == 'belum_login') { ?>
            <div class="alert alert-warning">Anda harus login terlebih dahulu.</div>
          <?php } ?>
        <?php } ?>
        <form method="POST" action="login.php">
          <div class="form-row">
            <label for="username">USERNAME / EMAIL</label>
            <div class="field">
              <span class="field-icon">✉</span>
              <input type="text" name="username" id="username" placeholder="Contoh: admin" required>
            </div>
          </div>
          <div class="form-row">
            <label for="password">PASSWORD</label>
            <div class="field">
              <span class="field-icon">●</span>
              <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>
          </div>
          <button type="submit" class="btn-wide">Masuk Dashboard →</button>
        </form>
      </div>
      <div class="auth-link" style="margin-top:14px;"><a href="index.php">Kembali ke Beranda</a></div>
    </div>
  </section>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>