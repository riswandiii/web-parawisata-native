<?php
session_start();
include '../koneksi.php';

//jika belom login
if(!isset($_SESSION['login']))
{
    header("Location: login_user.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$user = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$id_user'");
$usr = mysqli_fetch_array($user);

// Proses CheckOut
					if(isset($_POST['submit'])){

						// data inputan dari form
					
						$status 		= $_POST['status'];

						// query update data status tb pesanan pada value 
						$update = mysqli_query($conn, "UPDATE tb_pesanan SET 
												status = '".$status."'
												WHERE id_pesanan = '".$_POST['id_pesanan']."' ");

						if($update){
							echo '<script>alert("CHECKOUT BERHASIL")</script>';
							echo '<script>window.location=""</script>';
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
    <title>History Pemesanan <?php echo $usr['username'] ?></title>

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
                        <li><a class="dropdown-item" href="../profil.php?id_user=<?php echo $_SESSION['id_user'] ?>">Profil User</a></li>
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

            <div class="row mt-5 mb-3 text-white text-center">
                <div class="col-lg-12">
                    <h3>History Pemesanan <?php echo $usr['username'] ?></h3>
                </div>
            </div>

            <div class="row mb-2">
                            <?php 
                            $id_user = $_SESSION['id_user'];
							$hstory = mysqli_query($conn, "SELECT * FROM tb_pesanan
                            LEFT JOIN tb_parawisata ON tb_pesanan.id_parawisata = tb_parawisata.id_parawisata
                            WHERE id_user  = '$id_user'
                            ");
							if(mysqli_num_rows($hstory) > 0){
							while($his = mysqli_fetch_array($hstory)){
				            ?>
                                    <div class="col-lg-12 mb-3">
                                    <div class="card p-5">
                                    <img src="../admin/parawisata/img/<?php echo $his['gambar'] ?>" alt="" height="200">
                                    <small class="d-block"><?php echo $his['nama_parawisata'] ?></small>
                                    <small class="d-block">Harga : Rp. <?php echo number_format($his['harga']) ?></small>
                                    <small class="d-block">Jumlah Pesan : <?php echo $his['jumlah_pesan'] ?></small>
                                    <small class="d-block"> Tanggal Pesanan : <?php echo $his['tanggal_pesanan'] ?></small>
                                    <small class="d-block mb-2">Total Harga : Rp. <?php echo number_format($his['total_harga']) ?></small>
                                    <strong class="d-block"><p>Keterangan : </p></strong>
                                    <?php if($his['status'] == '0') {?>
                                    <strong><p class="text-danger d-block">Pesanan Belom Di Checkout!</p></strong>
                                    <?php }else{?>
                                   <strong><p class="text-success d-block">Pesanan Sudah Di Checkout!</p></strong>
                                    <?php }?>
                                    <?php if($his['status'] == '0') {?>
                                         <!-- Form CheckOut -->
                                    <form action="" method="post">
                                        <input type="hidden" name="id_pesanan" value="<?php echo $his['id_pesanan'] ?>">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" name="submit" class="btn btn-success" onclick="return confirm('YAKIN INGIN CHECKOUT?')">CHECKOUT</button>
                                    </form>
                                    <hr>
                                    <br><br><br>
                                    <!-- End Form -->
                                    <?php }else{?>
                                    <strong><p class="text-success d-block">Anda Sudah checkout!</p></strong>
                                    <div class="mb-1">
                                        <p>Anda berhasil melakukan checkout pemesanan tiket parawisata, Untuk tahap berikutnya silahkan lakukan pembayaran di <strong> Bank BNI di No Rek : 00345463452</strong> sebesar : <strong>Rp. <?php echo number_format($his['total_harga']) ?></strong> . Dan silahkan upload bukti pembayaran Anda!</p>
                                    </div>
                                    <!-- Form Input Bukti Pembayaran -->
                                    <div class="mb-2">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_user" value="<?php echo $id_user ?>">
                                            <input type="hidden" name="id_parawisata" value="<?php echo $his['id_parawisata'] ?>">
                                            <label for="gambar"><strong>Uplaod bukti pembayaran Anda disini</strong></label>
                                            <div class="col-lg-6">
                                            <input type="file" id="gambar" class="form-control" name="gambar" required>
                                            </div>
                                            <button type="submit" name="bukti" class="btn btn-primary btn-sm mt-2">Kirim</button>
                                        </form>
                                    </div>
                                    <!-- End Form -->
                                    <hr>
                                    <br><br><br>
                                    <?php }?>
                                    <?php }}else{ ?>
								    <p class="text-danger d-block">Anda belom memiliki history pemesanan!</p>
				                    <?php } ?>
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

