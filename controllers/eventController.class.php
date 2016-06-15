<?php

class eventController
{
//id 	name 	description 	content 	id_creator 	date_creation 	date_event
//max_people 	current_people 	finish 	place 	sport

    public function createAction($args)
    {

        $notification = new Event();
        $notification->setName("Mon permier Event");
        $notification->setDescription("Je veux jouer au foot");
        $notification->setContent("Je cherche des gens pour jouer au foot avec moi Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
        $notification->setIdCreator($_SESSION['user_id']);
        $notification->setDateCreation(date("Y-m-d H:i:s"));
        $notification->setDateEvent(date("Y-m-d H:i:s"));
        $notification->setMaxPeople(22);
        $notification->setCurrentPeople(1);
        $notification->setFinish(0);
        $notification->setPlace("Paris Stade Charlety");
        $notification->setSport(83);

        $notification->save();

    }

    public function modifyAction($args)
    {

    }

    public function deleteAction($args)
    {

    }
}