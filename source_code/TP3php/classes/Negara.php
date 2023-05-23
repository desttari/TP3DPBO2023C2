<?php

class Negara extends DB
{
    function getNegara()
    {
        // Mengambil semua data dari tabel negara
        $query = "SELECT * FROM negara";
        return $this->execute($query);
    }

    function getNegaraById($id)
    {
        // Mengambil data negara berdasarkan ID yang diberikan
        $query = "SELECT * FROM negara WHERE id=$id";
        return $this->execute($query);
    }

    function addNegara($data)
    {
        $negara = $data['negara'];
        // Menambahkan data negara baru ke dalam tabel negara
        $query = "INSERT INTO negara (negara) VALUES ('$negara')";
        return $this->executeAffected($query);
    }

    function updateNegara($id, $data)
    {
        $negara = $data['negara'];
        // Mengupdate data negara berdasarkan ID yang diberikan
        $query = "UPDATE negara SET negara='$negara' WHERE id=$id";
        return $this->executeAffected($query);
    }

    function deleteNegara($id)
    {
        // Menghapus data negara berdasarkan ID yang diberikan
        $query = "DELETE FROM negara WHERE id=$id";
        return $this->executeAffected($query);
    }
}
