<?php

class Database{

    private static $INSTANCE;
    private $mysqli,
            $HOST = 'localhost',
            $USER = 'root',
            $PASS = '123',
            $DBNAME = 'tutorial_php';

    public function __construct()
    {

        $this->mysqli = new mysqli($this->HOST, $this->USER, $this->PASS, $this->DBNAME);
        if ($this->mysqli == mysqli_connect_error()) {
            echo 'gagal koneksi ke database';
        }
    }

    public static function getInstance()
    {
        if ( !isset(self::$INSTANCE)) {
            self::$INSTANCE = new Database();
        }
        return self::$INSTANCE;
    }
}

?>