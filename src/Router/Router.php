<?php

namespace App\Router;


use Exception;
use App\Router\Route;


class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url){

        $this->url = $url;
    }

    public function get($path, $callable, $name = null){

        return $this->add($path, $callable, $name, 'GET');

    }

    public function post($path, $callable, $name = null){

        return $this->add($path, $callable, $name, 'POST');

    }

    private function add($path, $callable, $name, $method){

        $route = new Route($path, $callable);

        $this->routes[$method][] = $route;

        if($name) {

            $this->namedRoutes[$name] = $route;
        }

        if(is_string($callable) && $name === null){

            $name = $callable;
        }
        return $route;

    }

    public function run() {

       if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){

            throw new Exception('REQUEST_METHOD does not exist');
       }

       foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){

            if($route->match($this->url)){

                return $route->call();
            }
       }
       http_response_code(404);
       throw new Exception('No matching routes');
    }


    

    public function url($name, $params = []){

        if(!isset($this->namedRoutes[$name])){
            http_response_code(404);
            throw new Exception('No matching routes');
        }

        return $this->namedRoutes[$name]->getUrl($params);

    }
}