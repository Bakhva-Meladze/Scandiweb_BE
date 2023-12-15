<?php


use model\Route;

$route = new Route();

(new model\Route)->get($url . '/all', 'ProductController', 'Index');
(new model\Route)->get($url . '/create', 'ProductController', 'Create');
(new model\Route)->post($url . '/store', 'ProductController', 'Store');
(new model\Route)->post($url . '/delete', 'ProductController', 'Delete');
