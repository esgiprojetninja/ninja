<?php

class articleController
{

    public function createAction($args)
    {

        $article = new Article();

        $article->setIdAuthor("33");
        $article->setDateCreation(date("Y-m-d H:i:s"));
        $article->setType("Ampli");
        $article->setTitle("Le Marshall Code 25");
        $article->setMessage("WAOUW");
        $article->setIsVisible(1);

        $article->save();

    }


    public function deleteAction($args)
    {
        $notification = Notification::findById($args[0]);
        if ($notification) {
            if ($notification->getId_user()==$_SESSION['user_id']){
                $notification->setOpened(1);
                $notification->save();
            }else{
                //Non, ce n'est pas ta notif
            }
        } else {
            //ici renvoyer un header 404 par exemple
        }
    }

    public function showAction($args)
    {
        if(User::isConnected() && !empty($args[0])){
            $article = Article::findById($args[0]);
            if ($article->getId() != $args[0]) {
                header("location:" . WEBROOT);
            }
            $v = new View();
            //$teams = TeamHasUser::findBy("idUser",$args[0],"int");
            //$events = Event::findAll();
            $v->setView("article/show.tpl");
            $v->assign("article", $article);
          //  $v->assign("teams",$teams);
        //    $v->assign("events",$events);
      //      $v->assign("idUser",$args[0]);
        }else{
            header('Location:' . WEBROOT . 'user/login');
        }
    }

    public function listAction($args){
        if(User::isConnected()){
            $articles = Article::FindAll(10000,true,"*","DESC");
            $view = new View();
            $view->setView("article/list.tpl");
            $view->assign("articles", $articles);
        }else{
            //A voir la redirection
            header('Location:'.WEBROOT.'user/login');
        }
    }

    /**
     * Check if the id given in parameters is the same than our actual id defined by the session
     * @return boolean
     */
    public static function itsMy($id){
        if(self::isConnected()){
            if($_SESSION['user_id'] == $id || self::isAdmin()){
                return True;
            }else{
                return False;
            }
        }else{
            return False;
        }
    }

}
