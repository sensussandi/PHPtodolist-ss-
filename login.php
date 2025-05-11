  <?php
session_start();
if (!isset($_SESSION['username']) && isset($_COOKIE['username']) && isset($_COOKIE['user_id'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['status'] = "login";
    header("Location: index.php");
    exit();
}
?>

  <!DOCTYPE html>
  <html>
  <head>
      <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>
      
      
      <!-- Form untuk login -->
      <form method="post" action="admin/cekLogin.php"> 
                

    <!-- grid system -->
    <div class="container mt-5">

    <div class="row justify-content-center">
      <div class="col-md-6 bg-dark text-light p-5 melengkung-banget">
      <!-- allert -->
      <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
            echo '<div class="alert alert-danger" role="alert">Login gagal! Username dan password salah!</div>';
        }
        else if($_GET['pesan'] == "logout"){
            echo '<div class="alert alert-success" role="alert">Anda telah berhasil logout.</div>';
        }
        else if($_GET['pesan'] == "belum_login"){
            echo '<div class="alert alert-warning" role="alert">Anda harus login untuk mengakses halaman admin.</div>';
        }
        else if($_GET['pesan'] == "daftar_sukses"){
            echo '<div class="alert alert-success" role="alert">Registrasi berhasil! Silakan login.</div>';
        }
    }
    ?>
    <!-- end alert -->
        <h2 class="mb-4 text-center">LOGIN</h2>
        <form method="post" action="simpanRegister.php">
          <div class="mb-3">
            <label for="username" class="form-label fs-5">Username</label>
            <input type="text" class="form-control form-control-lg" id="username" name="username" required>
          </div>
          <div class="mb-3 ">
            <label for="password" class="form-label fs-5">Password</label>
            <input type="password" class="form-control form-control-lg" id="password" name="password" required>
          </div>
          <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="remember" id="remember">
          <label class="form-check-label" for="remember">
            Ingat Saya
          </label>
        </div>
          <button type="submit" class="btn btn-primary btn-lg w-100">LOGIN</button>
      <p class="mt-4 text-center">Belum punya akun? <a href="register.php" class="text-warning">Daftar di sini</a></p>

        </form>
        <!-- end grid system -->
      </div>
    </div>
  </div>

      </form>
  </body>
  </html>
