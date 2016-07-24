<?php

class rateController
{
	public function setRateAction($args)
	{
		if (User::isConnected()) {

			$rate = new Rate;
			$rate->rateUser($args[1], $args[0]);
			$rate->save();
		} else {
	   		header("location: ".WEBROOT."user/subscribe");
		}
	}
}
