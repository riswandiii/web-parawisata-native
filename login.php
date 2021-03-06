<?php 
// cek jika sudah login
session_start();
include 'koneksi.php';
if(isset($_SESSION['login']))
{
    header("Location: admin/dashboard.php");
    exit;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN ADMIN</title>

    <style>
        
        #username, #password, #login {
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
              <h4 class="text-center">Form Login Admin!</h4><br>
                        <!-- Form Login -->
                        <form action="" method="post">
                        <div class="mb-1">
                            <input type="text" id="username" name="username" placeholder="Username..." autofocus class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="password" id="password" name="password" placeholder="Password..." autofocus class="form-control">
                        </div>
                        <div>
                            <button type="submit" name="submit" class="btn btn-outline-success w-100" id="login">LOG IN</button>
                        </div>
                        </form>
                        <!-- End Form -->

                        <div class="mt-3">
                            <small><p>Login with User? <a href="login_user.php" class="text-decoration-none">Click Disini!</a></p></small>
                        </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Proses Login -->
  <?php 
			if(isset($_POST['submit'])){
				session_start();
				include 'koneksi.php';

				$username = mysqli_real_escape_string($conn, $_POST['username']);
				$password = mysqli_real_escape_string($conn, $_POST['password']);

				$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$username."' AND password = '".MD5($password)."'");
				if(mysqli_num_rows($cek) > 0){
					$d = mysqli_fetch_object($cek);
					$_SESSION['status_admin'] = true;
					$_SESSION['a_global'] = $d;	
					$_SESSION['id_admin'] = $d->id_admin;
                    $_SESSION['login'] = true;
					echo '<script>window.location="admin/dashboard.php"</script>';
				}else{
					echo '<script>alert("Username atau password Anda salah!")</script>';
				}
			}

	?>
  <!-- End Proses -->
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>