<?php 
    require_once 'main.php';

    function create($data)
{
    global $conn;

    $idpenyakit = htmlspecialchars($data['idpenyakit']);
    $idgejala = htmlspecialchars($data['idgejala']);

    if ($idpenyakit == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Penyakit tidak boleh kosong, silahkan pilih penyakit',
                    'error'
                )
              </script>";
        exit();
    } elseif ($idgejala == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Gejala tidak boleh kosong, silahkan pilih gejala',
                    'error'
                )
              </script>";
        exit();
    } else {
        $result = mysqli_query($conn, "SELECT * FROM relasi_penyakit_gejala WHERE idgejala = '$idgejala' AND idpenyakit = '$idpenyakit'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Relasi sudah ada, silahkan pilih relasi lain',
                        'error'
                    )
                </script>";
            exit();
        }
    }

    $query = "INSERT INTO relasi_penyakit_gejala
                    VALUES
                    (NULL, '$idgejala', '$idpenyakit')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data['idrelasi'];
    $oldpenyakit = $data['oldpenyakit'];
    $oldgejala = $data['oldgejala'];

    $idpenyakit = htmlspecialchars($data['idpenyakit']);
    $idgejala = htmlspecialchars($data['idgejala']);

    if ($idpenyakit == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Penyakit tidak boleh kosong, silahkan pilih penyakit',
                    'error'
                )
              </script>";
        exit();
    } elseif ($idgejala == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Gejala tidak boleh kosong, silahkan pilih gejala',
                    'error'
                )
              </script>";
        exit();
    } elseif ($oldpenyakit != $idpenyakit || $oldgejala != $idgejala) {
        $result = mysqli_query($conn, "SELECT * FROM relasi_penyakit_gejala WHERE idgejala = '$idgejala' AND idpenyakit = '$idpenyakit'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Relasi sudah ada, silahkan pilih relasi lain',
                        'error'
                    )
                </script>";
            exit();
        }
    }

    $query = "UPDATE relasi_penyakit_gejala SET 
                    idgejala = '$idgejala',
                    idpenyakit = '$idpenyakit'
                  WHERE idrelasi = '$id'
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM relasi_penyakit_gejala WHERE idrelasi = $id");

    $deleted = true;

    return $deleted;
}

// Mengecek apakah ada permintaan penghapusan data
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    // Mengambil nilai parameter id dari data POST
    $id = $_POST['id'];

    // Memanggil fungsi delete untuk menghapus data
    $status = delete($id);

    // Mengirimkan respons ke JavaScript
    if ($status) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>