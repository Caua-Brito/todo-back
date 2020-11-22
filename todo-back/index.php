<?php

require __DIR__ ."/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Controllers\App;

$router = new Router("http://localhost/todo/todo-back" , "::");

$router->namespace("Source\Controllers");

$router->get("/","App::index");

$router->get("/deletar/{id}","App::deletarTarefa");

$router->post("/criar" , "App::cadastrar");

$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
}




