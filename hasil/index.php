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
                <!-- sidebar -->
                <?php
                if(isset($_COOKIE['SPKehamilan'])) {
                    $user = cari_user();
                    if ($user['level'] === "User") {
                        require_once('../navbar/sidebar_user.php');
                    } elseif ($user['level'] === "Admin") {
                        require_once('../navbar/sidebar.php');
                    }
                }
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3">
                    <div class="box">
                        <div class="box1">
                            <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                                Hasil Diagnosa
                            </h5>
                        </div>

                        <h5 class="fw-bold mt-4 ms-5">Nama Pengguna (24 tahun)</h5>

                        <div class="box2 mt-3 text-center">
                            <label for="" class="fw-bold">Gejala</label>
                            <hr style="color: black; opacity: 1;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td scope="row">1</td>
                                        <td>Gejala Pertama</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">2</td>
                                        <td>Gejala Kedua</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">3</td>
                                        <td>Gejala Ketiga</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="box2 my-0">
                            <label class="fw-bold">Nama Penyakit</label>
                        </div>
                        <div class="box2 my-0">
                            <label class="fw-medium">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo
                                laudantium repudiandae reprehenderit quisquam maiores fugit blanditiis fuga nisi aperiam
                                doloribus, qui modi. Ullam mollitia, temporibus porro fugiat officia pariatur
                                laboriosam.</label>
                        </div>

                        <div class="mx-5 mt-3 mb-3">
                            <h6 class="fw-bold">Solusi Penanganan :</h6>
                            <span>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit porro explicabo
                                doloribus qui numquam fugiat accusantium, eligendi est neque iusto rem eos perferendis
                                enim, cupiditate odit sequi maxime aliquid temporibus.
                            </span>
                        </div>

                        <div class="text-center mb-4">
                            <button type="button" class="btn btn-primary"
                                style="border-radius: 15px; width: 150px;">Cetak</button>
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
</body>

</html>