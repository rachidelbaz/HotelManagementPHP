<?php
class Booking_
{
    private $db;
    private $status;
    public function __construct()
    {
        $this->db = new Database;
        $this->status = new enum;
    }
    public function Add($data)
    {
        $this->db->query('INSERT INTO BOOKING(ACCOMMODATION_ID,FROMDATE,DURATION,STATUS,CLIENT_ID) VALUES(:ACCOMMODATION_ID,:FROMDATE,:DURATION,:STATUS,:CLIENT_ID)');
        $this->db->Bind(":ACCOMMODATION_ID", $data['Accommodation']);
        $this->db->Bind(":FROMDATE", $data['Date']);
        $this->db->Bind(":DURATION", $data['Duration']);
        $this->db->Bind(":CLIENT_ID", $data['CIN']);
        $this->db->Bind(":STATUS", $this->status->PENDING); //add a booking with deafult value 1 : pending

        if ($this->db->Excute()) {
            return true;
        } else {
            return false;
        }
    }
    //listing Booking
    public function getAllBooking()
    {
        try {
            $this->db->query("SELECT * FROM BOOKING");
            $Book = $this->db->ResultSet();
            return $Book;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }

    //delete Accommodation 
    public function delete($id)
    {
        try {
            $this->db->query("DELETE FROM BOOKING WHERE ID=:ID");

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

    //get booking by it's ID 
    public function getBookingByID($id)
    {
        try {
            $this->db->query("SELECT * FROM BOOKING WHERE ID=:ID");
            $this->db->Bind(":ID", $id);
            $Row = $this->db->Single();

            return $Row;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
    }
    //update booking
    public function update($data)
    {
        try {
            $this->db->query("UPDATE BOOKING SET ACCOMMODATION_ID=:ACCOMMODATION_ID,FROMDATE=:FROMDATE,DURATION=:DURATION,STATUS=:STATUS WHERE ID=:ID");
            $this->db->Bind(":ACCOMMODATION_ID", $data['Accommodation']);
            $this->db->Bind(":FROMDATE", $data['Date']);
            $this->db->Bind(":DURATION", $data['Duration']);
            $this->db->Bind(":STATUS", $data['Status']);
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
    //search for booking not donne yet
    public function search($search)
    {
        try {
            $this->db->query("SELECT * FROM BOOKING B INNER JOIN ACCOMMODATION A ON B.ACCOMMODATION_ID=A.ID WHERE UPPER(A.NAME) LIKE CONCAT('%',:NAME,'%')");
            $this->db->Bind(":NAME", $search);
            $result = $this->db->ResultSet();
            return $result;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), $ex->getCode());
        }
    }
}
