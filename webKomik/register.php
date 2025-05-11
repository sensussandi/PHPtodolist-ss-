
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="register.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>

</head>
<body >
    <!-- grid system -->
    <div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 bg-dark text-light p-5 melengkung-banget">
      <h2 class="mb-4 text-center">Form Registrasi</h2>
      <form method="post" action="simpanRegister.php">
        <div class="mb-3">
          <label for="username" class="form-label fs-5">Username</label>
          <input type="text" class="form-control form-control-lg" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fs-5">Password</label>
          <input type="password" class="form-control form-control-lg" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100">REGISTER</button>
      </form>
      <p class="mt-4 text-center">Sudah punya akun? <a href="login.php" class="text-warning">Login di sini</a></p>
    </div>
  </div>
</div>

    
</body>
</html>
