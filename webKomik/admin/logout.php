<?php 
// mengaktifkan session
session_start();
 
// menghapus semua session
session_destroy();
 
// Hapus cookies
setcookie('username', '', time() - 3600, "/");
setcookie('user_id', '', time() - 3600, "/");

// mengalihkan halaman sambil mengirim pesan logout
header("location:../login.php?pesan=logout");   
?>