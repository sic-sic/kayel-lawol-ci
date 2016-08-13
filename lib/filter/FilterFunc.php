<?php

namespace Lawol\Filter;

/**
 * Description of FilterFunc
 *
 * @author diawa
 */
class FilterFunc {
    
    public function numeric($data) {
        return preg_match("#^\d{1,}$#", $data);
    }
    
    public function min_length($data, $length) {
        return strlen($data) >= $length;
    }
    
    public function max_length($data, $length) {
        return strlen($data) <= $length;
    }
    
    public function length($data, $length) {
        return strlen($data) == $length;
    }
    
    public function callback($data, $callable) {
        return (is_string($callable)) ? call_user_func_array(array(get_instance(), $callable), array($data)) :
            call_user_func_array(array($callable, func_get_arg(2)), array($data)) ;
    }
    
    public function matchs($data) {
        $args = func_get_args();
        for ($i = 1; $i < count($args); $i++) {
            if ($data == $args[$i]) {
                return true;
            }
        }
        return false;
    }
}
