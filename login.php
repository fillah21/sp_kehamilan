<?php
session_start();
require_once 'controller/user.php';

if (isset($_COOKIE['SPKehamilan'])) {
    echo "<script>
            document.location.href='user/index.php';
          </script>";
    exit;
}

if (isset($_POST["login"])) {
    if (login($_POST) == 1) {
        $error = true;
    }
}
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

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;500&display=swap" rel="stylesheet">

    <title>SP Penyakit Ibu Hamil</title>

    <!-- css -->
    <link rel="stylesheet" href="style.css">

    <!-- logo -->
    <link rel="Icon" href="">
</head>

<body>
    <div class="content d-flex justify-content-center">
        <div class="d-flex align-items-center">
            <div class="box1 container-sm" style="width: 550px; padding: 25px;">
                <h4 class="fw-bold">Login</h4>
                <hr class="mb-5" style="color: black; opacity: 1;">
                <div class="m-5">
                    <form method="post" action="">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                Username/Password Salah
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <input type="text" style="border-color: black;" name="username" class="form-control"
                                placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <input type="password" style="border-color: black;" name="password" class="form-control"
                                placeholder="Password">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" name="submit_login" class="btn btn-primary mt-3 px-4"
                                    style="border-radius: 15px;">Login</button>
                            </div>
                            <a class="col-sm-6 mt-4 d-flex justify-content-end text-primary" type="button"
                                style="font-size: 13.5px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Lupa Password?
                            </a>
                        </div>

                        <div class="mt-3 row">
                            <div class="col-sm-6">
                                <a href="register.php">Sign In</a>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <a href="diagnosa/umum.php">Masuk Sebagai Umum</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Modal Forgot Password = Input Email -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">Masukkan Email</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="sendemail.php" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="email" class="form-label text-dark">Masukkan email yang
                                        terdaftar</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Pilih</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Forgot Password = Input Email Selesai -->
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
if (isset($_SESSION["berhasil"])) {
    $pesan = $_SESSION["berhasil"];

    echo "
              <script>
                Swal.fire(
                  'Berhasil!',
                  '$pesan',
                  'success'
                )
              </script>
          ";
    $_SESSION = [];
    session_unset();
    session_destroy();


} elseif (isset($_SESSION['gagal'])) {
    $pesan = $_SESSION["gagal"];

    echo "
            <script>
                Swal.fire(
                    'Gagal!',
                    '$pesan',
                    'error'
                )
            </script>
        ";
    $_SESSION = [];
    session_unset();
    session_destroy();

}

?>