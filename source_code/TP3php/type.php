<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Type.php');
include('classes/Template.php');

$type = new Type($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$type->open();

$type->getType();

if (!isset($_GET['id'])) {
 if (isset($_POST['submit'])) {
 if ($type->addType(['type_nama' => $_POST['nama']]) > 0) {
 echo "<script>
 alert('Data berhasil ditambah!');
 document.location.href = 'type.php';
 </script>";
 } else {
 echo "<script>
 alert('Data gagal ditambah!');
 document.location.href = 'type.php';
 </script>";
 }
 }

 $btn = 'Tambah';
 $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Kategori Penyanyi';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Type</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'type';

while ($gen = $type->getResult()) {
 $data .= '<tr>
 <th scope="row">' . $no . '</th>
 <td>' . $gen['type_nama'] . '</td>
 <td style="font-size: 22px;">
 <a href="type.php?id=' . $gen['id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>
  
 <a href="type.php?hapus=' . $gen['id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
 </td>
 </tr>';
 $no++;
}

if (isset($_GET['id'])) {
 $id = $_GET['id'];
 if ($id > 0) {
 if (isset($_POST['submit'])) {
 if ($type->updateType($id, ['type_nama' => $_POST['nama']]) > 0) {
 echo "<script>
 alert('Data berhasil diubah!');
 document.location.href = 'type.php';
 </script>";
 } else {
 echo "<script>
 alert('Data gagal diubah!');
 document.location.href = 'type.php';
 </script>";
 }
 }

 $type->getTypeById($id);
 $row = $type->getResult();

 $dataUpdate = $row['type_nama'];
 $btn = 'Simpan';
 $title = 'Ubah';

 $view->replace('DATA_VAL_UPDATE', $dataUpdate);
 }
}

if (isset($_GET['hapus'])) {
 $id = $_GET['hapus'];
 if ($id > 0) {
 if ($type->deleteType($id) > 0) {
 echo "<script>
 alert('Data berhasil dihapus!');
 document.location.href = 'type.php';
 </script>";
 } else {
 echo "<script>
 alert('Data gagal dihapus!');
 document.location.href = 'type.php';
 </script>";
 }
 }
}

$type->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
