<?php
include 'auth.php';
include 'koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'paket';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'tampil';

$daftar_page = array('paket', 'testimoni', 'pendaftaran');
if (!in_array($page, $daftar_page)) {
    $page = 'paket';
}

function bersihkan($konek, $nilai) {
    return mysqli_real_escape_string($konek, trim($nilai));
}

function kembali($page, $pesan = 'berhasil') {
    header('location: admin.php?page=' . $page . '&pesan=' . $pesan);
    exit();
}

/* PROSES SIMPAN */
if ($aksi == 'simpan' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($page == 'paket') {
        $nama_paket = bersihkan($konek, $_POST['nama_paket']);
        $jenis_paket = bersihkan($konek, $_POST['jenis_paket']);
        $harga = bersihkan($konek, $_POST['harga']);
        $durasi = bersihkan($konek, $_POST['durasi']);
        $fasilitas = bersihkan($konek, $_POST['fasilitas']);
        $deskripsi = bersihkan($konek, $_POST['deskripsi']);
        mysqli_query($konek, "INSERT INTO paket (nama_paket, jenis_paket, harga, durasi, fasilitas, deskripsi) VALUES ('$nama_paket', '$jenis_paket', '$harga', '$durasi', '$fasilitas', '$deskripsi')");
        kembali('paket');
    }

    if ($page == 'testimoni') {
        $nama_jamaah = bersihkan($konek, $_POST['nama_jamaah']);
        $nama_paket = bersihkan($konek, $_POST['nama_paket']);
        $rating = bersihkan($konek, $_POST['rating']);
        $isi_testimoni = bersihkan($konek, $_POST['isi_testimoni']);
        $tanggal = bersihkan($konek, $_POST['tanggal']);
        mysqli_query($konek, "INSERT INTO testimoni (nama_jamaah, nama_paket, rating, isi_testimoni, tanggal) VALUES ('$nama_jamaah', '$nama_paket', '$rating', '$isi_testimoni', '$tanggal')");
        kembali('testimoni');
    }

    if ($page == 'pendaftaran') {
        $nama_lengkap = bersihkan($konek, $_POST['nama_lengkap']);
        $email = bersihkan($konek, $_POST['email']);
        $no_hp = bersihkan($konek, $_POST['no_hp']);
        $paket_diminati = bersihkan($konek, $_POST['paket_diminati']);
        $tanggal_daftar = bersihkan($konek, $_POST['tanggal_daftar']);
        $status = bersihkan($konek, $_POST['status']);
        $catatan = bersihkan($konek, $_POST['catatan']);
        mysqli_query($konek, "INSERT INTO pendaftaran (nama_lengkap, email, no_hp, paket_diminati, tanggal_daftar, status, catatan) VALUES ('$nama_lengkap', '$email', '$no_hp', '$paket_diminati', '$tanggal_daftar', '$status', '$catatan')");
        kembali('pendaftaran');
    }
}

