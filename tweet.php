<?php
if (isset($_POST['simpan'])) {
    $nama_lengkap   = $_POST['nama_lengkap'];
    $nama_pengguna  = $_POST['nama_pengguna'];
    $email          = $_POST['email'];



    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];

        // $ext = array('png', 'jpg', 'jpeg');
        // $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        //Jika extensi logo tidak memenuhi syarat array extensi
        // if (!in_array($extFoto, $ext)) {
        //     echo "Gunakan Foto Lain";
        //     die;
        // } else {

        // pindahkan  gambar dari tmp folder ke folder yang sudah kita buat
        // unlink() : mendelete file
        unlink('upload/' . $rowUser['foto']);
        move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);  //memindahkan foto ke folder upload

        $insert = mysqli_query($koneksi, "INSERT INTO tweet (content, id_user) VALUES ('$content','$id_user','$nama_foto)'");
    }
} else {
    $insert = mysqli_query($koneksi, "INSERT INTO tweet (content, id_user) VALUES ('$content','$id_user')");
    header("location:?pg=profil&ubah=berhasil");
}
$queryPosting = mysqli_query($koneksi, "SELECT * FROM tweet WHERE id_user ='$id_user'");
?>

<div class="row">
    <div class="col-sm-12" align="right">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
            data-bs-target="#tweet">Tweet</button>
    </div>

    <div class=" col-sm-12 mt-3">
        <?php while ($rowTweet = mysqli_fetch_assoc($queryPosting)) : ?>
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="upload/<?php echo !empty($rowUser['foto']) ? $rowUser['foto'] : '' ?>" alt="" width="100">
                </div>
                <div class="flex-grow-1 ms-3">
                    <?php if (!empty($rowPosting['foto'])): ?>
                        <img src="upload/<?php echo !empty($rowUser['foto']) ? $rowUser['foto'] : '' ?>" alt="" width="100%">
                    <?php endif ?>
                    <?php echo $rowPosting['content'] ?>
                </div>
            </div>
        <?php endwhile ?>
        <hr>
    </div>
</div>

<div class="modal fade" id="tweet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <textarea name="content" id="summernote" class="form-control"
                            placeholder="Apa yang sedang hangat dibicarkan"></textarea>
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