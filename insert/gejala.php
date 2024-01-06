<?php 
    session_start();
    require_once '../controller/gejala.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <title>SP Gejala Ibu Hamil</title>

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
                                Manajemen Data Gejala
                            </h5>
                        </div>


                        <form method="post" action="">
                            <div class="mb-3 mt-4 row ms-5">
                                <label for="inputName" class="col-sm-2 me-0 col-form-label">Kode :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputName" name="kode_gejala" value="<?= kode(); ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 mt-2 row ms-5">
                                <label for="inputUsername" class="col-sm-2 me-0 col-form-label">Gejala :</label>
                                <div class="col-sm-8">
                                    <textarea type="text" style="border-color: black;" class="form-control"
                                        id="inputUsername" name="nama_gejala"></textarea>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-2">
                                    <a type="button" class="text-dark mt-3 px-4" href="../menu/manaj_gejala.php"
                                        style="background:none;">Kembali</a>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary mt-3 px-4" style="border-radius: 15px;"
                                        name="submit">Submit</button>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php 
  if(isset($_POST['submit'])) {
    if (create($_POST) > 0) {
      $_SESSION["berhasil"] = "Data Gejala Berhasil Ditambahkan!";

      echo "
          <script>
            document.location.href='../menu/manaj_gejala.php';
          </script>
      ";
    } else {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Data Gejala Gagal Ditambahkan',
                    'error'
                )
            </script>";
        exit();
    }
  }
?>