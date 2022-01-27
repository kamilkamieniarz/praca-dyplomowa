<?php
class Task
{
    public $id;
    public $name;
    public $description;
    public $category;
    public $creator_id;
    public $user_id;
    public $client_id;
              
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