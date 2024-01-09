<?php
require_once 'main.php';

function hitung($data)
{
    if ($data['usia_kandungan'] == "") {
        echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Usia kandungan tidak boleh kosong',
                            'error'
                        )
                    </script>";
        exit();
    } elseif ($data['usia_kandungan'] > 9) {
        echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Usia kandungan tidak boleh lebih dari 9 bulan',
                            'error'
                        )
                    </script>";
        exit();
    }
    $data_penyakit = query("SELECT * FROM penyakit");
    $hasil = [];

    foreach ($data_penyakit as $dp) {
        $id_penyakit = $dp['idpenyakit'];
        $data_relasi = query("SELECT * FROM relasi_penyakit_gejala WHERE idpenyakit = $id_penyakit");

        ${'nilai_sementara-' . $id_penyakit} = 0;

        // Mencari nilai sementara untuk setiap penyakit
        foreach ($data_relasi as $dr) {
            $id_gejala = $dr['idgejala'];
            $data_rule = query("SELECT * FROM rule WHERE idgejala = $id_gejala")[0];

            ${'nilai_sementara-' . $id_penyakit} += $data_rule['nilai'];
        }
        // echo "<h3>Nilai sementara dari penyakit " . $dp['nama_penyakit'] . " (" . $dp['kode_penyakit'] . ") adalah " .  ${'nilai_sementara-' . $id_penyakit} . "</h3><br><br>";

        // Menghitung nilai sementara P(H)
        ${'sigma_p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']} = 0;
        foreach ($data_relasi as $darel) {
            $id_gejala = $darel['idgejala'];
            $data_gejala = query("SELECT * FROM gejala WHERE idgejala = $id_gejala")[0];

            if (isset($data[$data_gejala['kode_gejala']])) {
                // echo "gejala " . $data_gejala['kode_gejala'] . ") ditemukan di penyakit " . $dp['nama_penyakit'] .  " (" . $dp['kode_penyakit'] . ")<br><br>";

                $data_rule = query("SELECT * FROM rule WHERE idgejala = $id_gejala")[0];

                ${'p_h_' . $data_gejala['kode_gejala']} = $data_rule['nilai'] / ${'nilai_sementara-' . $id_penyakit};

                // echo "Hasil P(H" . $data_gejala['kode_gejala'] . ") dari " . $data_rule['nilai'] . " / " . ${'nilai_sementara-' . $id_penyakit} . " = " . ${'p_h_' . $data_gejala['kode_gejala']} . "<br><br>";

                ${'p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']} = $data[$data_gejala['kode_gejala']] * ${'p_h_' . $data_gejala['kode_gejala']};

                ${'sigma_p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']} += ${'p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']};

                // echo "Hasil P(E|H)" . $dp['kode_penyakit'] . " * P(H)" . $data_gejala['kode_gejala'] . " dari " . $data[$data_gejala['kode_gejala']] . " * " . ${'p_h_' . $data_gejala['kode_gejala']} . "= " . ${'p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']} . "<br><br>";
            }
        }

        // echo "Hasil sigma P(E|H)" . $dp['kode_penyakit'] . " * P(H)" . $dp['kode_penyakit'] . "= " . ${'sigma_p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']} . "<br><br>";

        foreach ($data_relasi as $dare) {
            $id_gejala = $dare['idgejala'];
            $data_gejala = query("SELECT * FROM gejala WHERE idgejala = $id_gejala")[0];

            if (isset($data[$data_gejala['kode_gejala']])) {
                $data_rule = query("SELECT * FROM rule WHERE idgejala = $id_gejala")[0];

                ${'p_h_' . $data_gejala['kode_gejala']} = $data_rule['nilai'] / ${'nilai_sementara-' . $id_penyakit};

                ${'p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']} = $data[$data_gejala['kode_gejala']] * ${'p_h_' . $data_gejala['kode_gejala']};

                ${'p_h_e_' . $data_gejala['kode_gejala']} = (${'p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']}) / ${'sigma_p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']};

                // echo "Hasil P(H|E)" . $data_gejala['kode_gejala'] . " dari (" . $data[$data_gejala['kode_gejala']] . " * " . ${'p_h_' . $data_gejala['kode_gejala']} . ") / " . ${'sigma_p_e_h_' . $dp['kode_penyakit'] . '_kali_p_' . $dp['kode_penyakit']} . " = " . ${'p_h_e_' . $data_gejala['kode_gejala']} . "<br><br>";
            }
        }

        ${"sigma_bayes_" . $dp['kode_penyakit']} = 0;
        foreach ($data_relasi as $dasi) {
            $id_gejala = $dasi['idgejala'];
            $data_gejala = query("SELECT * FROM gejala WHERE idgejala = $id_gejala")[0];
            $data_rule = query("SELECT * FROM rule WHERE idgejala = $id_gejala")[0];

            if (isset($data[$data_gejala['kode_gejala']])) {
                ${"bayes_" . $data_gejala['kode_gejala']} = ${'p_h_e_' . $data_gejala['kode_gejala']} * $data_rule['nilai'];

                // echo "Hasil Bayes " . $data_gejala['kode_gejala'] . " dari " . ${'p_h_e_' . $data_gejala['kode_gejala']} . " * " . $data_rule['nilai'] . " = " . ${"bayes_" . $data_gejala['kode_gejala']} . "<br><br>";

                ${"sigma_bayes_" . $dp['kode_penyakit']} += ${"bayes_" . $data_gejala['kode_gejala']};
            }
        }
        // echo "Hasil sigma Bayes " . $dp['kode_penyakit'] . " adalah " . ${"sigma_bayes_" . $dp['kode_penyakit']} . "<br><br>";
        $hasil[] = number_format(${"sigma_bayes_" . $dp['kode_penyakit']}, 2);
    }

    return $hasil;
}

function save($data, $id)
{
    global $conn;

    $usia_kandungan = $data['usia_kandungan'];

    $hasil = hitung($data);

    $value = implode(", ", $hasil);

    $query = "INSERT INTO hasil
                    VALUES
                    (NULL, '$id', CURRENT_TIMESTAMP(), '$usia_kandungan', ";

    $query .= $value . ")";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function save_tamu($data)
{
    global $conn;
    $usia_kandungan = $data['usia_kandungan'];
    $nama = $data['nama'];

    if ($nama == "") {
        echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Nama tidak boleh kosong',
                            'error'
                        )
                    </script>";
        exit();
    }

    $hasil = hitung($data);


    $value = implode(", ", $hasil);

    $query = "INSERT INTO tamu
                    VALUES
                    (NULL, '$nama', CURRENT_TIMESTAMP(), '$usia_kandungan', ";

    $query .= $value . ")";


    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hasil($data)
{
    $penyakit = query("SELECT * FROM penyakit");

    foreach ($penyakit as $pen) {
        $nama[] = strtolower(str_replace(" ", "_", $pen['nama_penyakit']));
        $nama_penyakit[] = $pen['nama_penyakit'];
    }

    foreach ($nama as $na) {
        $nilai_hasil[] = $data[$na];
    }

    $posisi = array_keys($nilai_hasil, max($nilai_hasil));

    foreach ($posisi as $po) {
        $hasil_penyakit[] = $nama_penyakit[$po];
    }

    return $hasil_penyakit;
}
?>