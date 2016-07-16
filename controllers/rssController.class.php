<?php

class rssController
{

	/**
     * Main inbox action
     * @param $args
     */
    public function fluxAction($args) {
        $view = new View();
        $view->setView("rss/showrss.tpl");
        $flux = Rss::getRss("all");
        $view->assign("flux", $flux);
    }

	public function fluxEventAction($args) {
        $view = new View();
        $view->setView("rss/showrss.tpl");
        $flux = Rss::getRss("event");
        $view->assign("flux", $flux);
	}

	public function fluxTeamAction($args) {
        $view = new View();
        $view->setView("rss/showrss.tpl");
        $flux = Rss::getRss("team");
        $view->assign("flux", $flux);
	}
}
