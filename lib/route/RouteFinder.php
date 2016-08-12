<?php

namespace Lawol\Route;

use Lawol\Route\RouteProvider,
    CI_URI,
    Lawol\Checker\Checker;
        
/**
 * Description of RouteFinder
 *
 * @author diawa
 */
class RouteFinder {
    
    private $routeProvider;
    private $checker;
    private $rsegments;
    
    public function __construct(RouteProvider $routeProvider, $rsegments) {
        $this->routeProvider = $routeProvider;
        $this->rsegments = $rsegments;
        $this->checker = new Checker();
    }
    
    public function find() {
        if (($route = $this->walkRoutes())) {
            return $route;
        }
        return false;
    }
    
    private function walkRoutes() {
        foreach ($this->routeProvider->getRoutes() as $route) {
            if ($this->checker->doCheck($this->rsegments, $route)) {
                return $route;
            }
        }
        return false;
    }
}
