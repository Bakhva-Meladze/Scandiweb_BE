<?php

namespace model;

class Book extends Products
{
    protected static $type_name = "Book";

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data = array())
    {
        if (isset($data->weight)) {
            $type_id = $this->get_type_id();
            $data->extension = $data->weight . "kg";
            $data->type_id = $type_id;
            $this->insert($data);
        }
    }

    public function validate($request)
    {
        $errors = Products::validate($request);

        if (isset($request->weight) && $request->weight === "") {
            $errors['weight'] = "weight is empty!";
        }

        return $errors;
    }
}