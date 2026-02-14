<?php
require_once 'config/koneksi.php';
include 'includes/proses.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'login';
if($page == "logout"){ session_destroy(); header("Location: index.php?page=login"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Aspirasi Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>.card{border-radius:15px; border:none; box-shadow:0 4px 10px rgba(0,0,0,0.1);}</style>
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    <div class="container">
        <?php if($msg != "") echo "<div class='alert alert-primary'>$msg</div>"; ?>
        <?php 
        $path = "pages/$page.php";
        file_exists($path) ? include $path : include "pages/login.php"; 
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>