/* PROSES UPDATE */
if ($aksi == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($page == 'paket') {
        $id = bersihkan($konek, $_POST['id_paket']);
        $nama_paket = bersihkan($konek, $_POST['nama_paket']);
        $jenis_paket = bersihkan($konek, $_POST['jenis_paket']);
        $harga = bersihkan($konek, $_POST['harga']);
        $durasi = bersihkan($konek, $_POST['durasi']);
        $fasilitas = bersihkan($konek, $_POST['fasilitas']);
        $deskripsi = bersihkan($konek, $_POST['deskripsi']);
        mysqli_query($konek, "UPDATE paket SET nama_paket='$nama_paket', jenis_paket='$jenis_paket', harga='$harga', durasi='$durasi', fasilitas='$fasilitas', deskripsi='$deskripsi' WHERE id_paket='$id'");
        kembali('paket');
    }

    if ($page == 'testimoni') {
        $id = bersihkan($konek, $_POST['id_testimoni']);
        $nama_jamaah = bersihkan($konek, $_POST['nama_jamaah']);
        $nama_paket = bersihkan($konek, $_POST['nama_paket']);
        $rating = bersihkan($konek, $_POST['rating']);
        $isi_testimoni = bersihkan($konek, $_POST['isi_testimoni']);
        $tanggal = bersihkan($konek, $_POST['tanggal']);
        mysqli_query($konek, "UPDATE testimoni SET nama_jamaah='$nama_jamaah', nama_paket='$nama_paket', rating='$rating', isi_testimoni='$isi_testimoni', tanggal='$tanggal' WHERE id_testimoni='$id'");
        kembali('testimoni');
    }

    if ($page == 'pendaftaran') {
        $id = bersihkan($konek, $_POST['id_pendaftaran']);
        $nama_lengkap = bersihkan($konek, $_POST['nama_lengkap']);
        $email = bersihkan($konek, $_POST['email']);
        $no_hp = bersihkan($konek, $_POST['no_hp']);
        $paket_diminati = bersihkan($konek, $_POST['paket_diminati']);
        $tanggal_daftar = bersihkan($konek, $_POST['tanggal_daftar']);
        $status = bersihkan($konek, $_POST['status']);
        $catatan = bersihkan($konek, $_POST['catatan']);
        mysqli_query($konek, "UPDATE pendaftaran SET nama_lengkap='$nama_lengkap', email='$email', no_hp='$no_hp', paket_diminati='$paket_diminati', tanggal_daftar='$tanggal_daftar', status='$status', catatan='$catatan' WHERE id_pendaftaran='$id'");
        kembali('pendaftaran');
    }
}

/* PROSES HAPUS */
if ($aksi == 'hapus') {
    $id = isset($_GET['id']) ? bersihkan($konek, $_GET['id']) : '';
    if ($page == 'paket') {
        mysqli_query($konek, "DELETE FROM paket WHERE id_paket='$id'");
    } else if ($page == 'testimoni') {
        mysqli_query($konek, "DELETE FROM testimoni WHERE id_testimoni='$id'");
    } else if ($page == 'pendaftaran') {
        mysqli_query($konek, "DELETE FROM pendaftaran WHERE id_pendaftaran='$id'");
    }
    kembali($page);
}

$judul = array(
    'paket' => 'Data Paket Haji & Umroh',
    'testimoni' => 'Data Testimoni Jamaah',
    'pendaftaran' => 'Data Pendaftaran Jamaah'
);
$page_title = $judul[$page];
$active_menu = $page;
include 'admin_header.php';
?>

<main class="section section-light">
  <div class="container<?php if ($aksi == 'tambah' || $aksi == 'edit') echo ' narrow'; ?>">

