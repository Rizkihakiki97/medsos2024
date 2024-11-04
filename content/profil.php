<?php
//  menampilan data user berdasarkan id user 
$id_user = $_SESSION['ID'];
$queryUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id ='$id_user'");
$rowUser = mysqli_fetch_assoc($queryUser);

$queryTweet = mysqli_query($koneksi, "SELECT * FROM tweet WHERE id ='$id_user'");
$rowTweet = mysqli_fetch_assoc($queryTweet);


if (isset($_POST['simpan'])) {
    $nama_lengkap   = $_POST['nama_lengkap'];
    $nama_pengguna  = $_POST['nama_pengguna'];
    $email          = $_POST['email'];



    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];

        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        //Jika extensi logo tidak memenuhi syarat array extensi
        if (!in_array($extFoto, $ext)) {
            echo "Gunakan Foto Lain";
            die;
        } else {

            // pindahkan  gambar dari tmp folder ke folder yang sudah kita buat
            // unlink() : mendelete file
            unlink('upload/' . $rowUser['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);  //memindahkan foto ke folder upload

            $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', nama_pengguna='$nama_pengguna', foto='$nama_foto', email='$email' WHERE id = '$id_user'");
        }
    } else {
        $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap ='$nama_lengkap', nama_pengguna ='$nama_pengguna', email='$email' WHERE id='$id_user'");
    }
    header("location:?pg=profil&ubah=berhasil");
}

if (isset($_POST['edit_cover'])) {

    if (!empty($_FILES['cover']['name'])) {
        $nama_cover = $_FILES['cover']['name'];

        $ext = array('png', 'jpg', 'jpeg');
        $extcover = pathinfo($nama_cover, PATHINFO_EXTENSION);

        //Jika extensi logo tidak memenuhi syarat array extensi
        if (!in_array($extcover, $ext)) {
            echo "Gunakan cover Lain";
            die;
        } else {

            // pindahkan  gambar dari tmp folder ke folder yang sudah kita buat
            // unlink() : mendelete file
            unlink('upload/' . $rowTweet['cover']);
            move_uploaded_file($_FILES['cover']['tmp_name'], 'upload/' . $nama_cover);  //memindahkan cover ke folder upload

            $update = mysqli_query($koneksi, "UPDATE user SET  cover='$nama_cover' WHERE id = '$id_user'");
        }
    }
    header("location:?pg=profil&ubah=berhasil");
}


?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="cover">
                <img src="<?php echo !empty($rowUser['cover']) ? 'upload/' . $rowUser['cover'] : 'https://placehold.co/800x200' ?>"
                    alt="" height="330" width="100%">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="profile-header mt-5">
                <img width="100"
                    src="<?php echo !empty($rowUser['foto']) ? 'upload/' . $rowUser['foto'] : 'https://placehold.co/100' ?>"
                    alt="" class="ms-3 mt-5 rounded-circle border border-2 border-dark">
                <h2><?php echo $rowUser['nama_lengkap'] ?></h2>
                <p>@<?php echo $rowUser['nama_pengguna'] ?></p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                    leap into electronic typesetting, remaining essentially unchanged.</p>
            </div>
        </div>
        <div class="col-sm-6 mt-5" align="right">
            <a href="#" style="border-radius: 20px;" class="btn btn-outline-primary mt-4 me-4" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Edit
                Profile</a>
            <a href="#" style="border-radius: 20px;" class="btn btn-outline-primary mt-4 me-4" data-bs-toggle="modal"
                data-bs-target="#editCover">Edit Cover</a>
        </div>
        <div class="col-sm-12 mt-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tweet</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Tweet &
                        Balasan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                        type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Like</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-3" id="home-tab-pane" role="tabpanel"
                    aria-labelledby="home-tab" tabindex="0">
                    <?php include 'tweet.php'; ?>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab"
                    tabindex="0">...</div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" value="<?php echo $rowUser['nama_lengkap'] ?>" class="form-control"
                                placeholder="Nama" name="nama_lengkap">
                        </div>
                        <div class="mb-3">
                            <input value="<?php echo $rowUser['nama_pengguna'] ?>" type="text" class="form-control"
                                placeholder="Username" name="nama_pengguna">
                        </div>
                        <div class="mb-3">
                            <input value="<?php echo $rowUser['email'] ?>" type="email" class="form-control"
                                placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <input type="file" name="foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCover" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Cover</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="file" name="cover">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="edit_cover">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>