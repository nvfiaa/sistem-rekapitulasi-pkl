<?php
require "C:/xampp2/htdocs/kemenkumham/fpdf/fpdf.php";

// Koneksi ke database
$db = new PDO('mysql:host=localhost;dbname=pkl','root','');

class myPDF extends FPDF
{
    private $totaltransaksi = 0; // Variabel untuk menyimpan total jumlah bayar
    private $jumlahSurat = 0; // Variabel untuk menyimpan jumlah surat

    function header(){
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(276, 5, 'LAPORAN DATA TRANSAKSI', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(276, 10, 'Simperpus Dinas Pendidikan Kabupaten Banyumas | Repost by </a>', 0, 0, 'C');
        $this->Ln();
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Halaman '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }

    function headerTable(){
        $this->SetFont('Times', 'B', 12);
        $this->Cell(30, 10, 'id_pengguna ', 1, 0, 'C');
        $this->Cell(30, 10, 'username', 1, 0, 'C');
        $this->Cell(70, 10, 'password', 1, 0, 'C');
        $this->Ln();
    }

    function viewTable($db){
        $this->SetFont('Times', '', 11);
        $stmt = $db->query('SELECT id_pengguna, username, password FROM tabel_transaksi ORDER BY no_surat DESC');
        $nomor = 1;

        while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->Cell(30, 10, $data->id_pengguna, 1, 0, 'L');
            $this->Cell(70, 10, $data->username, 1, 0, 'L');
            $this->Cell(50, 10, $data->password, 1, 0, 'L');
            $this->Ln();
            $this->totaltransaksi += $data->jumlah_pembayaran; // Menambahkan jumlah bayar ke total
            $nomor++;
        }

        // Menghitung jumlah surat
        $this->jumlahSurat = $stmt->rowCount();

        // Output total transaksi
        $this->SetFont('Times', 'B', 11);
        $this->Cell(170, 10, 'Total Transaksi', 1, 0, 'R');
        $this->Cell(30, 10, $this->totaltransaksi, 1, 0, 'R');
        $this->Ln();

        // Output jumlah surat
        $this->Cell(170, 10, 'Jumlah Surat', 1, 0, 'R');
        $this->Cell(30, 10, $this->jumlahSurat, 1, 0, 'R');
        $this->Ln();
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->Ln();
$pdf->headerTable();
$pdf->viewTable($db);

// Output untuk menampilkan langsung di browser
$pdf->Output('I','Laporan Data Pengunjung.pdf');
?>