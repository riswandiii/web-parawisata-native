<?php
	session_start();
	include '../../koneksi.php';
	if($_SESSION['login'] != true){
		echo '<script>window.location="../../login.php"</script>';
	}

	$parawisata = mysqli_query($conn, "SELECT * FROM tb_parawisata WHERE id_parawisata = '".$_GET['id_parawisata']."' ");
	if(mysqli_num_rows($parawisata) == 0){
		echo '<script>window.location="data-parawisata.php"</script>';
	}
	$p = mysqli_fetch_object($parawisata);
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Data Parawisata</title>

    <style>

html body {
   background-image: url('../../img/background.png');
   background-size: cover;
   background-position: center;
   background-repeat: no-repeat;
}

    #email, #password, #login {
        border-radius: 25px;
    }

    #card {
        background-color: white;
        border-radius: 20px;
    }

    #container-fluid {
        background-color: black;
        opacity: 0.9;
        height: 700px;
    }

</style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
  
  <div class="container-fluid" id="container-fluid">
    <div class="containe">
        <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
            <div class="card mt-5 mb-5 p-5" id="card" data-aos="flip-up" data-aos-duration="2000">
                        <h3 class="text-center mt-2 mb-4">Ubah Data Parawisata</h3>

            <!-- {{-- Form Ubah --}} -->
            <form action="" method="post" enctype="multipart/form-data">
        

                <div class="mb-3">
                    <input type="text" class="form-control" name="nama_parawisata" placeholder="Nama Parawisata....." autofocus id="nama_parawisata" value="<?php echo $p->nama_parawisata ?>">
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="tempat_parawisata" placeholder="Tempat Parawisata....." autofocus id="tempat_parawisata" value="<?php echo $p->tempat_parawisata ?>">
                </div>

                <div class="mb-3">
                <label for="tentang" class="form-label">Tentang Parawisata</label>
                <textarea class="form-control" id="tentang" rows="3" name="tentang"><?php echo $p->tentang ?></textarea>
                </div>

                <div class="mb-3">
                <img src="img/<?php echo $p->gambar ?>" width="100px">
				<input type="hidden" name="foto" value="<?php echo $p->gambar ?>">
                <input type="file" class="form-control" name="gambar" id="gambar">
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100" id="registrasi" name="submit">SUBMIT</button>
                </div>

            </form>
            <!-- {{-- End Form --}} -->

            <!-- Proses Ubah Data Parawisata -->
            <?php
					if(isset($_POST['submit'])){

						// data inputan dari form
						$nama_parawisata 	= $_POST['nama_parawisata'];
						$tempat_parawisata 		= $_POST['tempat_parawisata'];
						$tentang 	= $_POST['tentang'];
						$foto 		= $_POST['foto'];

						// data gambar yang baru
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];


						// jika admin ganti gambar
						if($filename != ''){
							$type1 = explode('.', $filename);
							$type2 = $type1[1];

							$newname = 'produk'.time().'.'.$type2;

							// menampung data format data yang diizinkan
							$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

								// validasi format file
							if(!in_array($type2, $tipe_diizinkan)){
								// jika format file tidak ada di dalam tipe diizinkan
								echo '<script>alert("Format file tidak diizinkan")</script>';

							}else{
								unlink('./produk/'.$foto);
								move_uploaded_file($tmp_name, './produk/'.$newname);
								$namagambar = $newname;
							}

						}else{
							// jika admin tidak ganti gambar
							$namagambar = $foto;

						}

						// query update data produk
						$update = mysqli_query($conn, "UPDATE tb_parawisata SET 
												nama_parawisata = '".$nama_parawisata."',
												tempat_parawisata = '".$tempat_parawisata."',
												tentang = '".$tentang."',
												gambar = '".$namagambar."'
												WHERE id_parawisata = '".$p->id_parawisata."' ");

						if($update){
							echo '<script>alert("Ubah data berhasil")</script>';
							echo '<script>window.location="parawisata.php"</script>';
						}else{
							echo 'Gagal'.mysqli_error($conn);
						}
						

					}
				?>

            </div>
        </div>
    </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>