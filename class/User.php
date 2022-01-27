<?php
class User
{
    public $id;
    public $login;
    public $role;
    public $name;
    public $surname;
    public $city;
    public $post_code;
    public $street;
    public $number;
    public $apartment;
              
   public function get_user($what_return){
      return $this->$what_return;         
   }

   public function add_var($what_add,$what_add_value){
      $this->$what_add=$what_add_value;
   }

   public function __construct(){
   }

   public function __destruct(){
   } 
}
?>