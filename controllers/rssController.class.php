<?php

class rssController
{

	/**
     * Main RSS action
     * @param $args
     */
    public function feedsAction($args) {
        $view = new View();
        $view->setView("rss/showrss.tpl");
    }

	public function feedEventAction($args) {
        $view = new View();
        $view->setView("rss/showfeed.tpl");
        $feed = Rss::getRss("event");
        $view->assign("feed", $feed);
	}

	public function feedTeamAction($args) {
        $view = new View();
        $view->setView("rss/showfeed.tpl");
        $feed = Rss::getRss("team");
        $view->assign("feed", $feed);
	}
}
