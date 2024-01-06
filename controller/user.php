<?php
require_once 'main.php';

// Fungsi login
function login($data)
{
    global $conn;

    $username = $data["username"];
    $password = $data["password"];

    //cek username apakah ada di database atau tidak
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        // var_dump($row);
        //password_verify() untuk mengecek apakah sebuah password itu sama atau tidak dengan hash nya
        //parameternya yaitu string yang belum diacak dan string yang sudah diacak
        if (password_verify($password, $row["password"])) {
            $enkripsi = enkripsi($row['iduser']);

            setcookie('SPKehamilan', $enkripsi, time() + 10800);
            echo "<script>
                    document.location.href='user';
                </script>";
            exit;
        }
    }

    $error = true;

    return $error;
}
// Fungsi login selesai

// Fungsi update password
function update_password($data)
{
    global $conn;

    $iduser = $data['iduser'];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    if ($password == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Password tidak boleh kosong',
                    'error'
                )
              </script>";
        exit();
    } elseif ($password2 == "") {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Silahkan isi konfirmasi password',
                    'error'
                )
              </script>";
        exit();
    }


    if ($password !== $password2) {
        echo "<script>
                Swal.fire(
                    'Gagal!',
                    'Password tidak sesuai',
                    'error'
                )
              </script>";
        exit();
    }

    $password = password_hash($password2, PASSWORD_DEFAULT);

    $query = "UPDATE user SET 
                password = '$password'
              WHERE iduser = '$iduser'
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// Fungsi update password selesai

// Fungsi Delete Akun
function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE iduser = $id");

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
// Fungsi Delete Akun selesai


// Fungsi Registrasi User
function register($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $email = htmlspecialchars($data['email']);
    $level = htmlspecialchars($data['level']);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'") or die(mysqli_error($conn));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Username sudah digunakan, silahkan pakai username lain',
                        'error'
                    )
                </script>";
        exit();
    }

    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'") or die(mysqli_error($conn));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Email sudah digunakan, silahkan pakai email lain',
                        'error'
                    )
                </script>";
        exit();
    }

    if ($password !== $password2) {
        echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Password tidak sesuai',
                        'error'
                    )
                </script>";
        exit();
    }


    //enkripsi password
    $password = password_hash($password2, PASSWORD_DEFAULT);


    //jika password sama, masukkan data ke database
    mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$username', '$password', '$nama', '$email', '$level')");

    return mysqli_affected_rows($conn);
}
// Fungsi Registrasi User Selesai


// Fungsi Edit Data Pengguna
function update($data)
{
    global $conn;
    $iduser = $data['iduser'];
    $oldpassword = $data['oldpassword'];
    $oldusername = $data['oldusername'];
    $oldemail = $data['oldemail'];

    $nama = htmlspecialchars($data['nama']);
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $email = htmlspecialchars($data['email']);
    $level = htmlspecialchars($data['level']);

    if ($username !== $oldusername) {
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Username sudah digunakan, silahkan pakai username lain',
                        'error'
                    )
                  </script>";
            exit();
        }
    }

    if ($password !== $oldpassword || $password2 !== $oldpassword) {
        if ($password !== $password2) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Password tidak sesuai',
                        'error'
                    )
                  </script>";
            exit();
        }

        $password = password_hash($password2, PASSWORD_DEFAULT);
    }

    if ($email !== $oldemail) {
        $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Email sudah digunakan, silahkan pakai email lain',
                        'error'
                    )
                  </script>";
            exit();
        }
    }

    $query = "UPDATE user SET 
                nama = '$nama',
                username = '$username',
                password = '$password',
                email = '$email',
                level = '$level'
              WHERE iduser = $iduser
            ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}
// Fungsi Edit Data Pengguna Selesai

// Fungsi Edit Profil Pengguna
?>