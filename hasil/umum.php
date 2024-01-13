<?php
require_once '../controller/hasil.php';

if (isset($_GET['key'])) {
    $nama_tamu = dekripsi($_GET['key']);
    $data = query("SELECT * FROM tamu WHERE nama = '$nama_tamu'")[0];

    $hasil = hasil($data);
} else {
    echo "
        <script>
            document.location.href='../diagnosa/umum.php';
        </script>
    ";
}
$idhasil = enkripsi($data['idtamu']);

if (count($hasil) > 1) {
    $nama_penyakit = implode(", ", $hasil);
} else {
    $nama_penyakit = $hasil[0];
}

foreach ($hasil as $h) {
    $data_penyakit = query("SELECT * FROM penyakit WHERE nama_penyakit = '$h'")[0];

    $idpenyakit[] = $data_penyakit['idpenyakit'];
}

$idpeny = implode(", ", $idpenyakit);

$data_relasi = query("SELECT DISTINCT idgejala FROM relasi_penyakit_gejala WHERE idpenyakit IN ($idpeny);");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>SP Penyakit Ibu Hamil</title>

    <!-- css -->
    <link rel="stylesheet" href="../style.css">

    <!-- logo -->
    <link rel="Icon" href="">
</head>

<body>
    <div class="content">
        <!-- navbar -->
        <?php
        require_once('../navbar/navbar.php');
        ?>
        <!-- navbar selesai -->

        <div class="main-container m-0">
            <div class="d-flex">

                <!-- konten -->
                <div class="contents px-3 py-3">
                    <div class="box">
                        <div class="box1">
                            <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                                Hasil Diagnosa
                            </h5>
                        </div>

                        <h5 class="fw-bold mt-4 ms-5">
                            <?= $nama_tamu; ?> (
                            <?= $data['usia_kandungan']; ?> bulan)
                        </h5>

                        <div class="box2 mt-3 text-center">
                            <label for="" class="fw-bold">Gejala</label>
                            <hr style="color: black; opacity: 1;">
                            <table class="table">
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($data_relasi as $dr):
                                        $idgejala = $dr['idgejala'];
                                        $data_gejala = query("SELECT * FROM gejala WHERE idgejala = $idgejala")[0];
                                        ?>
                                        <tr>
                                            <td scope="row">
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= $data_gejala['nama_gejala']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php foreach ($hasil as $hs):
                            $dapen = query("SELECT * FROM penyakit WHERE nama_penyakit = '$hs'")[0];
                            $nama_kecil = strtolower(str_replace(" ", "_", $dapen['nama_penyakit']));

                            $presentase = $data[$nama_kecil] * 100;
                            ?>
                            <div class="box2 mt-4 my-0">
                                <label class="fw-bold">
                                    <?= $hs; ?> (
                                    <?= $presentase; ?>%)
                                </label>
                            </div>
                            <div class="box2 my-0">
                                <label class="fw-medium">
                                    <?= $dapen['deskripsi']; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>

                        <div class="mx-5 mt-3 mb-3">
                            <?php foreach ($hasil as $hs):
                                $dapen = query("SELECT * FROM penyakit WHERE nama_penyakit = '$hs'")[0];
                                $idpenyakit = $dapen['idpenyakit'];
                                $data_solusi = query("SELECT * FROM solusi WHERE idpenyakit = $idpenyakit"); ?>

                                <h6 class="fw-bold">Solusi Penanganan
                                    <?= $hs; ?>:
                                </h6>
                                <ul>
                                    <?php foreach ($data_solusi as $dasol): ?>
                                        <li>
                                            <?= $dasol['solusi']; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                            <?php endforeach; ?>
                        </div>


                        <div class="row justify-content-end mb-4">
                            <div class="col-sm-2">
                                <a href="../login.php" class=" text-dark" type="button" style="background: none;">
                                    Kembali ke Login
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <a class="text-decoration-none btn btn-primary"
                                    href="../cetak.php?idtamu=<?= $idhasil; ?>" target="_blank">
                                    <span><i class="bi bi-printer me-2"></i>CETAK HASIL</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- konten selesai -->
            </div>

        </div>


    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>