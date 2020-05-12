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
    public function getApproved()
    {
        $this->db->query('SELECT * FROM approvedresources WHERE date IN(SELECT MAX(date) FROM approvedresources GROUP BY district)');
        return $this->db->resultSet();
    }

    public function getDistrictResources()
    {
        $this->db->query('SELECT * FROM approvedresources WHERE date IN(SELECT MAX(date) FROM approvedresources WHERE district=:district) AND district=:district');
        $this->db->bindvalues(':district',$_SESSION['district']);
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
        $this->db->query('UPDATE notapprovedresources SET district=:district,ppekits=:ppe,n95=:n95,vtm=:vtm,ventilator=:ventilator,date=now() WHERE id=:id');
        $this->db->bindvalues(':district',$data['district']);
        $this->db->bindvalues(':ppe',$data['ppekits']);
        $this->db->bindvalues(':n95',$data['n95']);
        $this->db->bindvalues(':vtm',$data['vtm']);
        $this->db->bindvalues(':ventilator',$data['ventilator']);
        $this->db->bindvalues(':id',$data['id']);
        return $this->db->execute();
    }

    public function approveKits($data)
    {
        $this->db->query('SELECT * FROM approvedresources WHERE date IN(SELECT MAX(date) FROM approvedresources WHERE district=:district) AND district=:district');
        $this->db->bindvalues(':district',$_SESSION['district']);
        $result=$this->db->single();
        // echo '<pre>';
        // var_dump($result);
        // echo '</pre>';
        // die();
        
        $this->db->query('SELECT * FROM approvedresources WHERE date(date)=date(now()) AND district=:district');
        $this->db->bindvalues(':district',$_SESSION['district']);
        $res=$this->db->single();
        if($this->db->rowCount()>0)
        {
            //update table row
            $this->db->query('UPDATE approvedresources SET ppekitsaddedtoday=:ppetoday,ppekitsvacanttoday=:ppevacant,ppekitscumulative=:ppecumulative,
                ppekitsvacantcumulative=:ppevacantcumulative,vtmaddedtoday=:vtmtoday,vtmvacanttoday=:vtmvacant,vtmcumulative=:vtmcumulative,vtmvacantcumulative=:vtmvacantcumulative,
                n95addedtoday=:n95today,n95vacanttoday=:n95vacant,n95cumulative=:n95cumulative,n95vacantcumulative=:n95vacantcumulative,
                ventilatorcumulative=:ventilatorcumulative,ventilatorvacantcumulative=:ventilatorvacant, date=now() 
                WHERE id=:id
              ');
            $this->db->bindvalues(':id',$res->id);
            $this->db->bindvalues(':ppetoday',(int)$res->ppekitsaddedtoday+$data['ppekits']);
            $this->db->bindvalues(':ppevacant',(int)$res->ppekitsvacanttoday+$data['ppekits']);
            $this->db->bindvalues(':ppecumulative',(int)$res->ppekitscumulative+$data['ppekits']);
            $this->db->bindvalues(':ppevacantcumulative',(int)$res->ppekitsvacantcumulative+$data['ppekits']);
            $this->db->bindvalues(':vtmtoday',(int)$res->vtmaddedtoday+$data['vtm']);
            $this->db->bindvalues(':vtmvacant',(int)$res->vtmvacanttoday+$data['vtm']);
            $this->db->bindvalues(':vtmcumulative',(int)$res->vtmcumulative+$data['vtm']);
            $this->db->bindvalues(':vtmvacantcumulative',(int)$res->vtmvacantcumulative+$data['vtm']);
            $this->db->bindvalues(':n95today',(int)$res->n95addedtoday+$data['n95']);
            $this->db->bindvalues(':n95vacant',(int)$res->n95vacanttoday+$data['n95']);
            $this->db->bindvalues(':n95cumulative',(int)$res->n95cumulative+$data['n95']);
            $this->db->bindvalues(':n95vacantcumulative',(int)$res->n95vacantcumulative+$data['n95']);
            $this->db->bindvalues(':ventilatorcumulative',(int)$res->ventilatorcumulative+$data['ventilator']);
            $this->db->bindvalues(':ventilatorvacant',(int)$res->ventilatorvacantcumulative+$data['ventilator']);
            $this->db->execute();
        }
        else
        {
            //insert new row
            $this->db->query('INSERT INTO 
            approvedresources(
                ppekitsaddedtoday,ppekitsvacanttoday,ppekitsusedtoday,ppekitscumulative,ppekitsusedcumulative,ppekitsvacantcumulative,
                vtmaddedtoday,vtmusedtoday,vtmvacanttoday,vtmcumulative,vtmusedcumulative,vtmvacantcumulative,
                n95addedtoday,n95usedtoday,n95vacanttoday,n95cumulative,n95usedcumulative,n95vacantcumulative,
                ventilatorcumulative,ventilatorusedcumulative,ventilatorvacantcumulative,district,
                patientbedcumulative,patientbedusedcumulative,patientbedvacantcumulative,
                quarantinebedcumulative,quarantinebedusedcumulative,quarantinebedvacantcumulative,
                icucumulative,icuusedcumulative,icuvacantcumulative
                )
            VALUES(
                    :ppetoday,:ppevacant,:ppekitsusedtoday,:ppecumulative,:ppekitsusedcumulative,:ppevacantcumulative,
                    :vtmtoday,:vtmusedtoday,:vtmvacant,:vtmcumulative,:vtmusedcumulative,:vtmvacantcumulative,
                    :n95today,:n95usedtoday,:n95vacant,:n95cumulative,:n95usedcumulative,:n95vacantcumulative,
                    :ventilatorcumulative,:ventilatorusedcumulative,:ventilatorvacant,:district,
                    :patientbedcumulative,:patientbedusedcumulative,:patientbedvacantcumulative,
                    :quarantinebedcumulative,:quarantinebedusedcumulative,:quarantinebedvacantcumulative,
                    :icucumulative,:icuusedcumulative,:icuvacantcumulative
                    )
              ');

            $this->db->bindvalues(':ppetoday',$data['ppekits']);
            $this->db->bindvalues(':ppekitsusedtoday',(int)$result->ppekitsusedtoday);
            $this->db->bindvalues(':ppevacant',$data['ppekits']);
            $this->db->bindvalues(':ppecumulative',(int)$result->ppekitscumulative+$data['ppekits']);
            $this->db->bindvalues(':ppekitsusedcumulative',(int)$result->ppekitsusedcumulative);
            $this->db->bindvalues(':ppevacantcumulative',(int)$result->ppekitsvacantcumulative+$data['ppekits']);

            $this->db->bindvalues(':vtmtoday',$data['vtm']);
            $this->db->bindvalues(':vtmusedtoday',(int)$result->vtmusedtoday);
            $this->db->bindvalues(':vtmvacant',$data['vtm']);
            $this->db->bindvalues(':vtmcumulative',(int)$result->vtmcumulative+$data['vtm']);
            $this->db->bindvalues(':vtmusedcumulative',(int)$result->vtmusedcumulative);
            $this->db->bindvalues(':vtmvacantcumulative',(int)$result->vtmvacantcumulative+$data['vtm']);

            $this->db->bindvalues(':n95today',$data['n95']);
            $this->db->bindvalues(':n95usedtoday',(int)$result->n95usedtoday);
            $this->db->bindvalues(':n95vacant',$data['n95']);
            $this->db->bindvalues(':n95cumulative',(int)$result->n95cumulative+$data['n95']);
            $this->db->bindvalues(':n95usedcumulative',(int)$result->n95usedcumulative);
            $this->db->bindvalues(':n95vacantcumulative',(int)$result->n95vacantcumulative+$data['n95']);

            $this->db->bindvalues(':ventilatorcumulative',(int)$result->ventilatorcumulative+$data['ventilator']);
            $this->db->bindvalues(':ventilatorusedcumulative',(int)$result->ventilatorusedcumulative);
            $this->db->bindvalues(':ventilatorvacant',(int)$result->ventilatorvacantcumulative+$data['ventilator']);
            $this->db->bindvalues(':district',$_SESSION['district']);

            $this->db->bindvalues(':patientbedcumulative',(int)$result->patientbedcumulative);
            $this->db->bindvalues(':patientbedusedcumulative',(int)$result->patientbedusedcumulative);
            $this->db->bindvalues(':patientbedvacantcumulative',(int)$result->patientbedvacantcumulative);
            $this->db->bindvalues(':quarantinebedcumulative',(int)$result->quarantinebedcumulative);
            $this->db->bindvalues(':quarantinebedusedcumulative',(int)$result->quarantinebedusedcumulative);
            $this->db->bindvalues(':quarantinebedvacantcumulative',(int)$result->quarantinebedvacantcumulative);
            $this->db->bindvalues(':icucumulative',(int)$result->icucumulative);
            $this->db->bindvalues(':icuusedcumulative',(int)$result->icuusedcumulative);
            $this->db->bindvalues(':icuvacantcumulative',(int)$result->icuvacantcumulative);
            $this->db->execute();
        }
       



        $this->db->query('DELETE FROM notapprovedresources WHERE id=:id');
        $this->db->bindvalues(':id',$data['id']);
        return $this->db->execute();
    }


    public function addDistrictKits($data)
    {
        $this->db->query('SELECT * FROM approvedresources WHERE date IN(SELECT MAX(date) FROM approvedresources WHERE district=:district) AND district=:district');
        $this->db->bindvalues(':district',$_SESSION['district']);
        $result=$this->db->single();
        //this function will be continued tomorrow
        $this->db->query('SELECT * FROM approvedresources WHERE date(date)=date(now()) AND district=:district');
        $this->db->bindvalues(':district',$data['district']);
        $res=$this->db->single();

        if($this->db->rowCount()>0)
        {
            //update the data
            $this->db->query('UPDATE approvedresources SET ppekitsaddedtoday=:ppetoday,ppekitsvacanttoday=:ppevacant,ppekitscumulative=:ppecumulative,
                ppekitsvacantcumulative=:ppevacantcumulative,vtmaddedtoday=:vtmtoday,vtmvacanttoday=:vtmvacant,vtmcumulative=:vtmcumulative,vtmvacantcumulative=:vtmvacantcumulative,
                n95addedtoday=:n95today,n95vacanttoday=:n95vacant,n95cumulative=:n95cumulative,n95vacantcumulative=:n95vacantcumulative,
                ventilatorcumulative=:ventilatorcumulative,ventilatorvacantcumulative=:ventilatorvacant,patientbedcumulative=:patientbedcumulative,
                patientbedvacantcumulative=:patientbedvacantcumulative,quarantinebedcumulative=:quarantinebedcumulative,quarantinebedvacantcumulative=:quarantinebedvacantcumulative,
                icucumulative=:icucumulative,icuvacantcumulative=:icuvacantcumulative, date=now() 
                WHERE id=:id
              ');
            $this->db->bindvalues(':id',$res->id);
            $this->db->bindvalues(':ppetoday',(int)$res->ppekitsaddedtoday+$data['ppekits']);
            $this->db->bindvalues(':ppevacant',(int)$res->ppekitsvacanttoday+$data['ppekits']);
            $this->db->bindvalues(':ppecumulative',(int)$res->ppekitscumulative+$data['ppekits']);
            $this->db->bindvalues(':ppevacantcumulative',(int)$res->ppekitsvacantcumulative+$data['ppekits']);
            $this->db->bindvalues(':vtmtoday',(int)$res->vtmaddedtoday+$data['vtm']);
            $this->db->bindvalues(':vtmvacant',(int)$res->vtmvacanttoday+$data['vtm']);
            $this->db->bindvalues(':vtmcumulative',(int)$res->vtmcumulative+$data['vtm']);
            $this->db->bindvalues(':vtmvacantcumulative',(int)$res->vtmvacantcumulative+$data['vtm']);
            $this->db->bindvalues(':n95today',(int)$res->n95addedtoday+$data['n95']);
            $this->db->bindvalues(':n95vacant',(int)$res->n95vacanttoday+$data['n95']);
            $this->db->bindvalues(':n95cumulative',(int)$res->n95cumulative+$data['n95']);
            $this->db->bindvalues(':n95vacantcumulative',(int)$res->n95vacantcumulative+$data['n95']);
            $this->db->bindvalues(':ventilatorcumulative',(int)$res->ventilatorcumulative+$data['ventilator']);
            $this->db->bindvalues(':ventilatorvacant',(int)$res->ventilatorvacantcumulative+$data['ventilator']);
            $this->db->bindvalues(':patientbedcumulative',(int)$res->patientbedcumulative+$data['patientbed']);
            $this->db->bindvalues(':patientbedvacantcumulative',(int)$res->patientbedvacantcumulative+$data['patientbed']);
            $this->db->bindvalues(':quarantinebedcumulative',(int)$res->quarantinebedcumulative+$data['quarantinebed']);
            $this->db->bindvalues(':quarantinebedvacantcumulative',(int)$res->quarantinebedvacantcumulative+$data['quarantinebed']);
            $this->db->bindvalues(':icucumulative',(int)$res->icucumulative+$data['icu']);
            $this->db->bindvalues(':icuvacantcumulative',(int)$res->icuvacantcumulative+$data['icu']);
            return $this->db->execute();
        }
        {
            $this->db->query('INSERT INTO 
            approvedresources(
                ppekitsaddedtoday,ppekitsvacanttoday,ppekitsusedtoday,ppekitscumulative,ppekitsusedcumulative,ppekitsvacantcumulative,
                vtmaddedtoday,vtmusedtoday,vtmvacanttoday,vtmcumulative,vtmusedcumulative,vtmvacantcumulative,
                n95addedtoday,n95usedtoday,n95vacanttoday,n95cumulative,n95usedcumulative,n95vacantcumulative,
                ventilatorcumulative,ventilatorusedcumulative,ventilatorvacantcumulative,district,
                patientbedcumulative,patientbedusedcumulative,patientbedvacantcumulative,
                quarantinebedcumulative,quarantinebedusedcumulative,quarantinebedvacantcumulative,
                icucumulative,icuusedcumulative,icuvacantcumulative)
            VALUES(
                :ppetoday,:ppevacant,:ppekitsusedtoday,:ppecumulative,:ppekitsusedcumulative,:ppevacantcumulative,
                :vtmtoday,:vtmusedtoday,:vtmvacant,:vtmcumulative,:vtmusedcumulative,:vtmvacantcumulative,
                :n95today,:n95usedtoday,:n95vacant,:n95cumulative,:n95usedcumulative,:n95vacantcumulative,
                :ventilatorcumulative,:ventilatorusedcumulative,:ventilatorvacant,:district,
                :patientbedcumulative,:patientbedusedcumulative,:patientbedvacantcumulative,
                :quarantinebedcumulative,:quarantinebedusedcumulative,:quarantinebedvacantcumulative,
                :icucumulative,:icuusedcumulative,:icuvacantcumulative)
              ');
            $this->db->bindvalues(':ppetoday',$data['ppekits']);
            $this->db->bindvalues(':ppevacant',$data['ppekits']);
            $this->db->bindvalues(':ppekitsusedtoday',(int)$result->ppekitsusedtoday);
            $this->db->bindvalues(':ppecumulative',(int)$result->ppekitscumulative+$data['ppekits']);
            $this->db->bindvalues(':ppekitsusedcumulative',(int)$result->ppekitsusedcumulative);
            $this->db->bindvalues(':ppevacantcumulative',(int)$result->ppekitsvacantcumulative+$data['ppekits']);
            $this->db->bindvalues(':vtmtoday',$data['vtm']);
            $this->db->bindvalues(':vtmusedtoday',(int)$result->vtmusedtoday);
            $this->db->bindvalues(':vtmvacant',$data['vtm']);
            $this->db->bindvalues(':vtmcumulative',(int)$result->vtmcumulative+$data['vtm']);
            $this->db->bindvalues(':vtmusedcumulative',(int)$result->vtmusedcumulative);
            $this->db->bindvalues(':vtmvacantcumulative',(int)$result->vtmvacantcumulative+$data['vtm']);
            $this->db->bindvalues(':n95today',$data['n95']);
            $this->db->bindvalues(':n95usedtoday',(int)$result->n95usedtoday);
            $this->db->bindvalues(':n95vacant',$data['n95']);
            $this->db->bindvalues(':n95cumulative',(int)$result->n95cumulative+$data['n95']);
            $this->db->bindvalues(':n95usedcumulative',(int)$result->n95usedcumulative);
            $this->db->bindvalues(':n95vacantcumulative',(int)$result->n95vacantcumulative+$data['n95']);
            $this->db->bindvalues(':ventilatorcumulative',(int)$result->ventilatorcumulative+$data['ventilator']);
            $this->db->bindvalues(':ventilatorusedcumulative',(int)$result->ventilatorusedcumulative);
            $this->db->bindvalues(':ventilatorvacant',(int)$result->ventilatorvacantcumulative+$data['ventilator']);
            $this->db->bindvalues(':district',$_SESSION['district']);
            $this->db->bindvalues(':patientbedcumulative',(int)$result->patientbedcumulative+$data['patientbed']);
            $this->db->bindvalues(':patientbedusedcumulative',(int)$result->patientbedusedcumulative);
            $this->db->bindvalues(':patientbedvacantcumulative',(int)$result->patientbedvacantcumulative+$data['patientbed']);
            $this->db->bindvalues(':quarantinebedcumulative',(int)$result->quarantinebedcumulative+$data['quarantinebed']);
            $this->db->bindvalues(':quarantinebedusedcumulative',(int)$result->quarantinebedusedcumulative);
            $this->db->bindvalues(':quarantinebedvacantcumulative',(int)$result->quarantinebedvacantcumulative+$data['quarantinebed']);
            $this->db->bindvalues(':icucumulative',(int)$result->icucumulative+$data['icu']);
            $this->db->bindvalues(':icuusedcumulative',(int)$result->icuusedcumulative);
            $this->db->bindvalues(':icuvacantcumulative',(int)$result->icuvacantcumulative+$data['icu']);
            return $this->db->execute();
        }
    }
}

?>