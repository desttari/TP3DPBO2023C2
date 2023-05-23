<?php

    class Agensi extends DB
        {
            function getAgensi()
            {
                // Memilih semua data dari tabel agensi
                $query = "SELECT * FROM agensi";
                return $this->execute($query);
            }

            function getAgensiById($id)
            {
                // Memilih data agensi berdasarkan ID yang diberikan
                $query = "SELECT * FROM agensi WHERE id=$id";
                return $this->execute($query);
            }

            function addAgensi($data)
            {
                $nama_agensi = $data['nama_agensi'];
                // Menambahkan data agensi baru ke dalam tabel agensi
                $query = "INSERT INTO agensi (nama_agensi) VALUES ('$nama_agensi')";
                return $this->executeAffected($query);
            }

            function updateAgensi($id, $data)
            {
                $nama_agensi = $data['nama_agensi'];
                // Mengupdate data agensi berdasarkan ID yang diberikan
                $query = "UPDATE agensi SET nama_agensi='$nama_agensi' WHERE id=$id";
                return $this->executeAffected($query);
            }

            function deleteAgensi($id)
            {
                // Menghapus data agensi berdasarkan ID yang diberikan
                $query = "DELETE FROM agensi WHERE id=$id";
                return $this->executeAffected($query);
            }
        }
