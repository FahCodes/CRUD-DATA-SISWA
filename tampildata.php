<!DOCTYPE html>
<?php 
include "koneksi.php";
$katakunci = "";
//Function Cari
if(isset($_GET['katakunci'])){
	$katakunci = $_GET['katakunci'];
}
if(empty($katakunci)){
	$sqltampil = "SELECT nis,nama,sex,alamat from siswa";
}else{
	$sqltampil = "SELECT nis, nama, sex, alamat FROM siswa WHERE nama LIKE '%$katakunci%' OR alamat LIKE '%$katakunci%'";
}
//Menampilkan
$hasilcari = $koneksi->query($sqltampil);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>::Tampil Data Siswa</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.4.1-dist\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styletampil.css">
</head>  
<body>
<div class="container">
	<div class="row">
		<div class="col-25">
			<a href="tambahdata.php" class="btntambah">Tambah Data</a>
			<a href="cetakseluruh.php" class="btntambah">Cetak Seluruh</a>
		</div>
		<div class="col-75">
			<form name="carisiswa" id="carisiswa" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
				<input type="text" name="katakunci" id="katakunci" placeholder="Cari Siswa...">
				<button type="submit" class="submit" id="submit"><i class="glyphicon glyphicon-search"></i></button>
			</form>
		</div>
	</div>
	<div class="row">
		<?php 
		//Jika Data Siswa Ditemukan Tampilkan data
		if($hasilcari->num_rows>0){  
		?>
		<div class="table-container">
			<table id="tablesiswa">
				<tr>
					<th>No.</th>
					<th>NIS</th>
					<th>Nama Siswa</th>
					<th>Alamat</th>
					<th>Jenis Kelamin</th>
					<th>Aksi</th>
				</tr>
				<!--Bagian Data Yang Akan Ditampilkan-->
				<?php 
				$nomor = 0;
				while($data = $hasilcari->fetch_assoc()){
					$nomor++;
				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $data['nis']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['alamat']; ?></td>
					<td><?php echo $data['sex']; ?></td>
					<td><a href="editdata.php?nis=<?php echo $data['nis'];?>" class="linkaksi"><i class="glyphicon glyphicon-edit">Edit</i></a>
						<a href="hapusdata.php?nis=<?php echo $data['nis'];?>"onClick="return confirm('Apakah Anda Ingin Menghapus Data ini?');" class="linkaksi"><i class="glyphicon glyphicon-trash">Hapus</i></a>
						<a href="cetakdatas.php?nis=<?php echo $data['nis'];?>" class="linkaksi"><i class="glyphicon glyphicon-print">Cetak</a></i></td>
				</tr>
				<?php 
				}
				?>
				<!--Akhir Tampilan Data-->
			</table>
		</div>
		Total Record : <?php echo $hasilcari->num_rows." Records.";?> 
		<?php 
			}else{
				echo "Data Dengan Kata Kunci :<b>$katakunci</b>, tidak ditemukan";
			}
		?>
	</div>
</div>
</body>
</html>
<?php 
$koneksi->close();
?>