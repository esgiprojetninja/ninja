<?php

class landingController {
  public function welcomeAction ($args) {
    $view = new View();
    $view->setView("landing/landing.tpl", "empty");
  }
}
