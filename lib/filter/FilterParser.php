<?php

namespace Lawol\Filter;

/**
 * Description of FilterParser
 *
 * @author diawa
 */
class FilterParser {
    
    public function retreiveCallables($param_value, $filters) {
        return (is_string($filters)) ? $this->retreiveFromString($param_value, $filters)
                : $this->retreiveFromArray($param_value, $filters);
    }  
    
    private function retreiveFromString($param_value, $filters) {
        $filters_arr = explode("|", $filters);
        $response = array();
        foreach ($filters_arr as $filter) {
            $callback_params = array();
            $callback_params['func_name'] = $this->get_func_name($filter);
            $callback_params['func_params'] = array_merge(array($param_value), $this->get_func_params($filter));
            array_push($response, $callback_params);
        }
        return $response;
        
    }
    
    private function retreiveFromArray($param_value, $filters) {
        $response = array();
        foreach ($filters as $key => $value) {
            $callback_params = array();
            $callback_params['func_name'] = is_string($key) ? $key : $value;
            $callback_params['func_params'] = is_string($key) ? 
                    array_merge(array($param_value), $value) : array($param_value);
            array_push($response, $callback_params);
        }
        return $response;
    }
    
    private function get_func_name($filter) {
        if (($name = stristr($filter, '[', true))) {
            return $name;
        }
        return $filter;
    }
    
    private function get_func_params($filter) {
        if (($params = stristr($filter, '['))) {
            $params = substr($params, 1, -1);
            $param_array = explode(',', $params);
            return $param_array;
        }
        return array();
    }
}
