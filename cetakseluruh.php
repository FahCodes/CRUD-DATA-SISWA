<?php 
//Memanggil koneksi.php
include "koneksi.php";
$sqlcek 	= "SELECT nis,nama,alamat,sex FROM siswa";
$hasilCek 	= $koneksi->query($sqlcek);
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
		$this->Cell(0,15,'LAPORAN SELURUH SISWA',0,1,'C');

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
//================================[Menampikan Data Siswa]============================
//Membuat Header Tabel
if($hasilCek->num_rows>0){
	$data = array();
	$headerTabel = array(
		array("label"=>"No.", "length"=>10, "align"=>"C"),
		array("label"=>"NIS.", "length"=>20, "align"=>"C"),
		array("label"=>"Nama Siswa", "length"=>50, "align"=>"C"),
		array("label"=>"Sex", "length"=>15, "align"=>"C"),
		array("label"=>"Alamat", "length"=>90, "align"=>"C"),
	);
$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255,0,0); //Format RGB (Red Hex, Green Hex, Blue Hex) = Red T
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
foreach($headerTabel as $kolom){
	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
//Menampilkan Data Tabel Dari Database
$pdf->SetFillColor(224,235,255); //Format RGB (Red Hex, Green Hex, Blue Hex)
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill = false;
$no = 0;
while($data=$hasilCek->fetch_assoc()){
	$no++;
	 if($fill==true){
		$pdf->SetFillColor(224,255,246);
	}else{
		$pdf->SetFillColor(66, 245, 230);
	}

	$pdf->Cell(2);
	$pdf->Cell(10, 5, $no.'.', 1, 0, 'C', true);
	$pdf->Cell(20, 5, $data['nis'], 1, 0, 'C', true);
	$pdf->Cell(50, 5, $data['nama'], 1, 0, 'C', true);
	$pdf->Cell(15, 5, $data['sex'], 1, 0, 'C', true);
	$pdf->Cell(90, 5, $data['alamat'], 1, 0, 'C', true);
	$pdf->Ln();
	$fill=!$fill;
}
$pdf->Cell(1); 
$pdf->Cell(0,5, 'Jumlah Data : '.$hasilCek->num_rows.' Record', 0, 1, 'L');
}else{
	$pdf->Cell(5);
	$pdf->SetFont('Arial', 'B', '12');
	$pdf->SetTextColor(255,0,0);
	$pdf->Cell(0, 15, 'Data Siswa Masih Kosong !', 0, 1, 'C');
	$pdf->SetTextColor(0);
}
//Menampilkan Hasil Dari Coding Yang Telah Dibuat(Wajib !)
$pdf->Output('LapAllsiswa.pdf','I');
$koneksi->close();
?>