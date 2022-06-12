<?php

//cek jika belom login
session_start();
include '../koneksi.php';
if(!isset($_SESSION['login']))
{
    header("Location: ../login.php");
    exit;
}

$id_admin = $_SESSION['id_admin'];
$admin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_admin = '$id_admin' ");
$adm = mysqli_fetch_array($admin);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profil <?php echo $adm['username'] ?></title>

    <!-- Link Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <style>

html body {
   background-image: url('../img/background.png');
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
    <div class="container">

    <div class="row text-dark text-center">
          <div class="col-lg-6 offset-lg-3 py-5 mt-5">
            <br><br>
                <!-- Profil User -->
                    <div class="card">
                        <div class="card-header">
                            <h3>My Profil <?php echo $adm['username'] ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Username</td>
                                            <td>:</td>
                                            <td><?php echo $adm['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?php echo $adm['alamat'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>No. Handphone</td>
                                            <td>:</td>
                                            <td><?php echo $adm['no_handphone'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- End Profil -->
          </div>
      </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <a href="dashboard.php" class="btn btn-success btn-sm">Back to Dassboard</a>
        </div>
    </div>

 </div>
 
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>

