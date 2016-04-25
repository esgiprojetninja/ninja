<?php

class StringHelper
{
    /**
     * Return a string converted to camelCase
     * @param $string
     * @param $delimiter
     * @return string
     */
    public static function camelCase($string, $delimiter)
    {
        $tmp = explode($delimiter, $string);
        $i = 0;
        $array = [];

        foreach($tmp as $value){
            if($i === 0){
                $array[0] = strtolower($tmp[0]);
            } else {
                $array[$i] = ucfirst($value);
            }
            $i++;
        }

        $return = implode($array);
        return $return;
    }

    /**
     * htmlentities on a string
     * @param $string
     * @return string
     */
    public static function e($string)
    {
        return htmlentities($string);
    }

    /**
     * Get to know if your string begin with
     * a specific word
     * @param $string
     * @param $word
     * @return bool
     */
    public static function start($string, $word)
    {
        $array = explode(' ', $string);

        if(strtolower($array['0']) === strtolower($word)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get to know if your string ends with
     * a specific word
     * @param $string
     * @param $word
     * @return bool
     */
    public static function end($string, $word)
    {
        $array = explode(' ', $string);
        $lastKeyId = count($array) - 1;

        if(strtolower($array[$lastKeyId]) === strtolower($word)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get to know if your string contains
     * a specific word
     * @param $string
     * @param $word
     * @return bool
     */
    public static function contains($string, $word)
    {
        $array = explode(' ', $string);
        $return = false;

        foreach($array as $key=>$value){
            if(strtolower($value) === strtolower($word)){
                $return = true;
            }
        }

        return $return;
    }

    /**
     * Generate a string with limited characters
     * @param $string
     * @param $limit
     * @return string
     */
    public static function limit($string, $limit)
    {
        $string = substr($string, 0, $limit);
        return $string;
    }

    /**
     * Generate a random string with $length characters
     * @param $length
     * @return string
     */
    public static function random($length)
    {
        $randomStr = '';
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($chars);

        for ($i = 0; $i < $length; $i++) {
            $randomStr .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomStr;
    }

    /**
     * Generate a slug for a given string
     * @param $string
     * @param $glue
     * @param bool|true $toLower
     * @return string
     */
    public static function slug($string, $glue, $toLower = true)
    {
        if($toLower){
            $string = strtolower($string);
        }

        $tmp = explode(' ', $string);
        $string = implode($glue, $tmp);
        return $string;
    }

    /**
     * Generate an email to prevent spams
     * @param $email
     * @return string
     */
    public static function hideEmail($email)
    {
        $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
        $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999);

        for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])];

        $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
        $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
        $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\" target=\\"_blank\\">"+d+"</a>"';
        $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")";
        $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';

        return '<span id="'.$id.'">[javascript protected email address]</span>'.$script;
    }
}