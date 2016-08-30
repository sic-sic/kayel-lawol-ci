<?php

namespace Lawol;

use Lawol\Route\RouteProvider,
    Lawol\Route\RouteFinder,
    Lawol\Route\ParamFinder,
    CI_URI;

/**
 * Description of LawolEnvironment
 *
 * @author diawa
 */
class LawolEnvironment {
    
    private $rsegments;
    private $routeProvider;
    
    public function __construct() {        
        require_once 'Autoload.php';
        $this->rsegments = $this->prepare_rsegments(get_instance()->uri);
        $this->routeProvider = new RouteProvider();
    }
    
    public function find_route_method() {
        $routeFinder = new RouteFinder($this->routeProvider, $this->rsegments);
        if (($route = $routeFinder->find())) {
            $paramFinder = new ParamFinder($this->rsegments, $route);
            return array(
                'method_name' => $route->getMethod(),
                'method_params' => $paramFinder->getParamsValues()
            );
        }
        return false;
    }
    
    public function add_route($route, $method, $params = array()) {
        $this->routeProvider->addRoute(substr($route, 1), $method, $params);
    }
    
    private function prepare_rsegments($uri) {
        $uri_rsegments = $uri->rsegments;
        unset($uri_rsegments[1]);
        $rsegments = array_merge(array(), $uri_rsegments);
        $uri_string_arr = explode('/', $uri->uri_string());
        $usa_length = count($uri_string_arr);
        $rsg_length = count($rsegments);
        if ($rsegments[$rsg_length - 1] != $uri_string_arr[$usa_length - 1]) {
            unset($rsegments[$rsg_length - 1]);
        }
        return (empty($rsegments)) ? array(''): $rsegments;
    }
}
