<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($email, $password)
    {
        //i HASH a new passwors cause i forget the old one ,and i want to modify it from database 
        // print(password_hash($password, PASSWORD_DEFAULT));

        $this->db->Query("SELECT * FROM USER WHERE EMAIL=:EMAIL");
        //bind values
        $this->db->Bind(":EMAIL", $email);
        //return a single row
        $Row = $this->db->Single();
        $HashedPassword = $Row->Password;
        //verify if the hashed password & password entred by the user are the same
        if (password_verify($password, $HashedPassword)) {
            return $Row;
        } else {
            return false;
        }
    }


    public function FindUser($data)
    {
        $this->db->Query("SELECT * FROM USER WHERE EMAIL=:EMAIL OR CIN=:CIN");
        //bind values
        $this->db->Bind(":EMAIL", $data['Email']);
        $this->db->Bind(":CIN", $data["CIN"]);
        if ($this->db->Count() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function Register($data)
    {
        //Prepar query
        $this->db->Query("INSERT INTO USER(CIN,FULLNAME,EMAIL,NUMBERPHONE,PASSWORD) VALUES(:CIN,:FULLNAME,:EMAIL,:NUMBERPHONE,:PASSWORD)");
        //bind values 
        $this->db->Bind(":CIN", $data["CIN"]);
        $this->db->Bind(":FULLNAME", $data["Fullname"]);
        $this->db->Bind(":EMAIL", $data["Email"]);
        $this->db->Bind(":NUMBERPHONE", $data["NumberPhone"]);
        $this->db->Bind(":PASSWORD", $data["Password"]);
        //excute query
        if ($this->db->Excute()) {
            return true;
        } else {
            return false;
        }
    }
}
