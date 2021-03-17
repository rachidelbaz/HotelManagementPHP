<?php
class User_
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function Add($data)
    {
        $this->db->query('INSERT INTO USER(CIN,FULLNAME,EMAIL,PHONENUMBER) VALUES(:CIN,:FULLNAME:EMAIL,:PHONENUMBER)');
        $this->db->Bind(":CIN", $data['CIN']);
        $this->db->Bind(":FULLNAME", $data['Fullname']);
        $this->db->Bind(":EMAIL", $data['Email']);
        $this->db->Bind(":PHONENUMBER", $data['PhoneNumber']);
        if ($this->db->Excute()) {
            return true;
        } else {
            return false;
        }
    }
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
        $this->db->Bind(":FULLNAME", $data['Fullname']);
        $this->db->Bind(":CIN", $data['CIN']);
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
}
