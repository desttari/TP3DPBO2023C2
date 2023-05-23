<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Type.php');
include('classes/Agensi.php');
include('classes/Negara.php');
include('classes/Penyanyi.php');
include('classes/Template.php');

//buat objek
$view = new Template('templates/skintambah.html');

$penyanyi = new Penyanyi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$penyanyi->open();

$type = new Type($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$type->open();
$type->getType();
$optionsType = null;

$agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$agensi->open();
$agensi->getAgensi();
$optionsAgensi = null;

$negara = new Negara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$negara->open();
$negara->getNegara();
$optionsNegara = null;

$nama_update = '';
$tahun_debut_update = '';
$foto_update = '';

//tambah
if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($penyanyi->addPenyanyi($_POST,$_FILES) > 0) {
            echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'tambah.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';

    while ($row = $type->getResult()) {
        $optionsType .= "<option value=". $row['id']. ">" . $row['type_nama'] . "</option>";
    }

    while ($row = $agensi->getResult()) {
        $optionsAgensi .= "<option value=". $row['id']. ">" . $row['nama_agensi'] . "</option>";
    }

    while ($row = $negara->getResult()) {
        $optionsNegara .= "<option value=". $row['id']. ">" . $row['negara'] . "</option>";
    }
}

//ubah
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {

        if (isset($_POST['submit'])) {

            if ($penyanyi->updatePenyanyi($id, $_POST, $_FILES) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
                </script>";
            }
        }

        $btn = 'Simpan';
        $title = 'Ubah';

        $penyanyi->getPenyanyiById($id);
        $row = $penyanyi->getResult();

        $nama_update = $row['nama'];
        $foto_update = $row['foto'];
        $tahun_debut_update = $row['tahun_debut'];
        $type_update = $row['id_type'];
        $agensi_update = $row['id_agensi'];
        $negara_update = $row['id_negara'];

        while ($row = $type->getResult()) {
            $selected = ($row['id'] == $type_update) ? 'selected' : '';
            $optionsType .= "<option value=". $row['id']. " " . $selected . ">" . $row['type_nama'] . "</option>";
        }

        while ($row = $agensi->getResult()) {
            $selected = ($row['id'] == $agensi_update) ? 'selected' : '';
            $optionsAgensi .= "<option value=". $row['id']. " " . $selected . ">" . $row['nama_agensi'] . "</option>";
        }

        while ($row = $negara->getResult()) {
            $selected = ($row['id'] == $negara_update) ? 'selected' : '';
            $optionsNegara .= "<option value=". $row['id']. " " . $selected . ">" . $row['negara'] . "</option>";
        }
    }
}

//hapus

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($penyanyi->deletePenyanyi($id) > 0) {
            echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'index.php';
            </script>";
        }
    }
}

$type->close();
$agensi->close();
$negara->close();
$penyanyi->close();

$view->replace("NAME_VAL_UPDATE", $nama_update);
$view->replace("DEBUT_VAL_UPDATE", $tahun_debut_update);
$view->replace("IMAGE_VAL_UPDATE", $foto_update);

$view->replace("OPTIONS_TYPE", $optionsType);
$view->replace("OPTIONS_AGENSI", $optionsAgensi);
$view->replace("OPTIONS_NEGARA", $optionsNegara);
$view->replace("DATA_TITLE", $title);
$view->replace("DATA_BUTTON", $btn);
$view->write();
