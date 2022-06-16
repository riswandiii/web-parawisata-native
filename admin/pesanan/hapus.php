<?php

	include '../../koneksi.php ';

	if(isset($_GET['id_pesanan'])){

		$delete = mysqli_query($conn, "DELETE FROM tb_pesanan WHERE id_pesanan = '".$_GET['id_pesanan']."' ");
		echo '<script>window.location="pesanan.php"</script>';
	}

?>