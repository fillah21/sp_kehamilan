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
                require_once('../navbar/sidebar.php');
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

                        <div class="ms-5 mt-3">
                            <a href="../insert/penyakit.php">Tambah Data</a>
                        </div>

                        <div class="tabel mt-4 mx-5">
                            <table id="example" class="table table-hover text-center">
                                <thead>
                                    <tr class="table-secondary">
                                        <th class="text-center" scope="col">Kode Penyakit</th>
                                        <th class="text-center" scope="col">Nama Penyakit</th>
                                        <th class="text-center" scope="col">Deskripsi</th>
                                        <th class="text-center" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            kode
                                        </td>
                                        <td>
                                            penyakit
                                        </td>
                                        <td class="truncate">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum hic voluptate
                                            doloribus cumque unde, assumenda sint corrupti itaque ad corporis placeat
                                            iusto perferendis in nostrum. Dolores sit quidem totam et!
                                        </td>
                                        <td>
                                            <a href="../edit/penyakit.php">Edit</a> | <button type="button"
                                                class="btn btn-danger" style="border-radius: 12px; padding: 2px 17px;"
                                                id="delete">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            kode
                                        </td>
                                        <td>
                                            penyakit
                                        </td>
                                        <td>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum hic voluptate
                                            doloribus cumque unde, assumenda sint corrupti itaque ad corporis placeat
                                            iusto perferendis in nostrum. Dolores sit quidem totam et!
                                        </td>
                                        <td>
                                            <a href="../edit/penyakit.php">Edit</a> | <button type="button"
                                                class="btn btn-danger" style="border-radius: 12px; padding: 2px 17px;"
                                                id="delete">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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