<?php

class helpers {
  /**
  * Creates token based on usernae and email
  * @param array
  * @return string
  */
  public function createToken($user) {
    return md5($user["id"].$user["email"].$user["username"].SALT.date("Ymd"));
  }
}
