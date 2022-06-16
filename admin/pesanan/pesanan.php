<?php 
// cek jika belom login
session_start();
include '../../koneksi.php';
if(!isset($_SESSION['login']))
{
    header("Location: ../../login.php");
    exit;
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DATA TRANSAKSI</title>

    <!-- Link Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

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
    <div class="container">

    <div class="row text-white text-center">
        <div class="col-lg-12 mt-5 mb-3">
            <h3>Data Tabel Transaksi</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responisve">
                <table class="table table-sm table-striped text-white table-bordered">
                    <thead>
                        <tr data-aos="fade-right" data-aos-duration="2000">
                            <th>No</th>
                            <th>Parawisata</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Pemesana</th>
                            <th>alamat</th>
                            <th>No_handphone</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
							$no = 1;
							$pesanan = mysqli_query($conn, "SELECT * FROM tb_pesanan
                            LEFT JOIN tb_parawisata ON tb_pesanan.id_parawisata = tb_parawisata.id_parawisata
                            LEFT JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user
                            ");
							if(mysqli_num_rows($pesanan) > 0){
							while($row = mysqli_fetch_array($pesanan)){
						?>
						<tr>
							<td class="text-white"><?php echo $no++ ?></td>
							<td class="text-white"><?php echo $row['nama_parawisata'] ?></td>
							<td class="text-white"><a href="../parawisata/img/<?php echo $row['gambar']?>" target="_blank"> <img src="../parawisata/img/<?php echo $row['gambar'] ?>" width="100"></a></td>
                            <td class="text-white">Rp. <?php echo number_format($row['harga']) ?></td>
                            <td class="text-white"><?php echo $row['username'] ?></td>
                            <td class="text-white"><?php echo $row['alamat'] ?></td>
                            <td class="text-white"><?php echo $row['no_handphone'] ?></td>
                            <td class="text-white"><?php echo $row['tanggal_pesanan'] ?></td>
                            <td class="text-white">Rp. <?php echo number_format($row['total_harga']) ?></td>
                            <?php if($row['status'] == '0') { ?>
                            <td class="text-danger">Pesanan Belom Di CheckOut!</td>
                            <?php }else{ ?>
                            <td class="text-success">Pesanan Sudah Di CheckOut!</td>
                            <?php } ?>
							<td class="text-white">
                                <a href="hapus.php?id_pesanan=<?php echo $row['id_pesanan']?>" class="btn btn-danger btn-sm" onclick="return confirm('YAKIN INGIN HAPUS DATA PESANAN?')">Delete</a>
                                
							</td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="11" class="text-danger">Tidak ada data Pesanan</td>
							</tr>

						<?php } ?>
					</tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <a href="../dashboard.php" class="btn btn-success btn-sm">Back to Dassboard</a>
        </div>
    </div>

 </div>
 <br><br>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>