<?php

class ArrayHelper
{
    /**
     * adds a given key / value pair to an array
     * @param $array
     * @param $key
     * @param $value
     * @return array
     */
    public static function add($array, $key, $value)
    {
        if(!is_array($array)){
            echo 'Not an array';
            die();
        }

        if(array_key_exists($key, $array)){
            echo 'key already exist in this array';
            die();
        }

        $array[$key] = $value;
        return $array;
    }

    /**
     * Return two arrays
     * One contains all keys from the array
     * Other contains all values from the array
     * @param $array
     * @return array
     */
    public static function divide($array)
    {
        if(!is_array($array)) {
            echo 'Not an array';
            die();
        }

        foreach($array as $key=>$value){
            $arrayDivide['keys'][] = $key;
            $arrayDivide['values'][] = $value;
        }
        return $arrayDivide;
    }

    /**
     * Unset a key from array
     * @param $array
     * @param $key
     * @return array
     */
    public static function except($array, $key)
    {
        if(!is_array($array)) {
            echo 'Not an array';
            die();
        }

        unset($array[$key]);
        return $array;
    }
}