<?php
/* HALAMAN TAMPIL DATA */
if ($aksi == 'tampil') {
    if ($page == 'paket') {
        $query = mysqli_query($konek, "SELECT * FROM paket ORDER BY id_paket ASC");
?>
    <div class="page-head">
      <div><span class="eyebrow">CRUD Paket</span><h1>Data Paket Haji &amp; Umroh</h1><p>Admin dapat menambah, melihat, mengedit, dan menghapus data paket.</p></div>
      <a href="admin.php?page=paket&aksi=tambah" class="btn-primary">+ Tambah Paket</a>
    </div>
    <?php if(isset($_GET['pesan'])) { ?><div class="alert alert-success">Data paket berhasil diproses.</div><?php } ?>
    <div class="table-wrap"><table class="data-table">
      <tr><th>No</th><th>Nama Paket</th><th>Jenis</th><th>Harga</th><th>Durasi</th><th>Fasilitas</th><th>Aksi</th></tr>
      <?php $no=1; while($data=mysqli_fetch_array($query)) { ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo htmlspecialchars($data['nama_paket']); ?></td>
        <td><?php echo htmlspecialchars($data['jenis_paket']); ?></td>
        <td>Rp <?php echo number_format($data['harga'],0,',','.'); ?></td>
        <td><?php echo htmlspecialchars($data['durasi']); ?></td>
        <td><?php echo htmlspecialchars($data['fasilitas']); ?></td>
        <td class="action-cell">
          <a href="admin.php?page=paket&aksi=edit&id=<?php echo $data['id_paket']; ?>" class="btn-edit">Edit</a>
          <a href="admin.php?page=paket&aksi=hapus&id=<?php echo $data['id_paket']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data paket ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </table></div>
<?php
    }

    if ($page == 'testimoni') {
        $query = mysqli_query($konek, "SELECT * FROM testimoni ORDER BY id_testimoni DESC");
?>
    <div class="page-head"><div><span class="eyebrow">CRUD Testimoni</span><h1>Data Testimoni Jamaah</h1><p>Data testimoni yang dikelola di sini akan muncul otomatis di halaman testimoni publik.</p></div><a href="admin.php?page=testimoni&aksi=tambah" class="btn-primary">+ Tambah Testimoni</a></div>
    <?php if(isset($_GET['pesan'])) { ?><div class="alert alert-success">Data testimoni berhasil diproses.</div><?php } ?>
    <div class="table-wrap"><table class="data-table"><tr><th>No</th><th>Nama Jamaah</th><th>Paket</th><th>Rating</th><th>Tanggal</th><th>Isi Testimoni</th><th>Aksi</th></tr>
    <?php $no=1; while($data=mysqli_fetch_array($query)) { ?><tr><td><?php echo $no++; ?></td><td><?php echo htmlspecialchars($data['nama_jamaah']); ?></td><td><?php echo htmlspecialchars($data['nama_paket']); ?></td><td><?php echo $data['rating']; ?></td><td><?php echo htmlspecialchars($data['tanggal']); ?></td><td><?php echo htmlspecialchars($data['isi_testimoni']); ?></td><td class="action-cell"><a href="admin.php?page=testimoni&aksi=edit&id=<?php echo $data['id_testimoni']; ?>" class="btn-edit">Edit</a><a href="admin.php?page=testimoni&aksi=hapus&id=<?php echo $data['id_testimoni']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus testimoni ini?')">Hapus</a></td></tr><?php } ?>
    </table></div>
<?php
    }

    if ($page == 'pendaftaran') {
        $query = mysqli_query($konek, "SELECT * FROM pendaftaran ORDER BY id_pendaftaran DESC");
?>
    <div class="page-head">
      <div><span class="eyebrow">CRUD Pendaftaran</span><h1>Data Pendaftaran Jamaah</h1><p>Data masuk dari form publik. Admin mengecek, mengubah status, mengedit, atau menghapus data.</p></div>
      <a href="admin.php?page=pendaftaran&aksi=tambah" class="btn-primary">+ Tambah Manual</a>
    </div>
    <?php if(isset($_GET['pesan'])) { ?><div class="alert alert-success">Data pendaftaran berhasil diproses.</div><?php } ?>
    <div class="table-wrap"><table class="data-table"><tr><th>No</th><th>Nama Lengkap</th><th>Email</th><th>No. WhatsApp</th><th>Paket Diminati</th><th>Tanggal</th><th>Status</th><th>Catatan</th><th>Aksi</th></tr>
    <?php $no=1; while($data=mysqli_fetch_array($query)) { ?>
      <tr>
        <td><?php echo $no++; ?></td><td><?php echo htmlspecialchars($data['nama_lengkap']); ?></td><td><?php echo htmlspecialchars($data['email']); ?></td><td><?php echo htmlspecialchars($data['no_hp']); ?></td><td><?php echo htmlspecialchars($data['paket_diminati']); ?></td><td><?php echo htmlspecialchars($data['tanggal_daftar']); ?></td><td><span class="status-badge status-<?php echo strtolower($data['status']); ?>"><?php echo htmlspecialchars($data['status']); ?></span></td><td><?php echo htmlspecialchars($data['catatan']); ?></td>
        <td class="action-cell"><a href="admin.php?page=pendaftaran&aksi=edit&id=<?php echo $data['id_pendaftaran']; ?>" class="btn-edit">Edit</a><a href="admin.php?page=pendaftaran&aksi=hapus&id=<?php echo $data['id_pendaftaran']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data pendaftaran ini?')">Hapus</a></td>
      </tr>
    <?php } ?>
    </table></div>
<?php
    }
}

/* HALAMAN TAMBAH / EDIT */
if ($aksi == 'tambah' || $aksi == 'edit') {
    $mode = $aksi == 'edit' ? 'Update' : 'Create';
    $id = isset($_GET['id']) ? bersihkan($konek, $_GET['id']) : '';

    if ($page == 'paket') {
        $data = array('id_paket'=>'', 'nama_paket'=>'', 'jenis_paket'=>'Umroh', 'harga'=>'', 'durasi'=>'', 'fasilitas'=>'', 'deskripsi'=>'');
        if ($aksi == 'edit') {
            $q = mysqli_query($konek, "SELECT * FROM paket WHERE id_paket='$id'");
            $data = mysqli_fetch_array($q);
        }
?>
    <div class="form-panel">
      <span class="eyebrow"><?php echo $mode; ?></span><h1><?php echo $aksi == 'edit' ? 'Edit Paket' : 'Tambah Paket'; ?></h1><p>Form ini digunakan untuk mengelola data paket.</p>
      <form method="POST" action="admin.php?page=paket&aksi=<?php echo $aksi == 'edit' ? 'update' : 'simpan'; ?>">
        <input type="hidden" name="id_paket" value="<?php echo htmlspecialchars($data['id_paket']); ?>">
        <div class="form-row"><label>Nama Paket</label><div class="field"><input type="text" name="nama_paket" value="<?php echo htmlspecialchars($data['nama_paket']); ?>" required></div></div>
        <div class="form-row"><label>Jenis Paket</label><div class="field"><select name="jenis_paket" required><option value="Umroh" <?php if($data['jenis_paket']=='Umroh') echo 'selected'; ?>>Umroh</option><option value="Haji" <?php if($data['jenis_paket']=='Haji') echo 'selected'; ?>>Haji</option></select></div></div>
        <div class="form-row"><label>Harga</label><div class="field"><input type="number" name="harga" value="<?php echo htmlspecialchars($data['harga']); ?>" required></div></div>
        <div class="form-row"><label>Durasi</label><div class="field"><input type="text" name="durasi" value="<?php echo htmlspecialchars($data['durasi']); ?>" placeholder="Contoh: 9 Hari" required></div></div>
        <div class="form-row"><label>Fasilitas</label><div class="field"><textarea name="fasilitas" required><?php echo htmlspecialchars($data['fasilitas']); ?></textarea></div></div>
        <div class="form-row"><label>Deskripsi</label><div class="field"><textarea name="deskripsi" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea></div></div>
        <div class="form-actions"><button type="submit" class="btn-primary">Simpan</button><a href="admin.php?page=paket" class="btn-outline">Batal</a></div>
      </form>
    </div>
<?php
    }

    if ($page == 'testimoni') {
        $data = array('id_testimoni'=>'', 'nama_jamaah'=>'', 'nama_paket'=>'', 'rating'=>'5', 'isi_testimoni'=>'', 'tanggal'=>'');
        if ($aksi == 'edit') {
            $q = mysqli_query($konek, "SELECT * FROM testimoni WHERE id_testimoni='$id'");
            $data = mysqli_fetch_array($q);
        }
?>
    <div class="form-panel">
      <span class="eyebrow"><?php echo $mode; ?></span><h1><?php echo $aksi == 'edit' ? 'Edit Testimoni' : 'Tambah Testimoni'; ?></h1><p>Form ini digunakan untuk mengelola testimoni jamaah.</p>
      <form method="POST" action="admin.php?page=testimoni&aksi=<?php echo $aksi == 'edit' ? 'update' : 'simpan'; ?>">
        <input type="hidden" name="id_testimoni" value="<?php echo htmlspecialchars($data['id_testimoni']); ?>">
        <div class="form-row"><label>Nama Jamaah</label><div class="field"><input type="text" name="nama_jamaah" value="<?php echo htmlspecialchars($data['nama_jamaah']); ?>" required></div></div>
        <div class="form-row"><label>Nama Paket</label><div class="field"><input type="text" name="nama_paket" value="<?php echo htmlspecialchars($data['nama_paket']); ?>" required></div></div>
        <div class="form-row"><label>Rating</label><div class="field"><select name="rating" required><?php for($i=1;$i<=5;$i++){ ?><option value="<?php echo $i; ?>" <?php if($data['rating']==$i) echo 'selected'; ?>><?php echo $i; ?></option><?php } ?></select></div></div>
        <div class="form-row"><label>Tanggal</label><div class="field"><input type="text" name="tanggal" value="<?php echo htmlspecialchars($data['tanggal']); ?>" placeholder="Contoh: 2024" required></div></div>
        <div class="form-row"><label>Isi Testimoni</label><div class="field"><textarea name="isi_testimoni" required><?php echo htmlspecialchars($data['isi_testimoni']); ?></textarea></div></div>
        <div class="form-actions"><button type="submit" class="btn-primary">Simpan</button><a href="admin.php?page=testimoni" class="btn-outline">Batal</a></div>
      </form>
    </div>
<?php
    }

    if ($page == 'pendaftaran') {
        $data = array('id_pendaftaran'=>'', 'nama_lengkap'=>'', 'email'=>'', 'no_hp'=>'', 'paket_diminati'=>'', 'tanggal_daftar'=>date('Y-m-d'), 'status'=>'Baru', 'catatan'=>'');
        if ($aksi == 'edit') {
            $q = mysqli_query($konek, "SELECT * FROM pendaftaran WHERE id_pendaftaran='$id'");
            $data = mysqli_fetch_array($q);
        }
?>
    <div class="form-panel">
      <span class="eyebrow"><?php echo $mode; ?></span><h1><?php echo $aksi == 'edit' ? 'Edit Pendaftaran' : 'Tambah Pendaftaran Manual'; ?></h1><p>Form ini digunakan admin untuk mengelola data pendaftaran jamaah.</p>
      <form method="POST" action="admin.php?page=pendaftaran&aksi=<?php echo $aksi == 'edit' ? 'update' : 'simpan'; ?>">
        <input type="hidden" name="id_pendaftaran" value="<?php echo htmlspecialchars($data['id_pendaftaran']); ?>">
        <div class="form-row"><label>Nama Lengkap</label><div class="field"><input type="text" name="nama_lengkap" value="<?php echo htmlspecialchars($data['nama_lengkap']); ?>" required></div></div>
        <div class="form-row"><label>Email</label><div class="field"><input type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required></div></div>
        <div class="form-row"><label>No. WhatsApp</label><div class="field"><input type="text" name="no_hp" value="<?php echo htmlspecialchars($data['no_hp']); ?>" required></div></div>
        <div class="form-row"><label>Paket Diminati</label><div class="field"><input type="text" name="paket_diminati" value="<?php echo htmlspecialchars($data['paket_diminati']); ?>" required></div></div>
        <div class="form-row"><label>Tanggal Daftar</label><div class="field"><input type="date" name="tanggal_daftar" value="<?php echo htmlspecialchars($data['tanggal_daftar']); ?>" required></div></div>
        <div class="form-row"><label>Status</label><div class="field"><select name="status" required><?php foreach(array('Baru','Diproses','Valid','Ditolak') as $st){ ?><option value="<?php echo $st; ?>" <?php if($data['status']==$st) echo 'selected'; ?>><?php echo $st; ?></option><?php } ?></select></div></div>
        <div class="form-row"><label>Catatan</label><div class="field"><textarea name="catatan"><?php echo htmlspecialchars($data['catatan']); ?></textarea></div></div>
        <div class="form-actions"><button type="submit" class="btn-primary">Simpan</button><a href="admin.php?page=pendaftaran" class="btn-outline">Batal</a></div>
      </form>
    </div>
<?php
    }
}
?>
  </div>
</main>
<?php include 'admin_footer.php'; ?>