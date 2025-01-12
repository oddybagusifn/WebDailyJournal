<?php
session_start();
include 'koneksi.php';


if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT foto FROM user WHERE username = '$username'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    $fotoProfil = $user['foto'];  
  } else {
    $fotoProfil = 'default-profile.jpg';  
  }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            flex-direction: column;
        }

        .sidebar {
            min-height: 100vh;
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color:rgb(158, 158, 158, .2);
            border-radius: 5px;
        }

        .page-item.active .page-link {
            background-color: #343a40;
            color: #ffffff;
            border-color: #343a40;
            box-shadow: none;
        }

        .page-link {
            outline: none;
            color: #343a40;
        }

        .page-link:hover {
            outline: none;
            color: #343a40;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">My Daily Journal</a>
            <div class="dropdown">
            <button class="btn btn-secondary bg-transparent border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="img/<?= $fotoProfil ?>" alt="Profile" class="rounded-circle" width="30" height="30">
            </button>
            <ul class="dropdown-menu">
              <?php if (isset($_SESSION['username'])): ?>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              <?php else: ?>
                <li><a class="dropdown-item" href="login.php">Login</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar bg-dark">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dashboard') ? 'active' : ''; ?> rounded-0 text-light" href="admin.php?page=dashboard">
                                <i class="fas fa-home me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'article') ? 'active' : ''; ?> rounded-0 text-light" href="admin.php?page=article">
                                <i class="fas fa-file-alt me-2"></i> Article
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'gallery') ? 'active' : ''; ?> rounded-0 text-light" href="admin.php?page=gallery">
                                <i class="fas fa-image me-2"></i> Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'user_management') ? 'active' : ''; ?> rounded-0 text-light" href="admin.php?page=user_management">
                                <i class="fas fa-users me-2"></i> User Management
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="container">
                    <?php
                    if (isset($_GET['page'])) {
                    ?>
                        <h4 class="lead display-6 pb-2 border-bottom border-dark-subtle"><?= ucfirst($_GET['page']) ?></h4>
                    <?php
                        include($_GET['page'] . ".php");
                    } else {
                    ?>
                        <h4 class="lead display-6 pb-2 border-bottom border-dark-subtle">Dashboard</h4>
                    <?php
                        include("dashboard.php");
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>