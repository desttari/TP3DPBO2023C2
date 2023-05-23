<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Negara.php');
include('classes/Template.php');

$negara = new Negara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$negara->open();

$negara->getNegara();

//tambah data
if (!isset($_GET['id'])) {
 if (isset($_POST['submit'])) {
 if ($negara->addNegara(['negara' => $_POST['nama']]) > 0) {
 echo "<script>
 alert('Data berhasil ditambah!');
 document.location.href = 'negara.php';
 </script>";
 } else {
 echo "<script>
 alert('Data gagal ditambah!');
 document.location.href = 'negara.php';
 </script>";
 }
 }

 $btn = 'Tambah';
 $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

//buat head table untuk skin dan data 
$mainTitle = 'Negara';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Negara</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'negara';

//tampilkan data
while ($gen = $negara->getResult()) {
 $data .= '<tr>
 <th scope="row">' . $no . '</th>
 <td>' . $gen['negara'] . '</td>
 <td style="font-size: 22px;">
 <a href="negara.php?id=' . $gen['id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>
  
 <a href="negara.php?hapus=' . $gen['id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
 </td>
 </tr>';
 $no++;
}

//ubah data
if (isset($_GET['id'])) {
 $id = $_GET['id'];
 if ($id > 0) {
 if (isset($_POST['submit'])) {
 if ($negara->updateNegara($id, ['negara' => $_POST['nama']]) > 0) {
 echo "<script>
 alert('Data berhasil diubah!');
 document.location.href = 'negara.php';
 </script>";
 } else {
 echo "<script>
 alert('Data gagal diubah!');
 document.location.href = 'negara.php';
 </script>";
 }
 }

 $negara->getNegaraById($id);
 $row = $negara->getResult();

 $dataUpdate = $row['negara'];
 $btn = 'Simpan';
 $title = 'Ubah';

 $view->replace('DATA_VAL_UPDATE', $dataUpdate);
 }
}

//hapus data
if (isset($_GET['hapus'])) {
 $id = $_GET['hapus'];
 if ($id > 0) {
 if ($negara->deleteNegara($id) > 0) {
 echo "<script>
 alert('Data berhasil dihapus!');
 document.location.href = 'negara.php';
 </script>";
 } else {
 echo "<script>
 alert('Data gagal dihapus!');
 document.location.href = 'negara.php';
 </script>";
 }
 }
}

$negara->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
