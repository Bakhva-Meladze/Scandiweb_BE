<?php

namespace model;

class Furniture extends Products
{
    protected static $type_name = "Furniture";

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data = array())
    {
        if (isset($data->height) && isset($data->width) && isset($data->length)) {
            $type_id = $this->get_type_id();
            $data->extension = $data->height . 'X' . $data->width . 'X' . $data->length;
            $data->type_id = $type_id;
            $this->insert($data);

        }
    }

    public function validate($request)
    {
        $errors = Products::validate($request);

        if (isset($request->height) && $request->height === "") {
            $errors['height'] = "height is empty!";
        }
        if (isset($request->width) && $request->width === "") {
            $errors['width'] = "width is empty!";
        }
        if (isset($request->length) && $request->length === "") {
            $errors['length'] = "length is empty!";
        }

        return $errors;

    }
}