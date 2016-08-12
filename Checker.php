<?php

namespace Lawol\Checker;

use Lawol\Route\Route,
    Lawol\Route\ParamFinder,
    Lawol\Filter\Filter;

/**
 * Description of Checker
 *
 * @author diawa
 */
class Checker {

    private $rsegments;
    private $route;
    private $route_string_arr;

    public function doCheck($rsegments, $route) {
        $this->rsegments = $rsegments;
        $this->route = $route;
        $this->route_string_arr = explode('/', $this->route->getRoute());
        return $this->uris_match();
    }

    private function uris_match() {
        $temoin = false;
        if (count($this->rsegments) == count($this->route_string_arr)) {
            $temoin = true;
        }
        if ($temoin) {
            $temoin = $this->segments_matchs();
        }
        if ($temoin) {
            $temoin = $this->params_matchs();
        }
        return $temoin;
    }

    private function segments_matchs() {
        for ($i = 0; $i < count($this->route_string_arr); $i++) {
            if (!stristr($this->route_string_arr[$i], '{') &&
            $this->rsegments[$i] != $this->route_string_arr[$i]) {
                return false;
            }
        }
        return true;
    }

    private function params_matchs() {
        $paramFinder = new ParamFinder($this->rsegments, $this->route);
        $filterCheck = new Filter();
        foreach ($this->route->getParams() as $key => $value) {
            if (!$filterCheck->checkParams($paramFinder->get($key), $value)) {
                return false;
            }
        }
        return true;
    }

}
