<?php

class DB
{
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $result;

    function __construct($hostname, $username, $password, $dbname)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    function open()
    {
        // Membuka koneksi ke database dengan menggunakan parameter yang diberikan
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
    }

    function execute($query)
    {
        // Mengeksekusi query pada database
        $this->result = mysqli_query($this->conn, $query);

        if (!$this->result) {
            // Menangani kegagalan eksekusi query
            die('Query execution failed: ' . mysqli_error($this->conn));
        }
    }


    function getResult()
    {
        // Mengambil hasil eksekusi query dalam bentuk array
        return mysqli_fetch_array($this->result);
    }

    function executeAffected($query = "")
    {
        // Mengeksekusi query yang mempengaruhi jumlah baris data
        mysqli_query($this->conn, $query);
        return mysqli_affected_rows($this->conn);
    }

    function close()
    {
        // Menutup koneksi ke database
        mysqli_close($this->conn);
    }
}
