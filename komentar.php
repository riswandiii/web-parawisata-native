<?php
session_start();
include 'koneksi.php';

//jika belom login
if(!isset($_SESSION['login']))
{
    header("Location: login_user.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$user = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$id_user'");
$usr = mysqli_fetch_array($user);


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Komentar Parawisata</title>

    <style>
        #container-fluid{
            height: 650px;
        }
    </style>

    <!-- Icons Bootsrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- Link Aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Style Css -->
    <link rel="stylesheet" href="css/home.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg bg-success navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/logo.jpg" alt="" width="150" class="rounded-circle"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php">Parawisata</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="komentar.php">Komentar</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="penilain.php">Penilaian Parawisata</a>
                </li>
                
                <?php
                 if(isset($_SESSION['login'])) { ?>
                    <li class="nav-item dropdown">
                    <?php if(isset($_SESSION['status_admin'])) { ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    || <i class="bi bi-person-lines-fill"></i> Welcome <?php echo $_SESSION['a_global']->username ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../admin/dashboard.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="../admin/profil.php?id_admin=<?php echo $_SESSION['id_admin'] ?>">Profil Admin</a></li>
                        <?php }else{ ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        || <i class="bi bi-person-lines-fill"></i> Welcome <?php echo $_SESSION['a_global']->username ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profil.php?id_user=<?php echo $_SESSION['id_user'] ?>">Profil User</a></li>
                        <li><a class="dropdown-item" href="pesanan/history.php">History Pemesanan</a></li>
                        <?php } ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
                    </ul>
                    </li>
                <?php }else {?>
                    <li class="nav-item">
                    <a class="nav-link" href="login.php"> ||  <i class="bi bi-box-arrow-in-right"></i> Log In</a>
                   
                    </li>
                <?php }?>
            </ul>
            </div>
        </div>
    </nav>
      <!-- End Navbar -->

  <div class="container-fluid" id="container-fluid">
    <br><br>
      <div class="container p-3 mt-5">

            <div class="row mt-5 mb-3 text-white text-center">
                <div class="col-lg-12">
                    <h3>Komentar Parawisata</h3>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="table-responsive">  
                    <table class="table table-sm table-striped text-white">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Parawisata</th>
                            <th>Gambar Parawisata</th>
                            <th>Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
							$no = 1;
							$koment = mysqli_query($conn, "SELECT * FROM tb_coment
                                                        INNER JOIN tb_parawisata ON tb_coment.id_parawisata = tb_parawisata.id_parawisata 
                                                        ");
							if(mysqli_num_rows($koment) > 0){
							while($row = mysqli_fetch_array($koment)){
						?>
						<tr>
							<td class="text-white"><?php echo $no++ ?></td>
							<td class="text-white"><?php echo $row['nama_parawisata'] ?></td>
							<td class="text-white"><a href="admin/parawisata/img/<?php echo $row['gambar'] ?>" target="_blank"> <img src="admin/parawisata/img/<?php echo $row['gambar'] ?>" width="100"> </a></td>
                            <td class="text-white"><?php echo $row['coment'] ?></td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="8" class="text-white">Belom Ada Koment</td>
							</tr>

						<?php } ?>
					</tbody>
                </table>
                    </div>
                </div>
            </div>
           
      </div><br><br>

  </div>

     <!-- Js Aos -->
     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>

