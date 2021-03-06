<?php
class Accommodation_Package
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function Add($data)
    {
        $this->db->query('INSERT INTO ACCOMMODATIONPACKAGE(ACCOMMODATIONTYPE_ID,NAME,NOFROOM,FEEPERNIGHT) VALUES(:ACCOMMODATIONTYPE_ID,:NAME,:NOFROOM,:FEEPERNIGHT)');
        $this->db->Bind(":ACCOMMODATIONTYPE_ID", $data['AccommoType']);
        $this->db->Bind(":NAME", $data['Name']);
        $this->db->Bind(":NOFROOM", $data['RoomN']);
        $this->db->Bind(":FEEPERNIGHT", $data['Fee']);

        if ($this->db->Excute()) {
            return true;
        } else {
            return false;
        }
    }
    //listing Accommodation package
    public function getAllAccomoPackage()
    {
        try {
            $this->db->query("SELECT * FROM ACCOMMODATIONPACKAGE");
            $AccoPackage = $this->db->ResultSet();
            return $AccoPackage;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }

    //delete Accommodation package
    public function delete($id)
    {
        try {
            $this->db->query("DELETE FROM ACCOMMODATIONPACKAGE WHERE ID=:ID");

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

    //get accommodation package by it's ID 
    public function getAccoPackageByID($id)
    {
        try {
            $this->db->query("SELECT * FROM ACCOMMODATIONPACKAGE WHERE ID=:ID");
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
            $this->db->query("UPDATE ACCOMMODATIONPACKAGE SET ACCOMMODATIONTYPE_ID=:ACCOMMODATIONTYPE_ID,NAME=:NAME,NOFROOM=:NOFROOM,FEEPERNIGHT=:FEEPERNIGHT WHERE ID=:ID");
            $this->db->Bind(":ACCOMMODATIONTYPE_ID", $data['AccommoType']);
            $this->db->Bind(":NAME", $data['Name']);
            $this->db->Bind(":NOFROOM", $data['RoomN']);
            $this->db->Bind(":FEEPERNIGHT", $data['Fee']);
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
    //search for accommodation package
    public function search($search)
    {
        try {
            $this->db->query("SELECT * FROM ACCOMMODATIONPACKAGE WHERE UPPER(NAME) LIKE CONCAT('%',:NAME,'%')");
            $this->db->Bind(":NAME", $search);
            $result = $this->db->ResultSet();
            return $result;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
    }
}
