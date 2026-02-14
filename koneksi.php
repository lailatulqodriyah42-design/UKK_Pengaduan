<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ukk_pengaduan");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

function q($s) {
    global $conn;
    return mysqli_query($conn, $s);
}
?>