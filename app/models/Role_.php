<?php
class Role_
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function Add($data)
    {
        $this->db->query('INSERT INTO ROLE(NAME) VALUES(:NAME)');
        $this->db->Bind(":NAME", $data['Role']);
        if ($this->db->Excute()) {
            $this->db->query('SELECT MAX(ID) AS ID FROM ROLE');
            $Role = $this->db->Single();
            for ($i = 0; $i < count($data['Privileges']); $i++) {
                $this->db->query("INSERT INTO PRIVILEGE(LEVEL,ROLE_ID) VALUES(:LEVEL,:ROLE_ID)");
                $this->db->Bind(":LEVEL", $data['Privileges'][$i]);
                $this->db->Bind(":ROLE_ID", $Role->ID);
                $this->db->Excute();
            }
            return true;
        } else {
            return false;
        }
    }
    //listing 
    public function getAllRole()
    {
        try {
            $this->db->query("SELECT * FROM ROLE");
            $Book = $this->db->ResultSet();
            return $Book;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }

    //delete 
    public function delete($id)
    {
        try {
            $this->db->query("DELETE FROM ROLE WHERE ID=:ID");

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

    //search  not donne yet
    //serching with 
    public function search($search)
    {
        try {
            $this->db->query("SELECT ID,NAME,LEVEL,ROLE_ID FROM ROLE R INNER JOIN PRIVILEGE P ON R.ID=P.ROLE_ID WHERE UPPER(R.NAME) LIKE CONCAT('%',:NAME,'%') OR UPPER(LEVEL)=:LEVEL");
            $this->db->Bind(":NAME", $search);
            $this->db->Bind(":LEVEL", $search);
            $result = $this->db->ResultSet();
            return $result;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
    }
    //get controllers name 
    public function getAllPrivileges()
    {
        $files = scandir(APPROOT . "/controllers/");
        $controllers = [];
        for ($i = 0; $i < count($files); $i++) {
            array_push($controllers, str_replace(".php", "", $files[$i]));
        }
        $controllers = array_diff($controllers, array('.', '..'));
        return $controllers;
    }
    //get privileges from database
    public function getPrivileges()
    {
        try {
            $this->db->query("SELECT * FROM PRIVILEGE");
            $Book = $this->db->ResultSet();
            return $Book;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }
}
