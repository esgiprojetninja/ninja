<?php

class indexController
{
    public function index($args)
    {
        $view = new view;
        $view->setView("index");
    }
}