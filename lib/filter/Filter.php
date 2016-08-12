<?php

namespace Lawol\Filter;

use Lawol\Filter\FilterParser,
    Lawol\Filter\FilterFunc;

/**
 * Description of Filter
 *
 * @author diawa
 */
class Filter {
    private $filterParser;
    private $filterFunc;
    
    public function __construct() {
        $this->filterParser = new FilterParser();
        $this->filterFunc = new FilterFunc();
    }
    
    public function checkParams($param_value, $param_rules) {
        $callables = $this->filterParser->retreiveCallables($param_value, $param_rules);
        return $this->callFilterFunctions($callables);
    }
    
    private function callFilterFunctions($callbacks) {
        foreach ($callbacks as $callback) {
            if (!call_user_func_array(array($this->filterFunc, $callback['func_name']),
                    $callback['func_params'])) {
                return false;
            }
        }
        return true;
    }
    
}
