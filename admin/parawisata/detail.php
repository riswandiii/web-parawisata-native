<?php
	session_start();
	include '../../koneksi.php';
	if($_SESSION['login'] != true){
		echo '<script>window.location="../../login.php"</script>';
	}

    if(isset($_GET['id_parawisata'])){
        $id_parawisata    =$_GET['id_parawisata'];
    }
    else {
        die ("Error. No ID Selected!");    
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_parawisata
                         WHERE id_parawisata = '$id_parawisata'");
    $result = mysqli_fetch_array($query);


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $result['nama_parawisata']; ?></title>

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
    }

</style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
  
  <div class="container-fluid" id="container-fluid">
    <div class="containe">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
        <div class="card mb-3 mt-5">
        <a href="img/<?php echo $result['gambar'] ?>" target="_blank"> <img src="img/<?php echo $result['gambar'] ?>" class="img-fluid"></a>
            <div class="card-body">
                <h5 class="card-title"><?php echo $result['nama_parawisata']; ?></h5>
                <h5 class="card-title"><?php echo $result['tempat_parawisata']; ?></h5>
                <p class="card-text"><?php echo $result['tentang']; ?></p>
                <a href="../dashboard.php" class="btn btn-success btn-sm">Back to Dassboard</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>