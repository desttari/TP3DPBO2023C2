<?php

include('config/db.php'); // Mengimpor file db.php yang berisi pengaturan database
include('classes/DB.php'); // Mengimpor file DB.php yang berisi definisi kelas DB
include('classes/Agensi.php'); // Mengimpor file Agensi.php yang berisi definisi kelas Agensi
include('classes/Template.php'); // Mengimpor file Template.php yang berisi definisi kelas Template

$agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME); // Membuat objek Agensi dan menginisialisasi dengan detail koneksi database
$agensi->open(); // Membuka koneksi ke database

// ini_set('display_errors', '1');
// error_reporting(E_ALL);

// echo basename($_SERVER['PHP_SELF']);

$agensi->getAgensi(); // Mengambil data agensi dari database

//tambah data
if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($agensi->addAgensi(['nama_agensi' => $_POST['nama']]) > 0) {
            echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'agensi.php';
            </script>";
        } else {
            echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'agensi.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html'); // Membuat objek Template dan menginisialisasi dengan file template

$mainTitle = 'Agensi Musik';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Agensi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'agensi';

//tampilkan data
while ($gen = $agensi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $gen['nama_agensi'] . '</td>
    <td style="font-size: 22px;">
    <a href="agensi.php?id=' . $gen['id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>
  
    <a href="agensi.php?hapus=' . $gen['id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
    </td>
    </tr>';
    $no++;
}

//update data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($agensi->updateAgensi($id, ['nama_agensi' => $_POST['nama']]) > 0) {

                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'agensi.php';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'agensi.php';
                </script>";
            }
        }

        $agensi->getAgensiById($id);
        $row = $agensi->getResult();

        $dataUpdate = $row['nama_agensi'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

//hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($agensi->deleteAgensi($id) > 0) {
            echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'agensi.php';
            </script>";
        } else {
            echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'agensi.php';
            </script>";
        }
    }
}

$agensi->close(); // Menutup koneksi ke database

$view->replace('DATA_MAIN_TITLE', $mainTitle); // Mengganti placeholder DATA_MAIN_TITLE dengan nilai variabel $mainTitle pada template
$view->replace('DATA_TABEL_HEADER', $header); // Mengganti placeholder DATA_TABEL_HEADER dengan nilai variabel $header pada template
$view->replace('DATA_TITLE', $title); // Mengganti placeholder DATA_TITLE dengan nilai variabel $title pada template
$view->replace('DATA_BUTTON', $btn); // Mengganti placeholder DATA_BUTTON dengan nilai variabel $btn pada template
$view->replace('DATA_FORM_LABEL', $formLabel); // Mengganti placeholder DATA_FORM_LABEL dengan nilai variabel $formLabel pada template
$view->replace('DATA_TABEL', $data); // Mengganti placeholder DATA_TABEL dengan nilai variabel $data pada template
$view->write(); // Menampilkan hasil render template ke layar
