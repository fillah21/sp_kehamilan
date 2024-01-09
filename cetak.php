<?php
require_once 'vendor/autoload.php'; // Lokasi file autoload composer
require_once 'controller/hasil.php';

$id = dekripsi($_GET['idhasil']);

$data = query("SELECT * FROM hasil WHERE idhasil = $id")[0];
$hasil = hasil($data);

$waktu_tes = strftime('%H:%M:%S | %d %B %Y', strtotime($data['tanggal']));
// $hasil = hasil($data);

$iduser = $data['iduser'];
$data_user = query("SELECT * FROM user WHERE iduser = $iduser")[0];

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
$html .= $data_user['nama'] . '</h3>

                <h4>Rincian Gejala Yang Dialami:</h4>
                <table>';


foreach ($hasil as $h) {
    $data_penyakit = query("SELECT * FROM penyakit WHERE nama_penyakit = '$h'")[0];

    $idpenyakit = $data_penyakit['idpenyakit'];
    $data_relasi = query("SELECT * FROM relasi_penyakit_gejala WHERE idpenyakit = $idpenyakit");

    $html .= "<tr>
                            <td>
                                <ul>";

    foreach ($data_relasi as $dr) {
        $idgejala = $dr['idgejala'];
        $data_gejala = query("SELECT * FROM gejala WHERE idgejala = $idgejala")[0];
        $html .= "<li>" . $data_gejala['nama_gejala'] . "</li>";
    }

    $html .= "</ul>
                            </td>
                        </tr>";
}
$html .= '
                </table>

                <h4>Penjabaran Hasil :</h4>
                <table>
                    <tr>
                        <th>Penyakit</th>
                        <th>Solusi</th>
                    </tr>';


foreach ($hasil as $hs) {
    $dapen = query("SELECT * FROM penyakit WHERE nama_penyakit = '$hs'")[0];
    $idpenyakit = $dapen['idpenyakit'];
    $deskripsi_penyakit = $dapen['deskripsi'];
    $data_solusi = query("SELECT * FROM solusi WHERE idpenyakit = $idpenyakit");

    $html .= "<tr>
                            <td>" . "<b>" . strtoupper($dapen['nama_penyakit']) . "</b>" . '<br/>' . '<br/>' . $deskripsi_penyakit . "</td>
                            <td>
                                <ul>";
    foreach ($data_solusi as $dasol) {
        $html .= "<li>" . $dasol['solusi'] . "</li>";
    }

    $html .= "</ul>
                            </td>
                        </tr>";
}
$html .= '
                </table>
            </body>
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