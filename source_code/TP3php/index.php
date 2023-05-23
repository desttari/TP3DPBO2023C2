<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Type.php');
include('classes/Agensi.php');
include('classes/Negara.php');
include('classes/Penyanyi.php');
include('classes/Template.php');

$listPenyanyi = new Penyanyi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$listPenyanyi->open();

// Proses pencarian
if (isset($_POST['btn-cari'])) {
    $searchQuery = $_POST['cari'];
    $listPenyanyi->searchPenyanyi($searchQuery);
} else {
    $listPenyanyi->getPenyanyiJoin();
    
}

// Proses pengurutan
if (isset($_GET['sort'])) {
    $sortBy = $_GET['sort'];
    $listPenyanyi->getPenyanyiSorted($sortBy);
}

$data = '';

//tampilkan data setelah di proses
while ($row = $listPenyanyi->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center ">' .
        '<div class="card pt-4 px-2 penyanyi-thumbnail">
        <a href="detail.php?id=' . $row['id'] . '">
        <div class="row justify-content-center">
        <img src="assets/images/' . $row['foto'] . '" class="card-img-top" alt="' . $row['foto'] . '">
        </div>
        <div class="card-body text-light text-center text-decoration-none">
        <p class="card-text text-decoration-none penyanyi-nama my-0">' . $row['nama'] . '</p>
        <p class="card-text type-nama">' . $row['type_nama'] . '</p>
        <p class="card-text agensi-nama my-0">' . $row['nama_agensi'] . '</p>
        <p class="card-text negara-nama my-0">' . $row['negara'] . '</p>
        </div>
        </a>
        </div> 
        </div>';
}

$listPenyanyi->close();
//error handling jika data yg diproses tidak ada
if (empty($data)) {
    $data = '<p>Data Tidak Ditemukan</p>';
}
$home = new Template('templates/skin.html');
$home->replace('DATA_PENYANYI', $data);
$home->write();
