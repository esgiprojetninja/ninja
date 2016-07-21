<?php

class rssController
{

	/**
     * Main RSS action
     * @param $args
     */
    public function listAction($args) {
        $view = new View();
        $view->setView("rss/showrss.tpl");
    }

	public function feedAction($args) {
        header("Content-Type: application/rss+xml; charset=ISO-8859-1");
            
            $args_access = ["team", "event", "all"];
            if( !empty( $args ) && in_array($args[0], $args_access, true) )
            {    

                $feed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
                $feed .= '<rss version="2.0">';
                $feed .= '<channel>';
                $feed .= '<title>My RSS feed '.$args[0].' </title>';
                $feed .= '<link> '. WEBROOT. 'rss/feed/'. $args[0]. ' </link>';
                $feed .= '<description>My Latest cool '.$args[0]. ' ! </description>';
                $feed .= '<language>en-us</language>';
                $feed .= '<copyright>Copyright (C) 2016 ninja.dev</copyright>';
             
                if($args[0] == "event" )
                {   
                    $events = Event::findAll(10);
                    foreach($events as $key => $event)
                    {
                        $feed .= '<item>';
                        $feed .= '<title> Event :' . $event->getName() . '</title>';
                        $feed .= '<description>' . $event->getDescription() . '</description>';
                        $feed .= '<tags>' . $event->getTags() . '</tags>';
                        $feed .= '<link> '. WEBROOT. 'event/list </link>';
                        $feed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($event->getFromDate() )) . '</pubDate>';
                        $feed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($event->getToDate() )) . '</pubDate>';
                        $feed .= '</item>';
                    }
                }
                else if($args[0] == "team" )
                {
                    $teams = Team::findAll(10);
                    foreach($teams as $key => $team)
                    {
                        $feed .= '<item>';
                        $feed .= '<title> Team : ' . $team->getTeamName() . '</title>';
                        $feed .= '<description>' . $team->getDescription() . '</description>';
                        $feed .= '<sports>'. $team->getSports() .'</sports>';
                        $feed .= '<link> '. WEBROOT. 'team/list </link>';
                        $feed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($team->getDateCreated() )) . '</pubDate>';
                        $feed .= '</item>';
                    }
                }
                else if($args[0] == "all" )
                {
                    $teams = Team::findAll(10);
                    $events = Event::findAll(10);

                    foreach($teams as $key => $team)
                    {
                        $feed .= '<item>';
                        $feed .= '<title> Team :' . $team->getTeamName() . '</title>';
                        $feed .= '<description>' . $team->getDescription() . '</description>';
                        $feed .= '<sports>' . $team->getSports() .'</sports>';
                        $feed .= '<link> '. WEBROOT. 'team/list </link>';
                        $feed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($team->getDateCreated() )) . '</pubDate>';
                        $feed .= '</item>';
                    }
                      foreach($events as $key => $event)
                    {
                        $feed .= '<item>';
                        $feed .= '<title> ' . $event->getName() . '</title>';
                        $feed .= '<description>' . $event->getDescription() . '</description>';
                        $feed .= '<tags>' . $event->getTags() . '</tags>';
                        $feed .= '<link> '. WEBROOT. 'event/list </link>';
                        $feed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($event->getFromDate() )) . '</pubDate>';
                        $feed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($event->getToDate() )) . '</pubDate>';
                        $feed .= '</item>';
                    }
                }
                
                
             
                $feed .= '</channel>';
                $feed .= '</rss>';
            
            }
            else
            {
                $feed = "DUDE, ARE YOU CRAZY ?";
            }
        
            echo $feed;
	    
        } 
    }