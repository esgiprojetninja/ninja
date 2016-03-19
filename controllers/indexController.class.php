<?php

class indexController
{
	public function indexAction($args)
	{
		if ($_SESSION["user"]) {
			echo "coucou";
		} else {
			header("location: /user/preSub");
		}
	}
}
