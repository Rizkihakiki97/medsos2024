<?php

include 'koneksi.php';
// jika button daftar di klik atau di tekan
if (isset($_POST['daftar'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_pengguna = $_POST['nama_pengguna'];

    // masukkan data ke dalam tbl user kolom kolom tbl user () dan nilainya di ambil dari inputan sesuai dengan urutan kolomnya
    mysqli_query($koneksi, "INSERT INTO user (email, password, nama_lengkap, nama_pengguna) VALUE ('$email','$password','$nama_lengkap','$nama_pengguna')");

    // melempar ke halaman login
    header("location:login.php?register=berhasil");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 mx-auto mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>Medsos X - Rizky Hakiki</h5>
                                <!-- <p>Silahkan masuk dengan akun anda</p> -->
                            </div>
                            <form action="" method="post">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Email
                                    </label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Masukkan email anda">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Password
                                    </label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Nama Lengkap
                                    </label>
                                    <input type="text" class="form-control" name="nama_lengkap"
                                        placeholder="Masukkan Nama Lengkap anda">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Nama Pengguna
                                    </label>
                                    <input type="text" class="form-control" name="nama-pengguna"
                                        placeholder="Masukkan Nama Pengguna anda">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <p>Sudah Punya Akun?</p><a href="" class="text-secondary">Buat Akun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>