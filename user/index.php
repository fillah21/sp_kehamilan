<?php
session_start();
require_once('../controller/main.php');
validasi();

$id = dekripsi($_COOKIE['SPKehamilan']);
$user = query("SELECT * FROM user WHERE iduser = $id")[0];

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
        require_once('../navbar/navbar.html');
        ?>
        <!-- navbar selesai -->

        <div class="main-container m-0">
            <div class="d-flex">
                <!-- sidebar -->
                <?php
                // Cek peran pengguna dan masukkan file sidebar yang sesuai
                if ($user['level'] === "User") {
                    require_once('../navbar/sidebar_user.php');
                } elseif ($user['level'] === "Admin") {
                    require_once('../navbar/sidebar.php');
                } else {
                    // Jika peran tidak dikenali, Anda dapat menambahkan pesan error atau tindakan lain sesuai kebutuhan
                    echo "Error: Peran pengguna tidak valid.";
                }
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3 text-center justify-content-center">
                    <?php
                    if ($user['level'] === "User") {
                        echo '<h4 class="text-dark text-center">User</h4>';
                    } else {
                        echo '<h4 class="text-dark text-center">Admin</h4>';
                    }
                    ?>
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