<?php
class Accommodation_Type {
    private $db;
    public function __construct(){
        $this->db=new Database;
    }

     public function Add($data){
        $this->db->query('INSERT INTO ACCOMMODATIONTYPE(NAME,DESCRIPTION) VALUES(:NAME,:DESCRIPTION)');

        $this->db->Bind(":NAME",$data['Name']);
        $this->db->Bind(":DESCRIPTION",$data['DESCRIPTION']);
         
        if($this->db->Excute()){
            return true;
        }
        else{
            return false;
        }
    }
    //listing Accommodation types
    public function getAllAccomoType(){
        try{
            $this->db->query("SELECT * FROM ACCOMMODATIONTYPE");
            $AccoTypes=$this->db->ResultSet();
            return $AccoTypes;
        }catch(PDOException $ex){
            throw new PDOException($ex->getMessage(),(int)$ex->getCode());
        }
    }

    //delete Accommodation type
    public function delete($id){
     try{
         $this->db->query("DELETE FROM ACCOMMODATIONTYPE WHERE ID=:ID");

         $this->db->Bind(":ID",$id);
         if($this->db->Excute()){
            return true;
         }else{
            return false;
         }
        
     }catch(PDOException $ex){
         throw new PDOException($ex->getMessage(),$ex->getCode());
     }
     return false;
    }

    //get accommodation type by it's ID 
    public function getAccoTypeByID($id){
       try{
          $this->db->query("SELECT * FROM ACCOMMODATIONTYPE WHERE ID=:ID");
          $this->db->Bind(":ID",$id);
          $Row=$this->db->Single();
          
           return $Row;

       }catch(PDOException $ex){
        throw new PDOException($ex->getMessage(),$ex->getCode());
       }

    }
    //update accommodation type
    public function update($data){
      try{
        $this->db->query("UPDATE ACCOMMODATIONTYPE SET NAME=:NAME,DESCRIPTION=:DESCRIPTION WHERE ID=:ID");
        $this->db->Bind(":NAME",$data['Name']);
        $this->db->Bind(":DESCRIPTION",$data['Description']);
        $this->db->Bind(":ID",$data['ID']);
        if($this->db->Excute()){
         return true;
        }else{
         return false;
        }
      }catch(PDOException $ex)
      {
          throw new PDOException($ex->getMessage(),$ex->getCode());
      }
    }
}