<?php
require_once '../controller/hasil.php';

$gejala = query("SELECT * FROM gejala");
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
                            <h5 class="text-dark mb-0 ms-4 fw-bold">
                                Diagnosa Penyakit Pada Ibu Hamil
                            </h5>
                        </div>

                        <form method="post" action="" id="diagnosisForm">
                            <div class="mb-3 mt-4 row ms-5">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputName" name="nama">
                                </div>
                            </div>
                            <div class="mb-3 mt-3 row ms-5">
                                <label for="inputUsia" class="col-sm-2 col-form-label">Usia :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputUsia" name="usia_kandungan">
                                </div>
                            </div>

                            <h5 class=" fw-bold ms-5 mt-4">Pilih Gejala</h5>
                            <div class="box1 mx-5">
                                <?php foreach ($gejala as $g): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="<?= $g['kode_gejala']; ?>" name="<?= $g['kode_gejala']; ?>">
                                        <label class="form-check-label" for="<?= $g['kode_gejala']; ?>">
                                            <?= $g['nama_gejala']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary ms-5 mt-3 px-4"
                                        style="border-radius: 15px;" name="submit">Submit</button>
                                </div>
                                <div class="col-sm-2 mt-3">
                                    <a href="../login.php" class=" text-dark" type="button" style="background: none;">
                                        Kembali ke Login
                                    </a>
                                </div>
                            </div>

                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ... -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var usiaInput = document.getElementById('inputUsia');
            var diagnosisForm = document.getElementById('diagnosisForm');

            usiaInput.addEventListener('input', function () {
                var usiaValue = parseInt(usiaInput.value);
                var gejalaCheckboxes = document.querySelectorAll('.form-check-input');

                // Reset checkbox status
                gejalaCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                // Check specific checkbox based on usia
                if (usiaValue >= 7) {
                    var gejalaCheckbox = document.getElementById('G7');
                    if (gejalaCheckbox) {
                        gejalaCheckbox.checked = true;
                    }
                }
            });

            diagnosisForm.addEventListener('submit', function (event) {

            });
        });
    </script>
    <!-- ... -->

</body>

</html>

<?php
if (isset($_POST['submit'])) {
    if (save_tamu($_POST) > 0) {
        echo "
                <script>
                  document.location.href='../hasil/umum.php?key= . " . enkripsi($_POST['nama']) . "';
                </script>
            ";
    } else {
        echo "
                <script>
                  document.location.href='umum.php';
                </script>
            ";
    }
}
?>