<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Type.php');
include('classes/Agensi.php');
include('classes/Negara.php');
include('classes/Penyanyi.php');
include('classes/Template.php');


$artis = new Penyanyi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$artis->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $artis->getPenyanyiJoinID($id);
        $row = $artis->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto'] . '" class="img-thumbnail" alt="' . $row['foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Foto</td>
                                    <td>:</td>
                                    <td>' . $row['foto'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tahun Debut</td>
                                    <td>:</td>
                                    <td>' . $row['tahun_debut'] . '</td>
                                </tr>
                                <tr>
                                    <td>Asal Negara</td>
                                    <td>:</td>
                                    <td>' . $row['negara'] . '</td>
                                </tr>
                                <tr>
                                    <td>Asal Agensi</td>
                                    <td>:</td>
                                    <td>' . $row['nama_agensi'] . '</td>
                                </tr>
                                <tr>
                                    <td>Kategori Penyanyi</td>
                                    <td>:</td>
                                    <td>' . $row['type_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="tambah.php?id=' . $row['id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}


if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($artis->deletePenyanyi($id) > 0) {
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

$artis->close();

$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PENYANYI', $data);
$detail->write();
