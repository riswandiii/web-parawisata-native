<?php
	session_start();
	include '../../koneksi.php';
	if($_SESSION['login'] != true){
		echo '<script>window.location="../../login.php"</script>';
	}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Parawisata</title>

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
                        <h3 class="text-center mt-2 mb-4">Tambah Data Parawisata</h3>

            <!-- {{-- Form Tambah --}} -->
            <form action="" method="post" enctype="multipart/form-data">
        

                <div class="mb-3">
                    <input type="text" class="form-control" name="nama_parawisata" placeholder="Nama Parawisata....." autofocus id="nama_parawisata">
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="tempat_parawisata" placeholder="Tempat Parawisata....." autofocus id="tempat_parawisata">
                </div>

                <div class="mb-3">
                <label for="tentang" class="form-label">Tentang Parawisata</label>
                <textarea class="form-control" id="tentang" rows="3" name="tentang"></textarea>
                </div>

                <div class="mb-3">
                <input type="file" class="form-control" name="gambar" id="gambar">
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100" id="registrasi" name="submit">SUBMIT</button>
                </div>

            </form>
            <!-- {{-- End Form --}} -->

            <!-- Proses Tambah Data Parawisata -->
            <?php
					if(isset($_POST['submit'])){

						// print_r($_FILES['gambar']);
						// menampung inputan dari form
						$nama_parawisata 	= $_POST['nama_parawisata'];
						$tempat_parawisata 		= $_POST['tempat_parawisata'];
						$tentang 		= $_POST['tentang'];

						// menampung data file yang diupload
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'produk'.time().'.'.$type2;

						// menampung data format data yang diizinkan
						$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'JPG', 'gif');

						// validasi format file
						if(!in_array($type2, $tipe_diizinkan)){
							// jika format file tidak ada di dalam tipe diizinkan
							echo '<script>alert("Format file tidak diizinkan")</script>';

						}else{
							// jika format file sesuai dengan yang ada di dalam array tipe diizinkan
							// proses upload file sekaligus insert ke databse
							move_uploaded_file($tmp_name, './img/'.$newname);

							$insert = mysqli_query($conn, "INSERT INTO tb_parawisata VALUES('', '$nama_parawisata', '$tempat_parawisata', '$tentang', '$newname')");

							if($insert){
								echo '<script>alert("Tambah data berhasil")</script>';
								echo '<script>window.location="parawisata.php"</script>';
							}else{
								echo 'Gagal'.mysqli_error($conn);
							}

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