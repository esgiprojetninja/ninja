<?php

class view
{
    protected $data = [];
    protected $view;
    protected $template;

    /**
     * Generate a view for each route which got an action and a controller
     * @param $view
     * @param string $layout
     */
    public function setView($view, $layout = "template")
    {
        //$view = indexIndex
        $viewPath = "views/" . $view . ".php";
        $templatePath = "views/" . $layout . ".php";
        if (file_exists($viewPath)) {
            $this->view = $viewPath;
            if (file_exists($templatePath)) {
                $this->template = $templatePath;
            } else {
                die("le template n'existe pas");
            }
        } else {
            die("erreur template, la vue n'existe pas");
        }
    }

    /**
     * Assign some variables to a view
     * @param $key
     * @param $value
     */
    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }

}