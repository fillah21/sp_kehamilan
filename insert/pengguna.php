<?php 
    session_start();
    require_once '../controller/user.php';
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
                require_once('../navbar/sidebar.php');
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3">
                    <div class="box">
                        <div class="box1">
                            <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                                Manajemen Data Pengguna
                            </h5>
                        </div>


                        <form method="post" action="">
                            <div class="mb-3 mt-4 row ms-5">
                                <label for="inputName" class="col-sm-3 me-0 col-form-label">Nama :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputName" name="nama">
                                </div>
                            </div>
                            <div class="mb-3 mt-2 row ms-5">
                                <label for="inputEmail" class="col-sm-3 me-0 col-form-label">Email :</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="inputEmail" name="email">
                                </div>
                            </div>
                            <div class="mb-3 mt-2 row ms-5">
                                <label for="inputUsername" class="col-sm-3 me-0 col-form-label">Username :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputUsername" name="username">
                                </div>
                            </div>
                            <div class="mb-3 mt-2 row ms-5">
                                <label for="inputPassword" class="col-sm-3 me-0 col-form-label">Password :</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="inputPassword" name="password">
                                </div>
                            </div>
                            <div class="mb-3 mt-2 row ms-5">
                                <label for="inputKPassword" class="col-sm-3 me-0 col-form-label">Konfirmasi Password
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="inputKPassword" name="password2">
                                </div>
                            </div>
                            <div class="mb-3 mt-2 row ms-5">
                                <label for="inputKPassword" class="col-sm-3 me-0 col-form-label">Status Pengguna
                                    :</label>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="level" id="admin" value="Admin">
                                        <label class="form-check-label" for="admin">
                                            Admin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="level" id="user" checked value="User">
                                        <label class="form-check-label" for="user">
                                            User
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end me-5">
                                <button type="submit" class="btn btn-primary mt-3 px-4"
                                    style="border-radius: 15px;" name="register">Submit</button>
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
if(isset($_POST['register'])) {
    if (register($_POST) > 0) {
      $_SESSION["berhasil"] = "Registrasi Berhasil!";
        echo "
            <script>
              document.location.href='../menu/manaj_pengguna.php';
            </script>
        ";
    } else {
      echo "
          <script>
              Swal.fire(
                'Gagal!',
                'Registrasi Gagal!',
                'error'
            )
          </script>
      ";
    }
}