<?php

class Routing
{
    /**
     * Static function to set routes
     * @return array => controller name and action name
     */
    public static function setRouting()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $explode_uri = explode('?', $uri);
        $uri = $explode_uri[0];
        $uri = trim(str_replace('esgi/ninja', '', $uri), '/');
        $explode_uri = explode('/', $uri);
        $controller = (!empty($explode_uri[0])) ? $explode_uri[0] : 'index';
        $action = (!empty($explode_uri[1])) ? $explode_uri[1] : 'index';
        unset($explode_uri[0]);
        unset($explode_uri[1]);
        $args = array_merge($explode_uri, $_REQUEST);
        return ['controller' => $controller, 'action' => $action, 'args' => $args];
    }
}
