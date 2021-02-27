<?php
class AccommodationType extends Controller{
       private $accoTypeModel;
       public function __construct(){
           $this->accoTypeModel=$this->Model('Accommodation_Type');
       }

       public function Index(){
        $accoTypes=$this->accoTypeModel->getAllAccomoType();
         $data=[
            'Name'=>'',
            'Description'=>'',
            'NameError'=>'',
            'AccoTypes'=>$accoTypes
            ];
           $this->View("Dashboard/AccommodationType/AccommodationType",$data);
       }

       public function add(){
         
           if($_SERVER['REQUEST_METHOD']=='POST'){
           $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
              
               $data=[
                'Name'=>trim($_POST['Name']),
                'Description'=>trim($_POST['Description']),
                'NameError'=>'',
               ];

               if(empty($data['Name'])){
                 $data['NameError']="Name is required";
               }
               if(empty($data['NameError'])){
                if($this->accoTypeModel->Add($data)){
                  header('location:'.URLROOT.'/AccommodationType');
                }else{
                    die("somthing went wrong");
                    //$data["NameError"]="somthing went wrong";
                }
               }
            
           }
           header('location:'.URLROOT.'/AccommodationType');
       }

       public function Edit($id){
         $accoType=$this->accoTypeModel->getAccoTypeByID($id);
         $data=[
            'ID'=>$accoType->ID,
            'Name'=>$accoType->Name,
            'Description'=>$accoType->Description,
            'NameError'=>'',
            'Message'=>''
          ];
          if($_SERVER["REQUEST_METHOD"]=='POST'){
          $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
          $data=[
            'ID'=>$accoType->ID,
            'Name'=>trim($_POST['Name']),
            'Description'=>trim($_POST['Description']),
            'NameError'=>'',
            'Message'=>''
          ];
          if(empty($data['Name'])){
           $data['NameError']="Name couldn't be empty,it's required";
          }
            
          if(empty($data['NameError'])){
            if($this->accoTypeModel->update($data)){
              $data['Message']="Updated successfully";
              header('Location:'.URLROOT."/AccommodationType");
            }
          }
          }
        
         $this->View("Dashboard/AccommodationType/Edit",$data);
       }

}
?>