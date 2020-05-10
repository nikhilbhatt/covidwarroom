<?php

class StateResourcesModel{
    protected $db='';
    public function __construct()
    {
        $this->db=new Database();
    }
    public function getStateData()
    {
        $this->db->query('SELECT * FROM notapprovedresources');
        return $this->db->resultSet();
    }
    public function addKits($data)
    {
        $this->db->query('INSERT INTO notapprovedresources(district,ppekits,n95,vtm,ventilator) VALUES(:district,:ppe,:n95,:vtm,:ventilator)');
        $this->db->bindvalues(':district',$data['district']);
        $this->db->bindvalues(':ppe',$data['ppekits']);
        $this->db->bindvalues(':n95',$data['n95']);
        $this->db->bindvalues(':vtm',$data['vtm']);
        $this->db->bindvalues(':ventilator',$data['ventilator']);
        return $this->db->execute();
    }

    public function updateKits($data){
        $this->db->query('UPDATE notapprovedresources SET district=:district,ppekits=:ppe,n95=:n95,vtm=:vtm,ventilator=:ventilator,date=now () WHERE id=:id');
        $this->db->bindvalues(':district',$data['district']);
        $this->db->bindvalues(':ppe',$data['ppekits']);
        $this->db->bindvalues(':n95',$data['n95']);
        $this->db->bindvalues(':vtm',$data['vtm']);
        $this->db->bindvalues(':ventilator',$data['ventilator']);
        $this->db->bindvalues(':id',$data['id']);
        return $this->db->execute();
    }
}

?>