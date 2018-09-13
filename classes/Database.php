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

    public function insert($table, $fields = array())
    {
        $column = implode(", ", array_keys($fields));
        $valueArrays = array();
        $i = 0;

        foreach ($fields as $key => $values) {
            if ( is_int($values) ) {
                $valueArrays[$i] = $values;
            }else{
                $valueArrays[$i] = "'" . $values . "'";
            }
            $i++;
        }

        $values = implode(", ", $valueArrays);
        
        $sql = "INSERT INTO $table ($column) VALUES ($values)";
        
        if($this->mysqli->query($sql)) return true;
        else return false;
    }
}

?>