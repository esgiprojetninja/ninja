<?php

class Views
{
    /**
     * Show index view
     * @param $args
     */
    public function index($args)
    {
        $view = new view;
        $view->setView("index");
    }
}