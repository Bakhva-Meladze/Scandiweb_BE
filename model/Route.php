<?php

namespace model;

class Route
{
    public static $routes;

    public function get($url, $controller, $function)
    {
        self::$routes[$url] = [
            'function' => $function,
            'controller' => $controller
        ];
    }

    public function post($url, $controller, $function)
    {
        self::$routes[$url] = [
            'function' => $function,
            'controller' => $controller,
            'data' => json_decode((file_get_contents("php://input"))) ?? []
        ];
    }

    public function run($path)
    {
        if (isset(self::$routes[$path])) {
            $controller = '\Controllers\\' . self::$routes[$path]['controller'];
            $function = self::$routes[$path]['function'];
            $controllerClass = new $controller();

            if (isset(self::$routes[$path]['data'])) {
                $post_data = self::$routes[$path]['data'];
                $controllerClass->$function($post_data);
            } else {
                $controllerClass->$function();
            }
        } else {
            http_response_code(404);
            echo json_encode(
                [
                    'success' => false,
                    'errorMessages' => 'Wrong URL!'
                ]
            );
        }
    }
}