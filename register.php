<?php
session_start();
require_once 'controller/user.php';
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
            <div class="container-sm" style="width: 550px; padding: 25px;">
                <h4 class="mb-5">Registrasi</h4>
                <form method="post" action="">
                    <input type="hidden" name="level" value="User">
                    <div class="mb-3">
                        <input type="text" style="border-color: black;" class="form-control" placeholder="Nama"
                            name="nama">
                    </div>
                    <div class="mb-3">
                        <input type="text" style="border-color: black;" class="form-control" placeholder="Username"
                            name="username">
                    </div>
                    <div class="mb-3">
                        <input type="password" style="border-color: black;" class="form-control" placeholder="Password"
                            name="password">
                    </div>
                    <div class="mb-3">
                        <input type="password" style="border-color: black;" class="form-control"
                            placeholder="Konfirmasi Password" name="password2">
                    </div>
                    <div class="mb-3">
                        <input type="email" style="border-color: black;" class="form-control" placeholder="Email"
                            name="email">
                    </div>

                    <div style="display: flex; justify-content: space-between;">
                        <button type="submit" class="btn btn-primary mt-2 mb-2 px-4" style="border-radius: 15px;"
                            name="register">Kirim</button>
                        <p class="text-end mt-3">Sudah Punya akun? <a href="login.php">Login</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php
if (isset($_POST['register'])) {
    if (register($_POST) > 0) {
        $_SESSION["berhasil"] = "Registrasi Berhasil!";
        echo "
            <script>
              document.location.href='login.php';
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
?>