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
        require_once('../navbar/navbar.html');
        ?>
        <!-- navbar selesai -->

        <div class="main-container m-0">
            <div class="d-flex">
                <!-- sidebar -->
                <?php
                require_once('../navbar/sidebar.html');
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3">
                    <div class="box">
                        <div class="box1">
                            <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                                Manajemen Data Penyakit
                            </h5>
                        </div>


                        <form method="post" action="">
                            <div class="mb-3 mt-4 row ms-5">
                                <label for="inputName" class="col-sm-2 me-0 col-form-label">Kode :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputName">
                                </div>
                            </div>
                            <div class="mb-3 mt-2 row ms-5">
                                <label for="inputEmail" class="col-sm-2 me-0 col-form-label">Penyakit :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail">
                                </div>
                            </div>
                            <div class="mb-3 mt-2 row ms-5">
                                <label for="inputUsername" class="col-sm-2 me-0 col-form-label">Deskripsi :</label>
                                <div class="col-sm-8">
                                    <textarea type="text" style="border-color: black;" class="form-control"
                                        id="inputUsername"></textarea>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-2">
                                    <a type="button" class="text-dark mt-3 px-4" href="../menu/manaj_penyakit.php"
                                        style="background:none;">Kembali</a>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary mt-3 px-4" style="border-radius: 15px;"
                                        name="register">Submit</button>
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#example").DataTable();
        });
    </script>
</body>

</html>