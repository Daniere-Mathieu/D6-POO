<?php

class Verification {
    public static function valueExistAndIsNotEmpty($value):bool {
        return isset($value) && !empty($value);
    }
    public static function functionParamExistAndIsNotEmpty(array $array):bool {
        foreach($array as $value){
            if(!self::valueExistAndIsNotEmpty($value)){
                return false;
            }
        }
    }
}