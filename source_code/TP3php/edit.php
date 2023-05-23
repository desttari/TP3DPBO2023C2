<?php

//memngunakan kode dari 
include('config/db.php');
include('classes/DB.php');
include('classes/Album.php');
include('classes/Genre.php');
include('classes/Artis.php');
include('classes/Lagu.php');
include('classes/Template.php');

//buat objek
$view = new Template('templates/skintambah.html');

$artis = new Artis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$artis->open();
// tampilkan data artis
// $artis->getartisJoin();

$btn = 'Simpan';
$title = 'Ubah';

//ubah
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($artis->updateArtist($id, $_POST, $_FILES) > 0) {
                echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'artis.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal diubah!');
                    document.location.href = 'artis.php';
                </script>";
            }
        }

        $artis->getArtistById($id);
        $row = $artis->getResult();

        $dataUpdate = $row['artis_nama'];

        $tmp_file = $file['file_image']['tmp_name'];
        $artis_foto = $file['file_image']['name'];
        
        $dir = "assets/images/$artis_foto";
        move_uploaded_file($tmp_file, $dir);

        $artis_foto = $data['artis_foto'];
        $artis_nama = $data['artis_nama'];
        $artis_debut = $data['artis_tahun_debut'];
        $genre_id = $data['genre_nama'];
        $lagu_id = $data['lagu_judul'];

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

//ganti data
$view->replace('DATA_LABEL', $title);
$view->write();