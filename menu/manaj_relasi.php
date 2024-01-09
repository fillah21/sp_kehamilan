<?php
session_start();
require_once '../controller/relasi.php';

$relasi = query("SELECT * FROM relasi_penyakit_gejala ORDER BY idpenyakit");
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

                        <div class="ms-5 mt-3">
                            <a href="../insert/relasi.php">Input Relasi</a>
                        </div>

                        <div class="tabel mt-4 mx-5">
                            <table id="example" class="table table-hover text-center">
                                <thead>
                                    <tr class="table-secondary">
                                        <th class="text-center" scope="col">NO</th>
                                        <th class="text-center" scope="col">PENYAKIT</th>
                                        <th class="text-center" scope="col">GEJALA</th>
                                        <th class="text-center" scope="col" style="width: 150px;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($relasi as $r):
                                        $idpenyakit = $r['idpenyakit'];
                                        $idgejala = $r['idgejala'];
                                        $nama_penyakit = query("SELECT * FROM penyakit WHERE idpenyakit = $idpenyakit")[0];
                                        $nama_gejala = query("SELECT * FROM gejala WHERE idgejala = $idgejala")[0];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= $nama_penyakit['nama_penyakit']; ?> (
                                                <?= $nama_penyakit['kode_penyakit']; ?>)
                                            </td>
                                            <td>
                                                <?= $nama_gejala['nama_gejala']; ?> (
                                                <?= $nama_gejala['kode_gejala']; ?>)
                                            </td>
                                            <td>
                                                <a href="../edit/relasi.php?id=<?= enkripsi($r['idrelasi']); ?>">Edit</a> |
                                                <a href="#" class="delete bg-danger" id="delete"
                                                    onclick="confirmDelete(<?= $r['idrelasi']; ?>)">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });

        function confirmDelete(id) {
            // Menampilkan Sweet Alert dengan tombol Yes dan No
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Memanggil fungsi PHP menggunakan AJAX saat tombol Yes diklik
                    $.ajax({
                        url: '../controller/relasi.php',
                        type: 'POST',
                        data: {
                            action: 'delete',
                            id: id
                        },
                        success: function (response) {
                            // Menampilkan pesan sukses jika data berhasil dihapus 
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Relasi Berhasil Dihapus!',
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    document.location.href = 'manaj_relasi.php';
                                }
                            })
                        },
                        error: function (xhr, status, error) {
                            // Menampilkan pesan error jika terjadi kesalahan dalam penghapusan data
                            Swal.fire({
                                title: 'Error',
                                text: 'Terjadi kesalahan dalam menghapus data: ' + error,
                                icon: 'error'
                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Menampilkan pesan jika tombol No diklik
                    Swal.fire('Batal', 'Penghapusan data dibatalkan', 'info');
                }
            });
        }
    </script>
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