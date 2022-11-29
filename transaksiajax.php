<?php
//Subject of this session are AJAX
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>::Contoh Transaksi Dengan AJAX::</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.4.1-dist\css\bootstrap.min.css">
</head>
<body>
<div class="container">
	<h2>Search Menggunakan AJAX</h2>
	<form class="formsiswa" id="formsiswa" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nis">Nis:</label>
			<input type="text" name="nis" id="nis" class="form-control" placeholder="Nis..." onkeyup="showSiswa(this.value)">
		</div>
		<!--Div Data Manipulasi-->
		<div id="divdata">
			<div class="form-group">
				<label for="nama">Nama Siswa:</label>
				<input type="text" id="siswa" name="siswa" class="form-control" placeholder="Nama Siswa..." readonly>
			</div>
			<div class="form-group">
				<label for="alamat">Alamat:</label>
				<textarea class="form-control" name="alamat" id="alamat" readonly placeholder="Alamat..."></textarea>
			</div>
			<div class="form-group">
				<label>Jenis Kelamin:</label><br>
				<input type="text" name="sex" id="sex" class="form-control" readonly placeholder="Jenis Kelamin...">
			</div>
		</div>
	</form>
</div>
<script>
	function showSiswa(str){
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function(){
			document.getElementById("divdata").innerHTML = this.responseText;
		}
		xhttp.open("GET", "getsiswa.php?nis="+str);
		xhttp.send();
	}
</script>
</body>
</html>