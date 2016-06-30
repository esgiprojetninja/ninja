<?php

class eventController
{
//id 	name 	description 	content 	id_creator 	date_creation 	date_event
//max_people 	current_people 	finish 	place 	sport

    public function createAction($args)
    {

        $event = new Event();
        $event->setName("Mon permier Event");
        $event->setDescription("Je veux jouer au foot");
        $event->setContent("Je cherche des gens pour jouer au foot avec moi Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
        $event->setIdCreator($_SESSION['user_id']);
        $event->setDateCreation(date("Y-m-d H:i:s"));
        $event->setDateEvent(date("Y-m-d H:i:s"));
        $event->setMaxPeople(22);
        $event->setCurrentPeople(1);
        $event->setFinish(0);
        $event->setPlace("Paris Stade Charlety");
        $event->setSport(83);
        $event->setVisible(1);

        $event->save();

    }

    public function modifyAction($args)
    {

    }

    public function deleteAction($args)
    {
        $event = Event::findById($args[0]);
        if ($event) {
            if ($event->getIdCreator()==$_SESSION['user_id']){
                $event->setVisible(0);
                $event->save();
            }else{
                //Non, ce n'est pas ton event, tu ne peux pas l'annuler
            }
        } else {
            //ici renvoyer un header 404 par exemple
        }

    }
}