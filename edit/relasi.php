<?php 
    session_start();
    require_once '../controller/relasi.php';

    $id = dekripsi($_GET['id']);
    $data = query("SELECT * FROM relasi_penyakit_gejala WHERE idrelasi = $id")[0];

    $penyakit = query("SELECT * FROM penyakit");
    $gejala = query("SELECT * FROM gejala");
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
                                Manajemen Relasi Penyakit dan Gejala
                            </h5>
                        </div>


                        <form method="post" action="">
                            <input type="hidden" name="idrelasi" value="<?= $id; ?>">
                            <input type="hidden" name="oldpenyakit" value="<?= $data['idpenyakit']; ?>">
                            <input type="hidden" name="oldgejala" value="<?= $data['idgejala']; ?>">

                            <div class="mb-3 mt-4 row ms-5">
                                <label for="inputPenyakit" class="col-sm-2 me-0 col-form-label">Penyakit :</label>
                                <div class="col-sm-8">
                                    <select class="boxc form-control" style="border-color: black;" name="idpenyakit"
                                        require>
                                        <option hidden selected value="">--Pilih Penyakit--</option>
                                        <?php
                                        foreach ($penyakit as $p):
                                            ?>
                                            <option value="<?php echo $p['idpenyakit'] ?>" <?= $p['idpenyakit'] == $data['idpenyakit'] ? 'selected' : '' ?>>(<?= $p['kode_penyakit']; ?>) <?php echo $p['nama_penyakit'] ?>
                                            </option>
                                            <?php
                                        endforeach
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 mt-4 row ms-5">
                                <label for="inputPenyakit" class="col-sm-2 me-0 col-form-label">Gejala :</label>
                                <div class="col-sm-8">
                                    <select class="boxc form-control" style="border-color: black;" name="idgejala"
                                        require>
                                        <option hidden selected value="">--Pilih Gejala--</option>
                                        <?php
                                        foreach ($gejala as $g):
                                            ?>
                                            <option value="<?php echo $g['idgejala'] ?>" <?= $g['idgejala'] == $data['idgejala'] ? 'selected' : '' ?>>(<?= $g['kode_gejala']; ?>) <?php echo $g['nama_gejala'] ?>
                                            </option>
                                            <?php
                                        endforeach
                                        ?>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="row justify-content-end">
                                <div class="col-sm-2">
                                    <a type="button" class="text-dark mt-3 px-4" href="../menu/manaj_relasi.php"
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
if (isset($_POST['submit'])) {
    if (update($_POST) > 0) {
        $_SESSION["berhasil"] = "Data Relasi Berhasil Diubah!";

        echo "
          <script>
            document.location.href='../menu/manaj_relasi.php';
          </script>
      ";
    } else {
        $_SESSION["gagal"] = "Data Relasi Gagal Diubah!";

        echo "
          <script>
            document.location.href='relasi.php';
          </script>
      ";
    }
}
?>