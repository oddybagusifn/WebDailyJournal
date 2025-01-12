<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Daily Journal</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

  <!-- navbar -->
  <nav class="navbar navbar-dark navbar-expand-lg bg-dark sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">Welcome to My Daily Journal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          <a class="nav-link" href="#article">Article</a>
          <a class="nav-link" href="#gallery">Gallery</a>
          <a class="nav-link" href="#schedule">Schedule</a>
          <a class="nav-link" href="#profile">Profile</a>
        </div>
      </div>
      <div class="nav-icon">
        <div class="dropdown">
          <button class="btn btn-secondary bg-transparent border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user text-light"></i>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="login.php">Login</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- navbar end -->



  <!-- form login -->
  <?php
  session_start();

  include "koneksi.php";

  if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] === 'admin') {
      header("Location: admin.php");
    } else {
      header("Location: index.php");
    }
    exit;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT username, role FROM user WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $hasil = $stmt->get_result();
    $row = $hasil->fetch_array(MYSQLI_ASSOC);

    if (!empty($row)) {
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];

      if ($row['role'] === 'admin') {
        header("Location: admin.php");
      } else {
        header("Location: index.php");
      }
      exit;
    } else {
      echo '<div class="alert alert-danger" role="alert">Email atau password salah!</div>';
    }

    $stmt->close();
    $conn->close();
  }
  ?>


  <div class="login d-flex justify-content-center align-items-center border-0 p-5">
    <div class="loginForm bg-light d-flex justify-content-center align-items-center flex-column p-5 w-50 border rounded">
      <?php
      if ($_REQUEST) {
        if ($_POST['username'] == $username and $_POST['password'] == $password) {
          echo '<div class="alert alert-success" role="alert">
                        Anda telah berhasil login!
                    </div>';
        } else {
          echo '<div class="alert alert-danger" role="alert">
                        Email atau password yang anda masukan salah!
                    </div>';
        }
      }
      ?>
      <h2 class="fw-semibold">Login</h2>
      <p class="text-secondary">Please enter your details</p>
      <form action="" method="POST">
        <div class="mb-3 mt-3">
          <input type="text" name="username" placeholder="Username" class=" pt-2 pb-2 form-control m-0 p-1 rounded-0 bg-transparent border-0 border-bottom" id="inputUser" aria-describedby="emailHelp" autofocus required>
          <div class="invalid-feedback">
          </div>
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3 mt-3 d-flex align-items-center position-relative password">
          <input type="password" name="password" placeholder="Password" class=" pt-2 pb-2 bg-transparent form-control m-0 p-1 rounded-0 border-0 border-bottom" id="inputPassword">
          <span toggle="#password-field" id="togglePassword" class="position-absolute end-0 pe-4 fw-medium toggle-password" style="cursor: pointer;"></span>



        </div>
        <button type="submit" class="loginButton btn btn-dark w-100 rounded-0 mt-3">LOGIN</button>
        <div class="createAcc pt-2 mt-3 d-flex justify-content-between">
          <p style="width:200px; color:#646464">Don't have an account?</p>
          <a href="" class="fw-semibold text-dark" id="createAcc" style="text-decoration: none;">Create One</a>
        </div>

        <div class="horizontalLine d-flex flex-row w-100 align-items-center justify-content-center">
          <hr class="border border-dark border opacity-20 w-100">
          <span class="p-2 text-secondary">or</span>
          <hr class="border border-dark border opacity-20 w-100">
        </div>

        <div class="socialSignIn d-flex flex-row justify-content-evenly align-items-center border mt-4">
          <div class="signInGoogle me-1">
            <a href="" class="border border-dark text-dark p-2 d-flex justify-content-between align-items-center w-100" style="text-decoration: none">
              <i class="fa-brands fa-google me-3"></i>
              Continue with Google
            </a>
          </div>
          <div class="signInFacebook">
            <div class="signInGoogle">
              <a href="" class="border border-dark text-dark p-2 d-flex justify-content-between align-items-center w-100" style="text-decoration: none">
                <i class="fa-brands fa-facebook me-3"></i>
                Continue with Facebook
              </a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- form login end -->




  <!-- footer -->
  <footer class="bg-dark">
    <div class="footerSection mt-3">
      <div class="mediaSocial d-flex justify-content-center mb-2">
        <a class="text-light" href="">
          <i class="fa-brands fa-instagram me-2"></i>
        </a>
        <a class="text-light" href="">
          <i class="fa-brands fa-twitter ms-2 me-2"></i>
        </a>
        <a class="text-light" href="">
          <i class="fa-brands fa-whatsapp ms-2"></i>
        </a>
      </div>
      <div class="nameYear">
        <p class="text-light">Oddy Bagus Ifanda @ 2024</p>
      </div>
    </div>
  </footer>
  <!-- footer end -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>