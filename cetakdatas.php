<?php 
//Memanggil koneksi.php
include "koneksi.php";
//Membuat Variable
$nis 	= "";
$nama 	= "";
$alamat = "";
$sex 	= "";
//Mengambil Data Menurut Nis
if(isset($_GET['nis'])){
	$nis 		= $_GET['nis'];
	//MenCek Data Yang Ada di database
	$sqlcek 	= "SELECT nis,nama,alamat,sex FROM siswa WHERE nis = '$nis'";
	$hasilCek 	= $koneksi->query($sqlcek);
	//Mengambil Data jika lebih dari >0
	if($hasilCek->num_rows>0){
		$data 	= $hasilCek->fetch_assoc();
		//$nis 	= $data['nis'];
		$nama 	= $data['nama'];
		$alamat = $data['alamat'];
		$sex 	= $data['sex']=="L"?"Laki-Laki":"Perempuan";
	}
}

//-----------------------------------------------------------\\
//----------------------Wilayah Laporan----------------------\\
//-----------------------------------------------------------\\
//Memanggil Folder Font Untuk Memanggil Font Karakter Dari Folder FPDF
define('FPDF_FONTPATH','FPDF-1.8.4/font/');
//Memanggil FPDF.PHP DARI FOLDER FPDF-1.8.4
require('FPDF-1.8.4/fpdf.php');
//Membuat Class PDF($pdf)
class PDF extends FPDF{
	//Wilayah Kepala
	function Header(){
		//Logo Pada Kop Surat
		$this->Image('logo1.jpg',4,5,30);
		$this->SetFont('Arial','BU',15);
		//Memindahkan Keposisi Tengah untuk membuat judul
		//Judul Kop Surat
		$this->Cell(25);
		$this->SetFont('Times','B',14);
		$this->Cell(0,5,'PEMERINTAHAN SUMATERA UTARA',0,1,'C');

		$this->Cell(25);
		$this->SetFont('Times','B',14);
		$this->Cell(0,5,'DINAS PENDIDIKAN PROVINSI',0,1,'C');

		$this->Cell(25);
		$this->SetFont('Times','B',14);
		$this->Cell(0,5,'SEKOLAH MENENGAH KEJURUAN NEGERI 9 MEDAN',0,1,'C');

		$this->Cell(25);
		$this->SetFont('Times','I',10);
		$this->Cell(0,5,'ALAMAT : JL.PATRIOT NO.20 A KO.LALANG MEDAN SUNGGAL',0,1,'C');

		$this->Cell(25);
		$this->Cell(0,5,"WEBSITE : http://www.smknegeri9medan.com E-Mail : smk9medan@gmail.com TELP : 061-8454350 Fax : 061-8454350",0,1,'C');
		//Membuat Garis Dibawah Kop Surat
		$this->SetLineWidth(0,10); //Ketebalan Garis
		$this->Line(5,35,205,35);//(Lebar,Posisi,Panjang Garis,Posisi)
	}
	//Wilayah Isi
	function Content(){
		//Isi
		$this->SetFont('Arial','BU','12');
		$this->Cell(10);
		$this->Cell(0,15,'LAPORAN PER SISWA',0,1,'C');

	}
	//Wilayah Footer Atau biasanya page number
	function Footer(){
		//Untuk Atur Posisi Garis 1,5cm dari bawah
		$this->SetY(-15);
		//Membuat Garis Horizontal
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		//Membuat Huruf Menjadi Font Arial,Italic,Besar 9
		$this->SetFont('Arial','I',9);
		//Membuat Total Halaman Pada Footer
		$this->Cell(0,10,'Halaman '.$this->Pageno().' Dari {nb}',0,0,'R');
	}
}
//Output
$pdf = new PDF(); //Membuat Variable $pdf
//Fungsi Menampilkan Total Halaman (Jika Tidak Dibuat Maka tidak tertampil total halaman)
$pdf->AliasNbPages();
//Membuat Halaman Baru (Wajib Dibuat) P = Potrait, L = Landscape
$pdf->AddPage('P','A4');
//Memanggil Function Isi
$pdf->Content();
$pdf->SetFont('Times','B',12);
$pdf->Cell(5);
$pdf->Cell(0,5,'NIS Siswa');
$pdf->Cell(-150);
$pdf->Cell(0,5,':  '.$nis,0,1);

$pdf->Cell(5);
$pdf->Cell(0,5,'Nama Siswa');
$pdf->Cell(-150);
$pdf->Cell(0,5,':  '.$nama,0,1);

$pdf->Cell(5);
$pdf->Cell(0,5,'Alamat Lengkap');
$pdf->Cell(-150);
$pdf->Cell(0,5,':  '.$alamat,0,1);

$pdf->Cell(5);
$pdf->Cell(0,5,'Jenis Kelamin');
$pdf->Cell(-150);
$pdf->Cell(0,5,':  '.$sex,0,1);
//Menampilkan Hasil Dari Coding Yang Telah Dibuat(Wajib !)
$pdf->Output('LapPersiswa.pdf','I');
?>