<?php

namespace Lawol\Route;

/**
 * Description of Route
 *
 * @author diawa
 */
class Route {
    
    private $route;
    private $method;
    private $params;
    
    public function __construct($route = '', $method = '', $params = array()) {
        $this->route = $route;
        $this->method = $method;
        $this->params = $params;
    }
    
    public function getRoute() {
        return $this->route;
    }
    
    public function setRoute($route) {
        $this->route = $route;
        return $this;
    }
    
    public function getMethod() {
        return $this->method;
    }
    
    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }
    
    public function getParams() {
        return $this->params;
    }
    
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
}
