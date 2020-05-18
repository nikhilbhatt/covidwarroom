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

    public function getLatestData()
    {
        $this->db->query('SELECT * FROM approvedresources WHERE date IN(SELECT MAX(date) from approvedresources WHERE district=:district) AND district=:district');
        $this->db->bindvalues(':district',$_SESSION['district']);
        $res=$this->db->single();
        return $res;
    }

    public function getLatestStateData($district)
    {
        $this->db->query('SELECT * FROM approvedresources WHERE date IN(SELECT MAX(date) from approvedresources WHERE district=:district) AND district=:district');
        $this->db->bindvalues(':district',$district);
        $res=$this->db->single();
        return $res;
    }
    
}

?>