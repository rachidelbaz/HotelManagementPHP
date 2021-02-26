<?php
class Core{
    protected $currentController="Pages";
    protected $currentMethod="Index";
    protected $currentParam=[];
    
    public function __construct(){
        $url=$this->getUrl();
        //make sur that the url has value / avoid error msg array offset on value of type null 
        $url=$url?$url:[$this->currentController];

            if(file_exists("../app/controllers/".ucwords($url[0]).".php")){
                $this->currentController=ucwords($url[0]);
                 unset($url[0]);
               }
               require_once("../app/controllers/".$this->currentController.'.php');
               //instenceted the currant controller 
               $this->currentController=new $this->currentController;
               //Check out of the method passed in url if exist in the currentController 
               if(isset($url[1])){
                   if(method_exists($this->currentController,$url[1])){
                     $this->currentMethod=$url[1];
                     unset($url[1]);
                   }
                }
                $this->currentParam=$url? array_values($url):[];
                
                call_user_func_array([$this->currentController,$this->currentMethod],$this->currentParam);
        
        
        }
    public function getUrl(){
        if(isset($_GET["url"])){
            //remouve if there is a / in end of url
          $url=rtrim($_GET["url"],'/');
          //filter url from characters illegal
          $url=filter_var($url,FILTER_SANITIZE_URL);
          //splite url 
          $url=explode('/',$url);
          return $url;
        }
    }
   
    
}