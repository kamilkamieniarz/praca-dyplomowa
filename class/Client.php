<?php
class Client
{
    public $id;
    public $name;
    public $surname;
    public $company;
    public $nip;
    public $description;
    public $city;
    public $post_code;
    public $street;
    public $number;
    public $apartment;
    public $category;
    public $creator_id;
              
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