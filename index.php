<?php 
session_start();
include 'koneksi.php';

//jika belom login
if(!isset($_SESSION['login']))
{
    header("Location: login_user.php");
    exit;
}


// Proses kkomentar
if(isset($_POST['komentar'])){
    include 'koneksi.php';
    $id_parawisata 		= $_POST['id_parawisata'];
    $coment 		= $_POST['coment'];

    $insert = mysqli_query($conn, "INSERT INTO tb_coment VALUES (
        '',
        '".$id_parawisata."',
        '".$coment."'
            )");


        if($insert){
            echo '<script>alert("Komentar Anda Berhasil Di Tambahkan!!")</script>';
            echo '<script>window.location="komentar.php"</script>';
        }else{
            echo 'Gagal'.mysqli_error($conn);
        }
}
// End proses komentar


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PARAWISATA || HOME</title>

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
                <a class="nav-link active" aria-current="page" href="">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index">Parawisata</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="komentar.php">Komentar</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="penilaian.php">Penilaian Parawisata</a>
                </li>
                
                <?php
                 if(isset($_SESSION['login'])) { ?>
                    <li class="nav-item dropdown">
                    <?php if(isset($_SESSION['status_admin'])) { ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    || <i class="bi bi-person-lines-fill"></i> Welcome <?php echo $_SESSION['a_global']->username ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="admin/dashboard.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="admin/profil.php?id_admin=<?php echo $_SESSION['id_admin'] ?>">Profil Admin</a></li>
                        <?php }else{ ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        || <i class="bi bi-person-lines-fill"></i> Welcome <?php echo $_SESSION['a_global']->username ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profil.php?id_user=<?php echo $_SESSION['id_user'] ?>">Profil User</a></li>
                        <li><a class="dropdown-item" href="pesanan/history.php">History Pemesanan</a></li>
                        <?php } ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
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

      <div class="container mt-5">
        <br>
      <div class="row text-white text-center">
          <div class="col-lg-12 py-5">
              <h3>~Welcome To Website~</h3>
          </div>
      </div>
      <div class="row text-white text-center">
          <div class="col-lg-8 offset-lg-2">
                <h1>SISTEM INFORMASI PARAWISATA SULAWESI SELATAN</h1>
          </div>
      </div>
      <hr>
      </div>

      <div class="container p-3">
            <div class="row text-white text-center mb-3">
                <div class="col-lg-12">
                    <h3>Parawisata Di Sarankan</h3>
                </div>
            </div>
            <div class="row mb-2">
            <?php 
							$no = 1;
							$parawisata = mysqli_query($conn, "SELECT * FROM tb_parawisata
                            ");
							if(mysqli_num_rows($parawisata) > 0){
							while($row = mysqli_fetch_array($parawisata)){
				?>
                <div class="col-lg-6">
                <div class="card mb-3">
                <img src="admin/parawisata/img/<?php echo $row['gambar'] ?>" class="card-img-top" alt="..." height="300">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nama_parawisata'] ?></h5>
                    <p class="card-text"><?php echo $row['tempat_parawisata'] ?></p>
                    <p class="card-text"><?php echo $row['tentang'] ?></p>
                    <p class="card-text"><strong>Harga : </strong> Rp. <?php echo number_format($row['harga']) ?></p>
                    <div class="py-1">
                        <a href="pesanan/pesanan.php?id_parawisata=<?php echo $row['id_parawisata'] ?>" class="btn btn-success">Pesan</a>
                    </div>
                    <div>
                        <!-- Form Komentar -->
                        <form action="" method="post">
                        <div class="mb-3">
                        <input type="hidden" name="id_parawisata" value="<?php echo $row['id_parawisata'] ?>">
                            <label for="coment" class="form-label">Komentar</label>
                            <textarea class="form-control" id="coment" rows="3" name="coment"></textarea>
                        </div>
                        <div>
                            <button class="btn btn-success btn-sm" type="submit" name="komentar">Kirim Komentar</button>
                        </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
                </div>
                </div>
                <?php }}else{ ?>
							<tr>
								<td colspan="8" class="text-danger">Tidak ada data</td>
							</tr>

				<?php } ?>
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