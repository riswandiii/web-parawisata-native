<?php

	include '../../koneksi.php ';

	if(isset($_GET['id_parawisata'])){
		$parawisata = mysqli_query($conn, "SELECT gambar FROM tb_parawisata WHERE id_parawisata = '".$_GET['id_parawisata']."'");
		$p = mysqli_fetch_object($parawisata);

		unlink('img/'.$p->gamabr);

		$delete = mysqli_query($conn, "DELETE FROM tb_parawisata WHERE id_parawisata = '".$_GET['id_parawisata']."' ");
		echo '<script>window.location="parawisata.php"</script>';
	}

?>