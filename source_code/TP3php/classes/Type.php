<?php

class Type extends DB
{
    function getType()
    {
        $query = "SELECT * FROM type"; // Query untuk mengambil semua data dari tabel type
        return $this->execute($query); // Menggunakan metode execute dari kelas DB untuk menjalankan query
    }

    function getTypeById($id)
    {
        $query = "SELECT * FROM type WHERE id=$id"; // Query untuk mengambil data type berdasarkan ID
        return $this->execute($query); // Menggunakan metode execute dari kelas DB untuk menjalankan query
    }

    function addType($data)
    {
        $type_nama = $data['type_nama']; // Mengambil nilai type_nama dari data yang diberikan
        $query = "INSERT INTO type (type_nama) VALUES ('$type_nama')"; // Query untuk menambahkan data type baru ke dalam tabel
        return $this->executeAffected($query); // Menggunakan metode executeAffected dari kelas DB untuk menjalankan query dan mengembalikan jumlah baris yang terpengaruh
    }

    function updateType($id, $data)
    {
        $type_nama = $data['type_nama']; // Mengambil nilai type_nama dari data yang diberikan
        $query = "UPDATE type SET type_nama='$type_nama' WHERE id=$id"; // Query untuk memperbarui data type berdasarkan ID
        return $this->executeAffected($query); // Menggunakan metode executeAffected dari kelas DB untuk menjalankan query dan mengembalikan jumlah baris yang terpengaruh
    }

    function deleteType($id)
    {
        $query = "DELETE FROM type WHERE id=$id"; // Query untuk menghapus data type berdasarkan ID
        return $this->executeAffected($query); // Menggunakan metode executeAffected dari kelas DB untuk menjalankan query dan mengembalikan jumlah baris yang terpengaruh
    }
}
