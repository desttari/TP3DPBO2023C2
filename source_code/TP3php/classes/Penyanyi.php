<?php

class Penyanyi extends DB
{
    function getPenyanyi()
    {
        // Mengambil semua data dari tabel penyanyi
        $query = "SELECT * FROM penyanyi";
        return $this->execute($query);
    }

    function getPenyanyiById($id)
    {
        // Mengambil data penyanyi berdasarkan ID yang diberikan
        $query = "SELECT * FROM penyanyi WHERE id=$id";
        return $this->execute($query);
    }

    function getPenyanyiJoinID($id)
    {
        // Mengambil data penyanyi dengan melakukan join pada tabel negara, agensi, dan type berdasarkan ID yang diberikan
        $query = "SELECT penyanyi.*, negara.negara, agensi.nama_agensi, type.type_nama FROM penyanyi
        JOIN negara ON penyanyi.id_negara = negara.id
        JOIN agensi ON penyanyi.id_agensi = agensi.id
        JOIN type ON penyanyi.id_type = type.id
        WHERE penyanyi.id=$id";
        return $this->execute($query);
    }

    function getPenyanyiJoin()
    {
        // Mengambil data penyanyi dengan melakukan join pada tabel negara, agensi, dan type
        $query = "SELECT penyanyi.*, type.type_nama, agensi.nama_agensi, negara.negara FROM penyanyi
        JOIN type ON penyanyi.id_type = type.id
        JOIN agensi ON penyanyi.id_agensi = agensi.id
        JOIN negara ON penyanyi.id_negara = negara.id";
        return $this->execute($query);
    }

    function getPenyanyiSorted($sortBy)
    {
        // Validate the sortBy parameter to prevent SQL injection
        $allowedSortColumns = ['nama', 'tahun_debut', 'type_nama', 'nama_agensi', 'negara'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            throw new Exception("Invalid sort column.");
        }

        // Mengambil data penyanyi dengan melakukan join pada tabel negara, agensi, dan type, kemudian diurutkan berdasarkan kolom yang ditentukan
        $query = "SELECT penyanyi.*, type.type_nama, agensi.nama_agensi, negara.negara FROM penyanyi
        JOIN type ON penyanyi.id_type = type.id
        JOIN agensi ON penyanyi.id_agensi = agensi.id
        JOIN negara ON penyanyi.id_negara = negara.id
        ORDER BY $sortBy";
        
        return $this->execute($query);
    }

    function addPenyanyi($data, $file)
    {
        // Mengambil informasi dari file gambar yang diunggah
        $tmp_file = $file['file_image']['tmp_name'];
        $foto = $file['file_image']['name'];
        
        // Menentukan direktori penyimpanan gambar
        $dir = "assets/images/$foto";
        move_uploaded_file($tmp_file, $dir);

        // Mengambil nilai-nilai dari array $data
        $nama = $data['nama'];
        $tahun_debut = $data['tahun_debut'];
        $id_type = $data['id_type'];
        $id_agensi = $data['id_agensi'];
        $id_negara = $data['id_negara'];

        // Menambahkan data penyanyi baru ke dalam tabel penyanyi
        $query = "INSERT INTO penyanyi (nama, tahun_debut, id_type, id_agensi, id_negara, foto) VALUES ('$nama', '$tahun_debut', '$id_type', '$id_agensi', '$id_negara', '$foto')";
        return $this->executeAffected($query);
    }

    function updatePenyanyi($id, $data, $file)
    {
        // Mengecek apakah ada file gambar baru yang diunggah
        if (!empty($file['file_image']['name'])) {
            // Mengambil path dan nama file sementara dari gambar yang diunggah
            $tmp_file = $file['file_image']['tmp_name'];
            $foto = $file['file_image']['name'];

            // Menentukan path tujuan untuk gambar yang diunggah
            $dir = "assets/images/$foto";

            // Memindahkan file gambar yang diunggah ke path tujuan
            move_uploaded_file($tmp_file, $dir);
        } else {
            // Tidak ada gambar baru yang diunggah, maka gunakan nilai gambar yang ada
            $foto = $data['file_image'];
        }

        // Mengambil nilai-nilai dari array $data
        $nama = $data['nama'];
        $tahun_debut = $data['tahun_debut'];
        $id_type = $data['id_type'];
        $id_agensi = $data['id_agensi'];
        $id_negara = $data['id_negara'];

        // Membuat query SQL untuk mengupdate data penyanyi berdasarkan ID yang diberikan
        $query = "UPDATE penyanyi SET nama='$nama', tahun_debut='$tahun_debut', id_type='$id_type', id_agensi='$id_agensi', id_negara='$id_negara', foto='$foto' WHERE id=$id";
        
        // Mengeksekusi query menggunakan metode executeAffected
        return $this->executeAffected($query);
    }

    function searchPenyanyi($keyword)
    {
        // Mencari data penyanyi dengan melakukan join pada tabel negara, agensi, dan type berdasarkan kata kunci yang diberikan
        $query = "SELECT penyanyi.*, negara.negara, agensi.nama_agensi, type.type_nama FROM penyanyi
        JOIN negara ON penyanyi.id_negara = negara.id
        JOIN agensi ON penyanyi.id_agensi = agensi.id
        JOIN type ON penyanyi.id_type = type.id
        WHERE penyanyi.nama LIKE '%$keyword%' OR negara.negara LIKE '%$keyword%' OR agensi.nama_agensi LIKE '%$keyword%' OR type.type_nama LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function deletePenyanyi($id)
    {
        // Membuat query SQL untuk menghapus data penyanyi berdasarkan ID yang diberikan
        $query = "DELETE FROM penyanyi WHERE id=$id";

        // Mengeksekusi query menggunakan metode executeAffected
        return $this->executeAffected($query);
    }
}
