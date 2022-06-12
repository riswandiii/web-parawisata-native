<?php 
// cek jika sudah login
session_start();
include 'koneksi.php';
if(isset($_SESSION['login']))
{
    header("Location: login_user.php");
    exit;
}

// Proses registrasi
if(isset($_POST['submit'])){

    $username 		= $_POST['username'];
    $alamat 	= $_POST['alamat'];
    $no_handphone 		= $_POST['no_handphone'];
    $password 		= $_POST['password'];
    $angkatan 		= $_POST['angkatan'];

    $tambah = mysqli_query($conn, "INSERT INTO tb_user VALUES (
        '',
        '".$username."',
        '".$alamat."',
        '".$no_handphone."',
        '".$password."'
        )");


        if($tambah){
            echo '<script>alert("Registrasi Anda Berhasil!")</script>';
            echo '<script>window.location="login_user.php"</script>';
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
    <title>Form Registrasi</title>

    <style>
        
        #username, #password, #login, #alamat, #no_handphone {
            border-radius: 20px;
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body class="bg-light">

  <div class="container-fluid">
      <div class="container mt-5">
          <div class="row align-items-center">
              <div class="col-lg-4 offset-lg-2">
                    <img src="img/background.png" alt="" height="520" width="320">
              </div>
              <div class="col-lg-4">
              <h4 class="text-center">Form Registrasi User!</h4><br>
                        <!-- Form Registrasi -->
                        <form action="" method="post">
                        <div class="mb-1">
                            <input type="text" id="username" name="username" placeholder="Username..." autofocus class="form-control" required>
                        </div>
                        <div class="mb-1">
                            <input type="text" id="alamat" name="alamat" placeholder="Alamat..."  class="form-control" required>
                        </div>
                        <div class="mb-1">
                            <input type="number" id="no_handphone" name="no_handphone" placeholder="No. Handphone..." class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" id="password" name="password" placeholder="Password..." class="form-control" required>
                        </div>
                        <div>
                            <button type="submit" name="submit" class="btn btn-outline-success w-100" id="login">REGISTRASI</button>
                        </div>
                        </form>
                        <!-- End Form -->
                        <div class="mt-3">
                            <small><p>Sudah punya akunr? <a href="login_user.php" class="text-decoration-none">Click Disini!</a></p></small>
                        </div>
              </div>
          </div>
      </div>
  </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>