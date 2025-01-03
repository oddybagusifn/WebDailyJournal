<?php
session_start();

include "koneksi.php";  

//check jika belum ada user yang login arahkan ke halaman login
if (!isset($_SESSION['username'])) { 
    header("location:login.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Daily Journal</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="flex-grow-1">
        <!-- navbar -->
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark sticky-top">
            <div class="container">
              <a class="navbar-brand fw-bold" href="index.php">My Daily Journal</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto">
                  <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dashboard') ? 'active' : ''; ?>" href="admin.php?page=dashboard">Dashboard</a>
                  <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'article') ? 'active' : ''; ?>" href="admin.php?page=article">Article</a>
                </div>
              </div>
              <div class="nav-icon">
                <div class="dropdown">
                  <button class="btn btn-secondary bg-transparent border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-user text-light"></i>
                  </button>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                  </div>
              </div>
            </div>
        </nav>
        <!-- navbar end -->

        <!-- content start -->
        <div class="content container py-5">
            <div class="container">
                <?php
                if(isset($_GET['page'])){
                    ?>
                    <h4 class="lead display-6 pb-2 border-bottom border-dark-subtle"><?= ucfirst($_GET['page'])?></h4>
                    <?php
                    include($_GET['page'].".php");
                } else {
                    ?>
                    <h4 class="lead display-6 pb-2 border-bottom border-dark-subtle">Dashboard</h4>
                    <?php
                    include("dashboard.php");
                }
                ?>
            </div>
        </div>
        <!-- content end -->
    </div>

    <!-- footer -->
    <footer class="bg-dark text-light text-center py-5 mt-auto">
        <div class="container">
            <div class="d-flex justify-content-center mb-2">
                <a class="text-light mx-2" href="">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a class="text-light mx-2" href="">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a class="text-light mx-2" href="">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>
            <p class="mb-0">Oddy Bagus Ifanda © 2024</p>
        </div>
    </footer>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
