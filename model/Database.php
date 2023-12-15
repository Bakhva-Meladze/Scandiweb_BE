<?php

namespace model;

class Database
{
    protected static $table_name;
    protected static $table_columns = array();
    public $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'scandiweb';

    function __construct()
    {
        $this->connection = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->database);
    }

    public function all()
    {
        $query = "select * from " . static::$table_name;
        $result = $this->query($query);

        return ($result);
    }

    public function query($query)
    {
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            var_dump(mysqli_error($this->connection));
        }

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return ($data);
    }

    public function delete($id)
    {
        $delete = array($id);

        foreach ($delete as $id) {
            $sql = "DELETE FROM products WHERE id='" . $id . "'";

            mysqli_query($this->connection, $sql);
        }
    }

    public function insert($data)
    {
        $columns1 = '';
        $values = '';

        foreach ($data as $name => $value) {
            if (in_array($name, static::$table_columns)) {
                $columns1 .= $name . ",";
                $values .= '"' . $value . '" ' . ',';
            }
        }

        $tall = rtrim($values, ',');
        $colum = rtrim($columns1, ',');
        $query = "INSERT into  " . static::$table_name . " (" . $colum . " ) " .
            "Values ( " . $tall . " )";

        mysqli_query($this->connection, $query);
    }

    public function getProductBySku($sku)
    {
        $query = "select * from products WHERE SKU ='" . $sku . "'";
        $result = $this->query($query);

        return $result;
    }
}

