<!DOCTYPE html>
<?php 
include "koneksi.php";
$nis 	= "";
$nama 	= "";
$alamat = "";
$sex 	= "";
//Function Cari
if(isset($_GET['nis'])){
	$katakunci = $_GET['nis'];
}
if(empty($nis)){
	$sqltampil = "SELECT nis,nama,sex,alamat from siswa";
}else{
	$sqltampil = "SELECT nis, nama, sex, alamat FROM siswa WHERE nis LIKE '%$nis%'";
}
//Menampilkan
$hasilcari = $koneksi->query($sqltampil);
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.4.1-dist\css\bootstrap.min.css">
</head>
<body>
	<div class="row">
		<!--Div Data-->
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
					<td><a href="editdata.php?nis=<?php echo $data['nis'];?>" class="linkaksi"><i class="glyphicon glyphicon-edit"></i></a>
						<a href="hapusdata.php?nis=<?php echo $data['nis'];?>"onClick="return confirm('Apakah Anda Ingin Menghapus Data ini?');" class="linkaksi"><i class="glyphicon glyphicon-trash"></i></a>
						<a href="cetakdatas.php?nis=<?php echo $data['nis'];?>" class="linkaksi"><i class="glyphicon glyphicon-print"></a></i></td>
				</tr>
				<?php 
				}
				?>
				<!--Akhir Tampilan Data-->
				</div>
			</table>
		</div>
		Total Record : <?php echo $hasilcari->num_rows." Records.";?> 
		<?php 
			}else{
				echo "Data Dengan Kata Kunci :<b>$katakunci</b>, tidak ditemukan";
			}
		?>
	</div>
</body>
</html>