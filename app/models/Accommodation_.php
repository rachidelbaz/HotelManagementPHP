<?php
class Accommodation_
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function Add($data)
    {
        $this->db->query('INSERT INTO ACCOMMODATION(ACCOMMODATIONPACKAGE_ID,NAME) VALUES(:ACCOMMODATIONPACKAGE_ID,:NAME)');
        $this->db->Bind(":ACCOMMODATIONPACKAGE_ID", $data['AccommoPackage']);
        $this->db->Bind(":NAME", $data['Name']);

        if ($this->db->Excute()) {
            return true;
        } else {
            return false;
        }
    }
    //listing Accommodation 
    public function getAllAccomo()
    {
        try {
            $this->db->query("SELECT * FROM ACCOMMODATION");
            $Accommo = $this->db->ResultSet();
            return $Accommo;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }

    //delete Accommodation 
    public function delete($id)
    {
        try {
            $this->db->query("DELETE FROM ACCOMMODATION WHERE ID=:ID");

            $this->db->Bind(":ID", $id);
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

    //get accommodation by it's ID 
    public function getAccommoByID($id)
    {
        try {
            $this->db->query("SELECT * FROM ACCOMMODATION WHERE ID=:ID");
            $this->db->Bind(":ID", $id);
            $Row = $this->db->Single();

            return $Row;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
    }
    //update accommodation package
    public function update($data)
    {
        try {
            $this->db->query("UPDATE ACCOMMODATION SET ACCOMMODATIONPACKAGE_ID=:ACCOMMODATIONPACKAGE_ID,NAME=:NAME WHERE ID=:ID");
            $this->db->Bind(":ACCOMMODATIONPACKAGE_ID", $data['AccommoPackage']);
            $this->db->Bind(":NAME", $data['Name']);
            $this->db->Bind(":ID", $data['ID']);
            if ($this->db->Excute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
    }
    //search for accommodation
    public function search($search)
    {
        try {
            $this->db->query("SELECT * FROM ACCOMMODATION WHERE UPPER(NAME) LIKE CONCAT('%',:NAME,'%')");
            $this->db->Bind(":NAME", $search);
            $result = $this->db->ResultSet();
            return $result;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
    }
}
