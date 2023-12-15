<?php

namespace model;

class Products extends Database
{
    protected static $table_name = 'products';
    protected static $table_columns = array('name', 'sku', 'price', 'type_id', 'extension');
    protected static $type_name;

    public function __construct()
    {
        parent::__construct();
    }

    public function validate($request)
    {
        $errors = [];

        if (isset($request->sku) && $request->sku === "") {
            $errors['sku'] = "sku is empty";
        } else if ($this->getProductBySku($request->sku)) {
            $errors['sku'] = "Sku is duplicated";
        }

        if (isset($request->name) && $request->name === "") {
            $errors['name'] = "name is empty";
        }
        if (isset($request->price) && $request->price === "") {
            $errors['price'] = "price is empty";
        }

        return $errors;
    }

    public function get_type_id()
    {
        $result = $this->query('select id from types where name="' . static::$type_name . '"');

        return $result[0]['id'];
    }
}