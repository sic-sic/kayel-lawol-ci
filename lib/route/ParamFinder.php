<?php

namespace Lawol\Route;

use Lawol\Route\Route;
/**
 * Description of ParamFinder
 *
 * @author diawa
 */
class ParamFinder {
    private $rsegments;
    private $route;
    private $route_string_arr;
    private $params;
    
    public function __construct($rsegments, Route $route) {
        $this->rsegments = $rsegments;
        $this->route = $route;
        $this->route_string_arr = explode('/', $this->route->getRoute());
        $this->params = array();
        $this->initialize();
    }
    
    private function initialize() {
        $route_params_keys = array_keys($this->route->getParams());
        foreach ($route_params_keys as $key) {
            $this->params[$key] = $this->get($key);
        }
    }
    
    public function getAll() {
        return $this->params;
    }
    
    public function getParamsValues() {
        $values = array();
        foreach ($this->getParamsKeys() as $key) {
            $values[] = $this->get($key); 
        }
        return $values;
    }
    
    public function get($key) {
        for ($i = 0; $i < count($this->route_string_arr); $i++) {
            if ($this->route_string_arr[$i] == '{' . $key . '}') {
                return $this->rsegments[$i];
            }
        }
        return false;
    }
    
    private function getParamsKeys() {
        $params = array();
        for ($i = 0; $i < count($this->route_string_arr); $i++) {
            if (stristr($this->route_string_arr[$i], '{')) {
                $params[] = substr($this->route_string_arr[$i], 1, -1);
            }
        }
        return $params;
    }
}
