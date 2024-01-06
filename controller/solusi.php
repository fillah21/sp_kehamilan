<?php
require_once 'main.php';

function create($solusi)
{
    global $conn;

    $idpenyakit = htmlspecialchars($solusi['idpenyakit']);
    $solusi = htmlspecialchars($solusi['solusi']);

    if ($solusi == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Solusi tidak boleh kosong',
                    'error'
                )
              </script>";
        exit();
    } else {
        $result = mysqli_query($conn, "SELECT solusi FROM solusi WHERE solusi = '$solusi' AND idpenyakit = '$idpenyakit'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Solusi sudah ada, silahkan inputkan solusi lain',
                        'error'
                    )
                </script>";
            exit();
        }
    }

    if ($idpenyakit == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Penyakit tidak boleh kosong',
                    'error'
                )
              </script>";
        exit();
    }

    $query = "INSERT INTO solusi
                    VALUES
                    (NULL, '$idpenyakit', '$solusi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($solusi)
{
    global $conn;
    $id = $solusi['idsolusi'];
    $idpenyakit = $solusi['idpenyakit'];
    $oldsolusi = htmlspecialchars($solusi['oldsolusi']);

    $solusi = htmlspecialchars($solusi['solusi']);

    if ($solusi == "") {
        echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Solusi tidak boleh kosong',
                        'error'
                    )
                  </script>";
        exit();
    } elseif ($solusi != $oldsolusi) {
        $result = mysqli_query($conn, "SELECT solusi FROM solusi WHERE solusi = '$solusi' AND idpenyakit = '$idpenyakit'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Solusi sudah ada, silahkan inputkan solusi lain',
                            'error'
                        )
                    </script>";
            exit();
        }
    }

    $query = "UPDATE solusi SET 
                    idpenyakit = '$idpenyakit',
                    solusi = '$solusi'
                  WHERE idsolusi = '$id'
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM solusi WHERE idsolusi = $id");

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