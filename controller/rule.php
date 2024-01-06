<?php 
    require_once 'main.php';
    
    function create($data)
{
    global $conn;
    $idgejala = htmlspecialchars($data['idgejala']);
    $nilai = htmlspecialchars($data['nilai']);

    
    if ($idgejala == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Gejala tidak boleh kosong, silahkan pilih gejala',
                    'error'
                )
            </script>";
        exit();
    }

    if ($nilai == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Bobot tidak boleh kosong',
                    'error'
                )
              </script>";
        exit();
    } 
        
    $query = "INSERT INTO rule
                    VALUES
                    (NULL, '$idgejala', '$nilai')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data['idrule'];

    $nilai = htmlspecialchars($data['nilai']);

    if ($nilai == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Bobot tidak boleh kosong',
                    'error'
                )
              </script>";
        exit();
    } 

    $query = "UPDATE rule SET 
                    nilai = '$nilai'
                  WHERE idrule = '$id'
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM rule WHERE idrule = $id");

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