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
        header("Content-Type: application/rss+xml; charset=ISO-8859-1");
        
        $feedEvent = '<?xml version="1.0" encoding="ISO-8859-1"?>';
        $feedEvent .= '<rss version="2.0">';
        $feedEvent .= '<channel>';
        $feedEvent .= '<title>My RSS feed EVENT</title>';
        $feedEvent .= '<link> ninja.dev/rss/feedEvent</link>';
        $feedEvent .= '<description>My Latest cool event !</description>';
        $feedEvent .= '<language>en-us</language>';
        $feedEvent .= '<copyright>Copyright (C) 2016 ninja.dev</copyright>';
     
        $events = Event::findAll();

        foreach($events as $key => $event)
        {
            $feedEvent .= '<item>';
            $feedEvent .= '<title>' . $event->getName() . '</title>';
            $feedEvent .= '<description>' . $event->getDescription() . '</description>';
            $feedEvent .= '<link> link </link>';
            $feedEvent .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($event->getFromDate() )) . '</pubDate>';
            $feedEvent .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($event->getToDate() )) . '</pubDate>';
            $feedEvent .= '</item>';
        }
     
        $feedEvent .= '</channel>';
        $feedEvent .= '</rss>';
     
        echo $feedEvent;
	}

	public function feedTeamAction($args) {
        header("Content-Type: application/rss+xml; charset=ISO-8859-1");
        
        $feedTeam = '<?xml version="1.0" encoding="ISO-8859-1"?>';
        $feedTeam .= '<rss version="2.0">';
        $feedTeam .= '<channel>';
        $feedTeam .= '<title>My RSS feed TEAM</title>';
        $feedTeam .= '<link> ninja.dev/rss/feedTeamt</link>';
        $feedTeam .= '<description>My Latest cool Team !</description>';
        $feedTeam .= '<language>en-us</language>';
        $feedTeam .= '<copyright>Copyright (C) 2016 ninja.dev</copyright>';
        
        $teams = Team::findAll();

        foreach($teams as $key => $team )
        {
            $feedTeam .= '<item>';
            $feedTeam .= '<title> Nouvelle team :' . $team->getTeamName() . '</title>';
            $feedTeam .= '<description>' . $team->getDescription() . '</description>';
            $feedTeam .= '<link> link </link>';
            $feedTeam .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($team->getDateCreated() )) . '</pubDate>';
            $feedTeam .= '</item>';
        }
     
        $feedTeam .= '</channel>';
        $feedTeam .= '</rss>';
        
        echo $feedTeam;
    }
}
