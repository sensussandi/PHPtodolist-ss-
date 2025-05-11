<?php
// Menghubungkan file ini dengan file koneksi.php untuk akses ke database
include 'koneksi.php'; // file koneksi ke database

// Mengambil data 'username' dari form (metode POST)
$username = $_POST['username'];

// Mengambil data 'password' dari form (metode POST), lalu mengenkripsinya menggunakan password_hash()
// password_hash menggunakan algoritma BCRYPT secara default untuk keamanan
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // enkripsi password

// Menyusun perintah SQL untuk menyimpan data ke tabel 'user'
// Data yang disimpan adalah username dan password yang sudah dienkripsi
$query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

// Menjalankan query SQL ke database menggunakan koneksi $koneksi
$result = mysqli_query($koneksi, $query);

// Mengecek apakah query berhasil dijalankan
if($result){
    // Jika berhasil, redirect (pindah) ke halaman login.php dengan parameter URL 'pesan=daftar_sukses'
    header("Location: login.php?pesan=daftar_sukses");
}else{
    // Jika gagal, tampilkan pesan error dari database
    echo "Registrasi gagal: " . mysqli_error($koneksi);
}
?>
