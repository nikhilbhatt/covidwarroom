<?php

class UserResourcesModel{
    protected $db='';
    public function __construct()
    {
        $this->db=new Database();
    }
    public function getData()
    {
        $this->db->query('SELECT * FROM approvedresources WHERE date IN (SELECT max(date) FROM approvedresources WHERE district=:district) AND district=:district');
        $this->db->bindvalues(':district',$_SESSION['district']);
        return $this->db->resultSet();
    }

}

?>