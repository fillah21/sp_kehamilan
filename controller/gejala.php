<?php 
    require_once 'main.php';

    function kode() {
        $query = "SELECT * FROM gejala";
        $kode = "";

        $jumlah = jumlah_data($query);

        if($jumlah == 0) {
            $kode = "G1";
        } else {
            for($i = 1; $i <= $jumlah; $i++) { 
                $totalP = jumlah_data("SELECT * FROM gejala WHERE kode_gejala = 'G{$i}'");

                if ($totalP == 0) {
                    $kode = "G{$i}";
                    break;
                } else {
                    $angka = $jumlah + 1;
                    $kode = "G{$angka}";
                }
            };
        }

        return $kode;
    }

    function create($data) {
        global $conn;

        $kode_gejala = htmlspecialchars($data['kode_gejala']);
        $nama_gejala = htmlspecialchars($data['nama_gejala']);

        if($nama_gejala == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Nama gejala tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        } else {
            $result = mysqli_query($conn, "SELECT nama_gejala FROM gejala WHERE nama_gejala = '$nama_gejala'");

            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Nama gejala sudah ada',
                            'error'
                        )
                    </script>";
                exit();
            }
        }

        $query = "INSERT INTO gejala
                    VALUES
                    (NULL, '$kode_gejala', '$nama_gejala')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function update($data) {
        global $conn;
        $id = $data['idgejala'];
        $oldgejala = htmlspecialchars($data['oldgejala']);

        $nama_gejala = htmlspecialchars($data['nama_gejala']);

        if($nama_gejala == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Nama gejala tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        } elseif($nama_gejala != $oldgejala) {
            $result = mysqli_query($conn, "SELECT nama_gejala FROM gejala WHERE nama_gejala = '$nama_gejala'");

            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Nama gejala sudah ada',
                            'error'
                        )
                    </script>";
                exit();
            }
        }

        $query = "UPDATE gejala SET 
                    nama_gejala = '$nama_gejala'
                  WHERE idgejala = '$id'
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($id)
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM gejala WHERE idgejala = $id");

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