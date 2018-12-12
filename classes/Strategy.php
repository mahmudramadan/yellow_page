<?php

interface hashStrategy {
  public function hash($password);
}


class hashPassword implements hashStrategy {

  public function hash($password = 0) {
    return md5($password) ;
  }
  
}

class PasswordClass {

  public $password ='';
  
  public function __construct($password = 0) {
    $this->password = $password;
  }

  
  public function getPassword() {

    $new = new hashPassword();
    $password = $new->hash($this->password);
    return $password;

  }
}
///////////////////// admin //////////////////

interface privellageStrategy{
  public function privellage($privellage);
  public function check_privellage($privellage,$page,$type);

}

class userPrivellage implements privellageStrategy {

  public function privellage($privellage) {
    return json_decode($privellage) ;
  }
  public function check_privellage($privellage,$page,$type) {
    $privellage = json_decode($privellage) ;
     
     if ( isset($privellage->$page) && isset($privellage->$page->$type) && $privellage->$page->$type == 1 ) {
      return $privellage->$page;
    }else{
       return false;
    }

  }
  
}


class PrivellageClass {

  public $privellage =[];
  public $page ='';
  public $type ='';
  
  public function __construct($privellage ,$page='',$type='') {
    $this->privellage = $privellage;
    $this->page = $page;
    $this->type = $type;
  }

  
  public function getPrivellage() {
    
    $newUserPrivellage = new userPrivellage();
    $privellage = $newUserPrivellage->privellage($this->privellage);
    return $privellage;
    
  }
   public function check_admin_privellage() {

    $newUserPrivellage = new userPrivellage();
    $privellage = $newUserPrivellage->check_privellage($this->privellage,$this->page,$this->type);
    return $privellage;

  }

}
?>