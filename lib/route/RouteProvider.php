<?php

namespace Lawol\Route;

use Lawol\Route\Route;

/**
 * Description of RouteProvider
 *
 * @author diawa
 */
class RouteProvider {
    
    private $routes;
    
    public function __construct() {
        $this->routes = array();
    }
    
    public function addRoute($route, $method, $params = array()) {
        array_push($this->routes, new Route($route, $method, $params));
    }
    
    public function getRoutes() {
        return $this->routes;
    }
    
}
