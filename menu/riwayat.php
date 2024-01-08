<?php 
    require_once '../controller/hasil.php';
    validasi();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

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
                <!-- sidebar -->
                <?php
                    if ($user['level'] === "User") {
                        require_once('../navbar/sidebar_user.php');
                    } elseif ($user['level'] === "Admin") {
                        require_once('../navbar/sidebar.php');
                    } else {
                        echo "
                            <script>
                                document.location.href='../logout.php';
                            </script>
                        ";
                    }
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3">
                    <div class="box">
                        <div class="box1">
                            <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                                Riwayat Hasil Diagnosa
                            </h5>
                        </div>

                        <div class="tabel mx-5 mt-3">
                            <?php 
                                if($user['level'] == "User") : 
                                    $id = $user['iduser'];

                                    $data_hasil = query("SELECT * FROM hasil WHERE iduser = $id");
                            ?>
                                <table id="example" class="table table-hover text-center">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th class="text-center" scope="col">NO</th>
                                            <th class="text-center" scope="col">TANGGAL</th>
                                            <th class="text-center" scope="col">HASIL DIAGNOSA</th>
                                            <th class="text-center" scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($data_hasil as $dh) :
                                                $waktu_tes = strftime('%H:%M:%S / %d %B %Y', strtotime($dh['tanggal']));
                                                $hasil = hasil($dh);

                                                if(count($hasil) > 1) {
                                                    $nama_penyakit = implode(", ", $hasil);
                                                } else {
                                                    $nama_penyakit = $hasil[0];
                                                }
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $waktu_tes; ?></td>
                                                <td><?= $nama_penyakit; ?></td>
                                                <td>
                                                    <a href="../hasil/index.php?id=<?= enkripsi($dh['idhasil']); ?>">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php 
                                            $i++;
                                            endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            <?php 
                                elseif(($user['level'] == "Admin")) : 
                                    $data_hasil = query("SELECT * FROM hasil ORDER BY iduser ASC");
                            ?>
                                <table id="example" class="table table-hover text-center">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th class="text-center" scope="col">NO</th>
                                            <th class="text-center" scope="col">TANGGAL</th>
                                            <th class="text-center" scope="col">NAMA</th>
                                            <th class="text-center" scope="col">HASIL DIAGNOSA</th>
                                            <th class="text-center" scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($data_hasil as $dh) :
                                                $waktu_tes = strftime('%H:%M:%S / %d %B %Y', strtotime($dh['tanggal']));
                                                $hasil = hasil($dh);
                                                $iduser = $dh['iduser'];

                                                $nama_user = query("SELECT nama FROM user WHERE iduser = $iduser")[0];

                                                if(count($hasil) > 1) {
                                                    $nama_penyakit = implode(", ", $hasil);
                                                } else {
                                                    $nama_penyakit = $hasil[0];
                                                }
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $waktu_tes; ?></td>
                                                <td><?= $nama_user['nama']; ?></td>
                                                <td><?= $nama_penyakit; ?></td>
                                                <td>
                                                    <a href="../hasil/index.php?id=<?= enkripsi($dh['idhasil']); ?>">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php 
                                            $i++;
                                            endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            <?php endif;?>
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#example").DataTable();
        });
    </script>
</body>

</html>