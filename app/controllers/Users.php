<?php
class Users extends Controller{
private $userModel;
public function __construct(){
    $this->userModel=$this->Model('User');
}
public function Login(){
    $data=[
        "CIN"=>'',
        "Email"=>'',
        "Password"=>'',
        "EmailError"=>'',
        "PasswordError"=>'',
    ];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        $data=[
            "Email"=>trim($_POST['Email']),
            "Password"=>trim($_POST['Password']),
            "EmailError"=>'',
            "PasswordError"=>'',
        ];
        if(empty($data['Email'])){
          $data['EmailError']="Please enter your Email"; 
        }
        if(empty($data['Password'])){
            $data['PasswordError']="Please enter your password"; 
        }
        //check if non errors
        if(empty($data["EmailError"]) && empty($data["PasswordError"])){
            //check for user account
          $loggedInUser=$this->userModel->login($data['Email'],$data['Password']);
          if($loggedInUser){
           $this->CreateUserSession($loggedInUser);
           header('Location:'.URLROOT.'/Pages/Index');
          }
          else{
            $data["PasswordError"]="Password or Email is incorrect. Please try again.";
            $this->View("user/Login",$data);
          }
        }
    }
    else{
        $data=[
            "CIN"=>'',
            "Email"=>'',
            "Password"=>'',
            "EmailError"=>'',
            "PasswordError"=>'',
        ];
        $this->View('user/Login',$data);
    }
   
} 

//=========================manage session==========================================
public function CreateUserSession($User){
    $_SESSION["USER_CIN"]=$User->CIN;
    $_SESSION["USER_Email"]=$User->Email;
    header("Location:".URLROOT."/Pages/Index");
}
public function LogOut($loggedInUser){
     unset($_SESSION["USER_CIN"]);
     unset($_SESSION["USER_Email"]);
     header("Location:".URLROOT."/Users/Login");
}
//===================Registertion==================================================
public function Register(){
    $data=[
        "CIN"=>'',
        "Fullname"=>'',
        "Email"=>'',
        "ConfirmEmail"=>'',
        "NumberPhone"=>'',
        "Password"=>'',
        "ConfirmPassword"=>'',
        "CINError"=>'',
        "EmailError"=>'',
        "ConfirmEmailError"=>'',
        "PasswordError"=>'',
        "ConfirmPasswordError"=>'',
    ];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
     //filter the input from the no wanted carracters
    $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_URL);
    $data=[
        "CIN"=>trim($_POST['CIN']),
        "Fullname"=>trim($_POST['Fullname']),
        "Email"=>trim($_POST['Email']),
        "ConfirmEmail"=>trim($_POST['ConfirmEmail']),
        "NumberPhone"=>trim($_POST['NumberPhone']),
        "Password"=>trim($_POST['Password']),
        "ConfirmPassword"=>trim($_POST['ConfirmPassword']),
        "CINError"=>'',
        "EmailError"=>'',
        "ConfirmEmailError"=>'',
        "PasswordError"=>'',
        "ConfirmPasswordError"=>'',
    ];
    //CIM validation
    //$cinValidation="/^[a-zA-Z]{0,2}|\d+/";
    if(empty($data['CIN'])){
      $data['CINError']="CIN is Required";
    }
     //elseif(preg_match($cinValidation,$data['CIN'])){
     //$data['ErrorCIN']="Please enter a valid CIN";
     //}
     //Email validation
    if(empty($data['Email'])){
     $data['EmailError']="Email is Required";
    }
    elseif(!filter_var($data['Email'],FILTER_VALIDATE_EMAIL)){
     $data['EmailError']="Enter a valid email adress";
    }elseif($data["ConfirmEmail"]!=$data["Email"]){
     $data["ConfirmEmail"]="Email addresses didn't match";
    }
    //Password validation
    $passwordValidation= "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";
    if(empty($data['Password'])){
    $data['PasswordError']="Please enter password";
    }elseif(preg_match($passwordValidation,$data["Password"])){
        $data['PasswordError']="Password must be have at least one numeric value";
        echo strlen($data['Password']);
    }elseif(strlen($data['Password'])<8){
        $data['PasswordError']="Password must be at less 8 chatacters";
    }elseif($data['Password']!=$data["ConfirmPassword"]){
       $data['ConfirmPasswordError']="Passwords must be match";
    }
    
    //last validation for no error found
    if(empty($data['CINError']) && empty($data['EmailError']) && empty($data['ConfirmEmailError']) &&
       empty($data['PasswordError']) && empty($data['ConfirmPasswordError']) ){

        //before registertion check if this account aready exist
        if($this->userModel->FindUser($data)){
          $data["EmailError"]="this account aready exist";
        }else{
        //hash password 
        $data['Password']=password_hash($data['Password'],PASSWORD_DEFAULT);
        //register 
        if($this->userModel->register($data)){
         header('Location:'.URLROOT.'/user/Login.php');
           }else{
            die("somthing went wrong"); }
        }    
    }

    }
    $this->View('user/Register',$data);
}
}