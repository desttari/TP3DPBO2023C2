# TP3DPBO2023C2
TP3 2100506

## Janji
Saya Destira Lestari Saraswati NIM 2100506 mengerjakan soal TP3 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Deskripsi
Program ini merupakan aplikasi manajemen data penyanyi favorit yang dibangun menggunakan bahasa pemrograman PHP. Program ini menggunakan file-file yang mencakup pengaturan database (db.php), definisi kelas-kelas untuk mengelola entitas seperti:
 - agensi (Agensi.php)
 - jenis musik (Type.php)
 - album (Album.php)
 - genre musik (Genre.php)
 - artis (Artis.php)
 - lagu (Lagu.php)
 - Serta template/skin untuk mengatur tampilan halaman
 - file.php lainnya untuk mengatur tugas CRUD dan database. 
 
### Fitur-fitur
fitur program ini meliputi `operasi CRUD (Create, Read, Update, Delete)` untuk mengelola data-data tersebut, termasuk kemampuan untuk menambah, mengubah, dan menghapus data agensi musik, jenis musik, album, genre musik, artis, dan lagu. Program ini juga memanfaatkan `template HTML` untuk menyusun tampilan halaman yang lebih terstruktur dan mudah diatur. Serta terdapat fitur `Cari` untuk mencaridaftar penyanyi dengan keyword yang dimasukkan dan fitur `SortBy` untuk mengurutkan daftar penyanyi berddasarkan Nama Penyanyi atau Nama Agensi atau Asal Negara atau Genre Penyanyi.

### Design Database
![design_db](https://github.com/desttari/TP3DPBO2023C2/assets/100773981/9e46cc67-5b23-43ee-a991-3e138ffcd502)

* Deskripsi
Database `db_artis` ini merupakan sebuah sistem yang menyimpan informasi tentang artis atau penyanyi beserta atribut-atribut yang terkait. Database ini dirancang untuk membantu dalam manajemen data penyanyi favorit terkait industri musik, terutama fokus pada informasi artis seperti nama, tahun debut, agensi yang mewakili, negara asal, dan foto.

* Kegunaan
Berikut adalah penjelasan singkat tentang setiap tabel dan kegunaannya dalam database "db_artis":

- `Tabel agensi`: Tabel ini digunakan untuk menyimpan informasi tentang agensi atau perusahaan yang mewakili artis. Setiap agensi memiliki ID unik dan nama agensi.

- `Tabel negara`: Tabel ini berisi informasi tentang negara asal artis. Setiap negara memiliki ID unik dan nama negara.

- `Tabel penyanyi`: Tabel ini adalah tabel utama yang menyimpan informasi tentang artis atau penyanyi. Di sini, Anda dapat menemukan detail tentang nama artis, tahun debut, jenis artis, agensi yang mewakili, negara asal, dan juga foto artis.

- `Tabel type`: Tabel ini berfungsi untuk menyimpan daftar jenis artis atau kategori di mana artis tersebut dapat digolongkan. Setiap jenis memiliki ID unik dan nama jenis.

* Struktur dan Relasi Tabel
Database `db_artis` memiliki struktur tabel yang terorganisir dengan baik, dengan setiap tabel memiliki kolom-kolom yang relevan untuk menyimpan data yang diperlukan. Selain itu, terdapat kunci-kunci asing (foreign keys) yang menghubungkan tabel penyanyi dengan tabel agensi, negara, dan type, sehingga tercipta hubungan yang konsisten antara entitas-entitas yang berbeda dalam database.

### Video Preview


### Screenshots

![Screenshot (52)](https://github.com/desttari/TP3DPBO2023C2/assets/100773981/0166918e-b708-4fe1-b63e-d7c66fd53f86)
![Screenshot (53)](https://github.com/desttari/TP3DPBO2023C2/assets/100773981/f6ca0528-237b-4169-b3fd-f1aed052f0bb)
![Screenshot (54)](https://github.com/desttari/TP3DPBO2023C2/assets/100773981/ad1917be-8a58-4c27-abf8-22ebc08ff8aa)
![Screenshot (55)](https://github.com/desttari/TP3DPBO2023C2/assets/100773981/ad8ccf21-8578-40c6-944e-03c066b859d8)
![Screenshot (49)](https://github.com/desttari/TP3DPBO2023C2/assets/100773981/2062b987-27e5-45a4-9659-fd3ec1fcdb14)
![Screenshot (50)](https://github.com/desttari/TP3DPBO2023C2/assets/100773981/be521a93-0c3e-4671-ba4d-f0870b083cdd)
![Screenshot (51)](https://github.com/desttari/TP3DPBO2023C2/assets/100773981/796687b5-051a-4aa9-92de-c6f1a4b198a0)
