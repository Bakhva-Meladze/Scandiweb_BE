<?php

namespace model;

class DVD extends Products
{
    protected static $type_name = "DVD";

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data = [])
    {
        if(isset($data->size)) {
            $type_id = $this->get_type_id();
            $data->extension = $data->size . "MB";
            $data->type_id = $type_id;
            $this->insert($data);
        }
    }
    public function validate($request) {
        $errors = Products::validate($request);

        if (isset($request->size) && $request->size ==="") {
            $errors['size'] = "size is empty!";
        }

        return $errors;

    }
}