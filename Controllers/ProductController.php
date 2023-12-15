<?php

namespace Controllers;

use Exception;
use model\Products;
use model\Database;
use model\Types;

class ProductController
{
    public function Index()
    {
        $products = new Products();
        $product = $products->all();
        echo json_encode($product);
        http_response_code(200);
    }

    public function Create()
    {
        $type = new Types();
        $types = $type->all();
        /*$data = array();
        $type_new = new Types();*/
        http_response_code(200);
        echo json_encode($types);

    }

    public function Store($request)
    {
        try {
            // Check if the class exists
            if (!isset($request->type) && !class_exists($request->type)) {
                throw new \Exception('Class not found: ');
            }

            $type = 'model\\' . $request->type;
            $product = new $type();

            if (!$errors = $product->validate($request)) {
                $product->save($request);
                http_response_code(200);
                echo json_encode(
                    ['success' => true]
                );
            } else {
                echo json_encode(
                    [
                        'success' => false,
                        'errorMessages' => $errors
                    ]
                );
            }
        } catch (Exception $e) {
            echo json_encode(
                [
                    'success' => false,
                    'errorMessages' => $e->getMessage()
                ]
            );
        }

    }

    public function Delete($request)
    {
        $product_delete = new Database();
        $delete = $request;
        foreach ($delete as $del) {
            $product_delete->delete($del);
        }
    }
}
