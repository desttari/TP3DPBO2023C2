<?php

class Template
{
    var $filename = ''; // Variabel untuk menyimpan nama file template
    var $content = ''; // Variabel untuk menyimpan konten template

    function __construct($filename = '')
    {
        $this->filename = $filename;

        // Membaca konten template dari file dan menyimpannya dalam variabel $content
        $this->content = implode('', @file($filename));
    }

    function clear()
    {
        // Menghapus semua placeholder DATA_XXX dari konten template menggunakan regular expression
        $this->content = preg_replace("/DATA_[A-Z|_|0-9]+/", "", $this->content);
    }

    function write()
    {
        $this->clear();
        // Menampilkan konten template setelah menghapus placeholder
        print $this->content;
    }

    function getContent()
    {
        $this->clear();
        // Mengembalikan konten template setelah menghapus placeholder
        return $this->content;
    }

    function replace($old = '', $new = '')
    {
        if (is_int($new)) {
            // Jika nilai baru berupa integer, maka format sebagai string angka integer
            $value = sprintf("%d", $new);
        } elseif (is_float($new)) {
            // Jika nilai baru berupa float, maka format sebagai string angka float
            $value = sprintf("%f", $new);
        } elseif (is_array($new)) {
            // Jika nilai baru berupa array, maka gabungkan elemen-elemennya menjadi satu string
            $value = '';

            foreach ($new as $item) {
                $value .= $item . ' ';
            }
        } else {
            // Jika nilai baru tidak termasuk dalam tipe data di atas, gunakan nilai baru tersebut tanpa perubahan
            $value = $new;
        }
        // Mengganti placeholder lama dengan nilai baru dalam konten template menggunakan regular expression
        $this->content = preg_replace("/$old/", $value, $this->content);
    }
}
