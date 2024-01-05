<?php 
    require_once 'main.php';

    function kode() {
        $query = "SELECT * FROM penyakit";
        $kode = "";

        $jumlah = jumlah_data($query);

        if($jumlah == 0) {
            $kode = "P1";
        } else {
            for($i = 1; $i <= $jumlah; $i++) { 
                $totalP = jumlah_data("SELECT * FROM penyakit WHERE kode_penyakit = 'P{$i}'");

                if ($totalP == 0) {
                    $kode = "P{$i}";
                    break;
                } else {
                    $angka = $jumlah + 1;
                    $kode = "P{$angka}";
                }
            };
        }

        return $kode;
    }

    function create($data) {
        global $conn;

        $kode_penyakit = htmlspecialchars($data['kode_penyakit']);
        $nama_penyakit = htmlspecialchars($data['nama_penyakit']);
        $deskripsi = htmlspecialchars($data['deskripsi']);

        if($nama_penyakit == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Nama penyakit tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        } else {
            $result = mysqli_query($conn, "SELECT nama_penyakit FROM penyakit WHERE nama_penyakit = '$nama_penyakit'");

            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Nama penyakit sudah ada',
                            'error'
                        )
                    </script>";
                exit();
            }
        }

        if($deskripsi == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Deskripsi tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        }

        $query = "INSERT INTO penyakit
                    VALUES
                    (NULL, '$kode_penyakit', '$nama_penyakit', '$deskripsi')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function update($data) {
        global $conn;
        $id = $data['idpenyakit'];
        $oldnama = htmlspecialchars($data['oldnama']);

        $nama_penyakit = htmlspecialchars($data['nama_penyakit']);
        $deskripsi = htmlspecialchars($data['deskripsi']);

        if($nama_penyakit == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Nama penyakit tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        } elseif($nama_penyakit != $oldnama) {
            $result = mysqli_query($conn, "SELECT nama_penyakit FROM penyakit WHERE nama_penyakit = '$nama_penyakit'");

            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Nama penyakit sudah ada',
                            'error'
                        )
                    </script>";
                exit();
            }
        }

        if($deskripsi == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Deskripsi tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        }

        $query = "UPDATE penyakit SET 
                    nama_penyakit = '$nama_penyakit',
                    deskripsi = '$deskripsi'
                  WHERE idpenyakit = '$id'
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($id)
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM penyakit WHERE idpenyakit = $id");

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