<?php 

// Mengaktifkan session PHP
session_start();

// Menghubungkan dengan koneksi database
include '../koneksi.php';

// Menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Ganti query lama:
$data = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");

// Ambil hasilnya
$user = mysqli_fetch_assoc($data);

// Verifikasi password
if ($user && password_verify($_POST['password'], $user['password'])) {
    // Login berhasil
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['status'] = "login";

    // Cek apakah remember dicentang
    if (isset($_POST['remember'])) {
        // Simpan cookie username dan token selama 7 hari
        setcookie('username', $user['username'], time() + (86400 * 7), "/");
        setcookie('user_id', $user['id'], time() + (86400 * 7), "/");
    }
    header("location:index.php");
} else {
    // Login gagal
    header("location:../login.php?pesan=gagal");
}
?>
