<?php
require_once 'vendor/autoload.php'; // Lokasi file autoload composer
require_once 'controller/hasil.php';

if (isset($_GET['idhasil'])) {
    $id = dekripsi($_GET['idhasil']);

    $data = query("SELECT * FROM hasil WHERE idhasil = $id")[0];
    $hasil = hasil($data);
    $iduser = $data['iduser'];
    $data_user = query("SELECT * FROM user WHERE iduser = $iduser")[0];

} elseif (isset($_GET['idtamu'])) {
    $id = dekripsi($_GET['idtamu']);

    $data = query("SELECT * FROM tamu WHERE idtamu = $id")[0];
    $hasil = hasil($data);
}

$waktu_tes = strftime('%H:%M:%S | %d %B %Y', strtotime($data['tanggal']));
// $hasil = hasil($data);


foreach ($hasil as $h) {
    $data_penyakit = query("SELECT * FROM penyakit WHERE nama_penyakit = '$h'")[0];

    $idpenyakit[] = $data_penyakit['idpenyakit'];
}

$idpeny = implode(", ", $idpenyakit);

$data_relasi = query("SELECT DISTINCT idgejala FROM relasi_penyakit_gejala WHERE idpenyakit IN ($idpeny);");

use Dompdf\Dompdf;

$dompdf = new Dompdf();

// Masukkan kode HTML dan CSS yang ingin Anda konversi ke PDF
$html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Hasil Tes</title>
                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: center;
                    vertical-align: middle;
                    }

                    th {
                        background-color: #f2f2f2;
                    }

                    p {
                        text-align: justify; 
                        text-indent: 0.5in;
                    }
                    li {
                        text-align: left;
                        padding: 0;
                        padding: 0;
                        margin: 0;
                        left: 0;
                    }
                </style>
            </head>
            <body>
                <h1 style="text-align: center;">LAPORAN HASIL TES</h1>
                <h3 style="text-align: center;">';
if (isset($_GET['idhasil'])) {
    $html .= $data_user['nama'] . '</h3>';
} elseif (isset($_GET['idtamu'])) {
    $html .= $data['nama'] . '</h3>';
}

$html .= '<h4>Rincian Gejala Yang Dialami:</h4>
                <table>
                    <tr>
                        <td>
                            <ul>';


foreach ($data_relasi as $darel) {
    $idgejala = $darel['idgejala'];
    $data_gejala = query("SELECT * FROM gejala WHERE idgejala = $idgejala")[0];


    $html .= "<li>" . $data_gejala['nama_gejala'] . "</li>";
}

$html .= '</ul>
                        </td>
                    </tr>
                </table>

                <h4>Penjabaran Hasil :</h4>
                <table>
                    <tr>
                        <th>Penyakit</th>
                    </tr>';


foreach ($hasil as $hs) {
    $dapen = query("SELECT * FROM penyakit WHERE nama_penyakit = '$hs'")[0];
    $idpenyakit = $dapen['idpenyakit'];
    $deskripsi_penyakit = $dapen['deskripsi'];

    $nama_kecil = strtolower(str_replace(" ", "_", $dapen['nama_penyakit']));
    $presentase = $data[$nama_kecil] * 100;

    $html .= "<tr>
                            <td>" . "<b>" . strtoupper($dapen['nama_penyakit']) . " (" . $presentase . "%)" . "</b>" . '<br/>' . '<br/>' . $deskripsi_penyakit . "</td>
                        </tr>";
}
$html .= '
                </table>';

foreach ($hasil as $hs) {
    $dapen = query("SELECT * FROM penyakit WHERE nama_penyakit = '$hs'")[0];
    $idpenyakit = $dapen['idpenyakit'];
    $data_solusi = query("SELECT * FROM solusi WHERE idpenyakit = $idpenyakit");

    $html .= "<h4>Solusi Penyakit " . strtoupper($dapen['nama_penyakit']) . " </h4>
                <ul>";

    foreach ($data_solusi as $dasol) {
        $html .= "<li>" . $dasol['solusi'] . "</li>";
    }

    $html .= "</ul>";
}

$html .= '</body>
            </html>';

$dompdf->loadHtml($html);

// Render HTML ke PDF
$dompdf->render();

// Ambil output PDF
$output = $dompdf->output();

// Konversi output PDF menjadi data URI
$pdfDataUri = 'data:application/pdf;base64,' . base64_encode($output);

// Tampilkan pratinjau PDF di browser
echo '<embed src="' . $pdfDataUri . '" type="application/pdf" width="100%" height="100%">';

?>