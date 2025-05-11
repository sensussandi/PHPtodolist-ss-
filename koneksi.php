<?php 

// Membuat koneksi ke database MySQL menggunakan mysqli_connect
$koneksi = mysqli_connect("localhost", "root", "", "todolist_db");

// Mengecek apakah koneksi berhasil atau gagal
if (mysqli_connect_errno()){
    // Jika koneksi gagal, tampilkan pesan error
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
