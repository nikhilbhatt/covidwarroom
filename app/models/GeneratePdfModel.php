<?php

class GeneratePdfModel{
    protected $db='';
    public function __construct()
    {
        $this->db=new Database();
    }

    public function getFilteredData($data)
    {
        $this->db->query('SELECT * FROM approvedresources WHERE DATE(date)=:date AND district=:district');
        $this->db->bindvalues(':date',$data['date']);
        $this->db->bindvalues(':district',$_SESSION['district']);
        $res=$this->db->resultSet();
        return $res;
    }

    public function getFilteredStateData($data)
    {
        $this->db->query('SELECT * FROM approvedresources WHERE DATE(date)=:date AND district=:district');
        $this->db->bindvalues(':date',$data['date']);
        $this->db->bindvalues(':district',$data['district']);
        $res=$this->db->resultSet();
        return $res;
    }
}

?>