<?php

//cek jika belom login
session_start();
include '../koneksi.php';
if(!isset($_SESSION['login']))
{
    header("Location: ../login.php");
    exit;
}
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">SIDEBAR</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="../logout.php" onclick="return confirm('YAKIN INGIN KELUAR?')">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php">
              <span data-feather="home"></span>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="parawisata/parawisata.php">
              <span data-feather="file"></span>
              Data Parawisata
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="koment/koment.php">
              <span data-feather="file"></span>
              Data Komen
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="penilaian/penilaian.php">
              <span data-feather="file"></span>
              Data Penilaian
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="pesanan/pesanan.php">
              <span data-feather="file"></span>
              Data Transaksi
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="profil.php?id_admin=<?php echo $_SESSION['id_admin'] ?>">
              <span data-feather="file"></span>
              Profil Admin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">
              <span data-feather="layers"></span>
              Keluar
            </a>
          </li>
        </ul>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome <?php echo $_SESSION['a_global']->username ?></h1>
      </div>
    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>><script src="js/dashboard.js"></script>
  </body>
</html>
