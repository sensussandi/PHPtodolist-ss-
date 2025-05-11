<?php
// Memulai sesi untuk menyimpan data login pengguna
session_start();


if (!isset($_SESSION['username']) && isset($_COOKIE['username']) && isset($_COOKIE['user_id'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['status'] = "login";
    header("Location: index.php");
    exit();
}



if (!isset($_SESSION['username'])) {
    if (isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['status'] = "login";
    } else {
        header("location:../login.php?pesan=belum_login");
    }
}

// Memanggil file koneksi untuk menghubungkan ke database
include '../koneksi.php';

// Mengecek apakah user sudah login, jika tidak, arahkan ke halaman login
if ($_SESSION['status'] != "login") {
    // Redirect ke halaman login dengan pesan bahwa user belum login
    header("location:../index.php?pesan=belum_login");
    exit(); // Menghentikan eksekusi kode berikutnya
}

// --------------------------------------------------------------
// TAMBAH TASK (jika form tambah task disubmit dengan method POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_task'])) {
    // Mengambil data task yang diketik user dan menghindari SQL Injection
    $task = mysqli_real_escape_string($koneksi, $_POST['task']); 
    // Mengambil ID user yang sedang login dari session
    $user_id = $_SESSION['user_id']; 
    // Menyimpan task baru ke tabel 'todos' dengan user_id dan judul task
    mysqli_query($koneksi, "INSERT INTO todos (user_id, title) VALUES ('$user_id', '$task')");
}

// --------------------------------------------------------------
// TOGGLE STATUS TASK (ubah status dari pending ke completed dan sebaliknya)
if (isset($_GET['toggle_task'])) {
    // Mengambil id task yang diklik dari parameter URL
    $task_id = $_GET['toggle_task'];
    // Mengambil status task saat ini dari database
    $result = mysqli_query($koneksi, "SELECT status FROM todos WHERE id='$task_id' AND user_id='{$_SESSION['user_id']}'");
    $current_status = mysqli_fetch_assoc($result)['status']; // 'pending' atau 'completed'
    
    // Menentukan status baru (jika awalnya 'completed' jadi 'pending', sebaliknya)
    $new_status = ($current_status === 'completed') ? 1 : 2;
    
    // Mengupdate status task di database
    mysqli_query($koneksi, "UPDATE todos SET status = '$new_status' WHERE id='$task_id' AND user_id='{$_SESSION['user_id']}'");
}

// --------------------------------------------------------------
// HAPUS TASK
if (isset($_GET['delete_task'])) {
    // Mengambil ID task yang diklik untuk dihapus
    $task_id = $_GET['delete_task'];
    // Menghapus task dari tabel todos berdasarkan ID dan user yang sedang login
    mysqli_query($koneksi, "DELETE FROM todos WHERE id='$task_id' AND user_id='{$_SESSION['user_id']}'");
}

// --------------------------------------------------------------
// MENGAMBIL SEMUA TASK MILIK USER YANG LOGIN
// Mengambil semua data dari tabel todos milik user yang sedang login
$todos = mysqli_query($koneksi, "SELECT * FROM todos WHERE user_id='{$_SESSION['user_id']}' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <!-- Menghubungkan file CSS eksternal -->
     
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <div class="container">
  <div class="row">
    <div class="col">
    Tugas PHP
    </div>
    <div class="col">
      Sensus Sandi
    </div>
    <div class="col">
      235314027
    </div>
  </div>
</div>

    <div class="container">
        
        
    <!-- Menampilkan nama user yang sedang login -->
    <h1>To-Do List          [<?php echo $_SESSION['username']; ?>]</h1>

    <!-- Link untuk logout -->
    <a class="logout" href="logout.php">Logout</a>

    <!-- Form untuk menambahkan task baru -->
    <form method="POST">
        <input type="text" name="task" placeholder="Masukkan task..." required> <!-- Input task -->
        <button type="submit" name="add_task">Tambah</button> <!-- Tombol submit -->
    </form>

    <!-- Menampilkan daftar task -->
    <?php while ($todo = mysqli_fetch_assoc($todos)): ?>
        <div class="task">
            <!-- Menampilkan judul task. Jika statusnya 'completed', ditambahkan class untuk styling -->
            <span class="<?php echo $todo['status'] === 'completed' ? 'completed' : ''; ?>">
                <?php echo htmlspecialchars($todo['title']); ?>
            </span>
            
            <div class="task-actions">
                <!-- Link untuk mengubah status task -->
                <a href="index.php?toggle_task=<?php echo $todo['id']; ?>">
                    <?php echo $todo['status'] === 'completed' ? 'Batal' : 'Selesai'; ?>
                </a>
                <!-- Link untuk menghapus task -->
                <a href="index.php?delete_task=<?php echo $todo['id']; ?>">Hapus</a>
            </div>
        </div>
    <?php endwhile; ?>
    </div>

    
</body>
</html>
