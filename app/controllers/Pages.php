<?php
class Pages extends Controller{
     private $userModel;
    public function __construct(){
        $this->userModel=$this->Model('User');
        //print_r($this->userModel);
    }

    public function Index(){
        //require_once("../app/views/pages/index.php");
        //$users=$this->userModel->getUsers();
        //$this->View('pages/index',$data);
    }

    public function About(){
     echo 'about pages';
    }
    
}
?>