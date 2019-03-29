<?php

class User {
  public $id;
  public $name;
  public $email;
  public $password;
  public $confirm_password;

  public function __construct ($name, $email, $password, $confirm_password){
      $this->name = $name;
      $this->email = $email;
      $this->password = $password;
      $this->confirm_password = $confirm_password;
  }
}