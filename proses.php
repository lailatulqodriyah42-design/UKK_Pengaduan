<?php
$msg = "";
// Auth Logic
if(isset($_POST['login'])){
    $u = mysqli_real_escape_string($conn, $_POST['username']); 
    $p = mysqli_real_escape_string($conn, $_POST['password']);
    $a = q("SELECT * FROM admin WHERE username='$u' AND password='$p'");
    if(mysqli_num_rows($a) > 0){
        $_SESSION['role'] = "admin"; $_SESSION['user'] = $u;
        header("Location: index.php?page=aspirasi"); exit;
    }
    $s = q("SELECT * FROM siswa WHERE nis='$u' AND kelas='$p'");
    if(mysqli_num_rows($s) > 0){
        $_SESSION['role'] = "siswa"; $_SESSION['user'] = $u;
        header("Location: index.php?page=form"); exit;
    }
    $msg = "Login gagal! Periksa NIS/Username dan Password.";
}

// Register Siswa
if(isset($_POST['register'])){
    $nis = $_POST['nis']; $kelas = $_POST['kelas'];
    if(mysqli_num_rows(q("SELECT * FROM siswa WHERE nis='$nis'")) > 0) { $msg = "NIS sudah terdaftar!"; }
    else {
        q("INSERT INTO siswa (nis, kelas) VALUES ('$nis', '$kelas')");
        $msg = "Berhasil daftar!";
    }
}

// Admin Actions (CRUD)
if(isset($_POST['add_admin'])) q("INSERT INTO admin (username, password) VALUES ('$_POST[username]', '$_POST[password]')");
if(isset($_POST['edit_admin'])) q("UPDATE admin SET password='$_POST[password]' WHERE id_admin='$_POST[id_admin]'");
if(isset($_GET['del_admin'])) q("DELETE FROM admin WHERE id_admin='$_GET[del_admin]'");
if(isset($_POST['add_kat'])) q("INSERT INTO kategori VALUES(NULL,'$_POST[nama]')");
if(isset($_GET['del_kat'])) q("DELETE FROM kategori WHERE id_kategori='$_GET[del_kat]'");
if(isset($_POST['edit_siswa'])) q("UPDATE siswa SET kelas='$_POST[kelas]' WHERE nis='$_POST[nis]'");
if(isset($_GET['del_siswa'])) q("DELETE FROM siswa WHERE nis='$_GET[del_siswa]'");

// Aspirasi Logic
if(isset($_POST['kirim'])){
    $tgl = date("Y-m-d H:i:s");
    q("INSERT INTO input_aspirasi (nis, id_kategori, lokasi, ket, waktu) VALUES ('$_SESSION[user]', '$_POST[id_kategori]', '$_POST[lokasi]', '$_POST[ket]', '$tgl')");
    $msg = "Aspirasi terkirim!";
}

if(isset($_POST['proses'])){
    $id = $_POST['id_pelaporan']; $st = $_POST['status']; $fb = $_POST['feedback'];
    $c = q("SELECT * FROM aspirasi WHERE id_pelaporan='$id'");
    if(mysqli_num_rows($c) > 0) q("UPDATE aspirasi SET status='$st', feedback='$fb' WHERE id_pelaporan='$id'");
    else {
        $kat = mysqli_fetch_assoc(q("SELECT id_kategori FROM input_aspirasi WHERE id_pelaporan='$id'"))['id_kategori'];
        q("INSERT INTO aspirasi (id_pelaporan, id_kategori, status, feedback) VALUES ('$id', '$kat', '$st', '$fb')");
    }
    $msg = "Status diperbarui!";
}
?>