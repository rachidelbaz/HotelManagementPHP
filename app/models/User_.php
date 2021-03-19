<?php
class User_
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    private function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = password_hash(substr(str_shuffle($alphabet), 0, 8), PASSWORD_DEFAULT);
        echo $pass;
        return $pass;
    }
    public function Add($data)
    {
        //Prepar query
        $this->db->Query("INSERT INTO USER(CIN,FULLNAME,EMAIL,NUMBERPHONE,PASSWORD) VALUES(:CIN,:FULLNAME,:EMAIL,:NUMBERPHONE,:PASSWORD)");
        //bind values 
        $this->db->Bind(":CIN", $data["CIN"]);
        $this->db->Bind(":FULLNAME", $data["Fullname"]);
        $this->db->Bind(":EMAIL", $data["Email"]);
        $this->db->Bind(":NUMBERPHONE", $data["Phonenumber"]);
        $this->db->Bind(":PASSWORD", $this->randomPassword());
        if ($this->db->Excute()) {
            return true;
        } else {
            return false;
        }
    }
    /*public function Add($data)
    {
        try {
            $this->Register($data);
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }*/
    //listing 
    public function getAllClients()
    {
        try {
            $this->db->query("SELECT * FROM USER WHERE CIN NOT IN(SELECT USER_ID FROM USERROLE)");
            $Clients = $this->db->ResultSet();
            return $Clients;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }

    //delete 
    public function delete($id)
    {
        try {
            $this->db->query("DELETE FROM USER WHERE CIN=:CIN");

            $this->db->Bind(":CIN", $id);
            if ($this->db->Excute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
        return false;
    }
    //Edit
    public function update($data)
    {
        $this->db->query('UPDATE USER SET CIN=:CIN,FULLNAME=:FULLNAME,EMAIL=:EMAIL,NUMBERPHONE=:NUMBERPHONE WHERE CIN=:CIN');
        $this->db->Bind(":CIN", $data["CIN"]);
        $this->db->Bind(":FULLNAME", $data["Fullname"]);
        $this->db->Bind(":EMAIL", $data["Email"]);
        $this->db->Bind(":NUMBERPHONE", $data["Phonenumber"]);
        if ($this->db->Excute()) {
            return true;
        } else {
            return false;
        }
    }
    //search  not donne yet
    //serching with 
    public function search($search)
    {
        try {
            $this->db->query("SELECT * FROM USER WHERE UPPER(FULLNAME) LIKE CONCAT('%',:FULLNAME,'%') OR UPPER(CIN)=:CIN");
            $this->db->Bind(":FULLNAME", $search);
            $this->db->Bind(":CIN", $search);
            $result = $this->db->ResultSet();
            return $result;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
    }

    public function getUserByID($id)
    {
        try {
            $this->db->query("SELECT * FROM USER WHERE CIN=:CIN");
            $this->db->Bind(":CIN", $id);
            $user = $this->db->Single();
            return $user;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }
    public function getUserByCIN($id)
    {
        try {
            $this->db->query("SELECT * FROM USER WHERE CIN=:CIN");
            $this->db->Bind(":CIN", $id);
            if ($this->db->Count() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }
    public function getUserByEmail($email)
    {
        try {
            $this->db->query("SELECT * FROM USER WHERE EMAIL=:EMAIL");
            $this->db->Bind(":EMAIL", $email);
            if ($this->db->Count() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }
}
