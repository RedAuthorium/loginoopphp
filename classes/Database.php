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
                $valueArrays[$i] = $this->escape($values);
            }else{
                $valueArrays[$i] = "'" . $this->escape($values) . "'";
            }
            $i++;
        }

        $values = implode(", ", $valueArrays);
        
        $sql = "INSERT INTO $table ($column) VALUES ($values)";
        return $this->run_query($sql, 'You have an issue when input data');
    }

    public function update($table, $fields, $id)
    {
        $valueArrays = array();
        $i = 0;

        foreach ($fields as $key => $values) {
            if ( is_int($values) ) {
                $valueArrays[$i] = $key . "=" . $this->escape($values);
            }else{
                $valueArrays[$i] = $key . "='" . $this->escape($values) . "'";
            }
            $i++;
        }

        $values = implode(", ", $valueArrays);
        
        $sql = "UPDATE $table SET $values WHERE id = $id";
        return $this->run_query($sql, 'You have an issue when update data');
    }

    public function get_info($table, $column = '', $value = '')
    {
        if( !is_int($value)){
            $value = "'" . $value . "'";
        }

        if( $column != ''){
            $query = "SELECT * FROM $table WHERE $column = $value";
            $result = $this->mysqli->query($query);

            while ($row = $result->fetch_assoc()) {
                return $row;
            }

        }else {
            $query = "SELECT * FROM $table";
            $result = $this->mysqli->query($query);
            
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
         
            return $results;
        }
    }

    public function run_query($query, $message)
    {
        if($this->mysqli->query($query)) return true;
        else die($message);
    }

    public function escape($name)
    {
        return $this->mysqli->real_escape_string($name);
    }
}

?>