<?php
session_start();
include '../koneksi.php';

//jika belom login
if(!isset($_SESSION['login']))
{
    header("Location: login_user.php");
    exit;
}

if(isset($_GET['id_parawisata'])){
    $id_parawisata    =$_GET['id_parawisata'];
}
else {
    die ("Error. No ID Selected!");    
}

$detail_parawisasta = mysqli_query($conn, "SELECT * FROM tb_parawisata WHERE id_parawisata  = '$id_parawisata'
                            ");
$prw = mysqli_fetch_array($detail_parawisasta);

// Proses Pemesanan
if(isset($_POST['submit'])){

    $id_parawisata 		= $_POST['id_parawisata'];
    $id_user 	= $_POST['id_user'];
    $jumlah_pesan 		= $_POST['jumlah_pesan'];
    $tanggal_pesanan 		= $_POST['tanggal_pesanan'];
    $total_harga             = $_POST['jumlah_pesan'] * $prw['harga'];
    $status 		= $_POST['status'];

    $pesan = mysqli_query($conn, "INSERT INTO tb_pesanan VALUES (
        '',
        '".$id_parawisata."',
        '".$id_user."',
        '".$jumlah_pesan."',
        '".$tanggal_pesanan."',
        '".$total_harga."',
        '".$status."'
        )");


        if($pesan){
            echo '<script>alert("Pesanan Anda Berhasil Di Input!")</script>';
            echo '<script>window.location="history.php"</script>';
        }else{
            echo 'Gagal'.mysqli_error($conn);
        }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $prw['nama_parawisata'] ?></title>

    <!-- Icons Bootsrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- Link Aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Style Css -->
    <link rel="stylesheet" href="../css/home.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg bg-success navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="../img/logo.jpg" alt="" width="150" class="rounded-circle"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../index.php">Parawisata</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../komentar.php">Komentar</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../penilain.php">Penilaian Parawisata</a>
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
                        <li><a class="dropdown-item" href="../profil.php?id_user=<?php $_SESSION['id_user'] ?>">Profil User</a></li>
                        <li><a class="dropdown-item" href="history.php">History Pemesanan</a></li>
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
            <div class="row mb-2">
            <?php 
							$parawisata = mysqli_query($conn, "SELECT * FROM tb_parawisata WHERE id_parawisata  = '$id_parawisata'
                            ");
                            $no = 1;
							if(mysqli_num_rows($parawisata) > 0){
							while($row = mysqli_fetch_array($parawisata)){
				?>
                <div class="col-lg-8 offset-lg-2">
                <div class="card mb-3">
                <img src="../admin/parawisata/img/<?php echo $row['gambar'] ?>" class="card-img-top" alt="..." height="300" data-aos="flip-left" data-aos-duration="2000">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nama_parawisata'] ?></h5>
                    <p class="card-text"><?php echo $row['tempat_parawisata'] ?></p>
                    <p class="card-text"><strong>Harga : </strong> Rp. <?php echo number_format($row['harga']) ?></p>
                    <div class="py-3">
                        <!-- Form Pesanan -->
                        <div class="col-lg-4">
                        <form action="" method="post">
                            <input type="hidden" name="id_parawisata" value="<?php echo $row['id_parawisata'] ?>">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>">
                            <div class="mb-2">
                                <input type="number" id="jumlah_pesan" class="form-control" name="jumlah_pesan" placeholder="Jumlah Pesan" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pesanan" class="form-label">Tanggal Pesanan</label>
                                <input type="date" id="tanggal_pesanan" class="form-control" name="tanggal_pesanan" placeholder="Jumlah Pesan" required>
                            </div>
                            <input type="hidden" name="status" value="0">
                            <div>
                                <button class="btn btn-success" name="submit" type="submir">Pesan Sekarang</button>
                            </div>
                        </form>
                        </div>
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

