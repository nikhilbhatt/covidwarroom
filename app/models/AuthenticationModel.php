<?php

class AuthenticationModel{
    protected $db;
    public function __construct()
    {
        $this->db=new Database();
    }

    public function Login($data)
    {
        $this->db->query('SELECT * FROM users WHERE username=:username AND password=:password AND type=:type');
        $this->db->bindvalues(':username',$data['username']);
        $this->db->bindvalues(':password',$data['password']);
        $this->db->bindvalues(':type',$data['type']);
        $res=$this->db->single();
        if($this->db->rowcount()>0)
        {
            if(PHP_SESSION_NONE)
            {
                session_start();
            }
            $_SESSION['type']=$res->type;
            $_SESSION['username']=$res->username;
            $_SESSION['name']=$res->name;
            $_SESSION['district']=$res->district;
            return true;
        }
        {
            return false;
        }
    }

    public function getUsers()
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }
        if($_SESSION['type']=='statecontrolroom')
        {
            $type='districtauthority';
            $this->db->query('SELECT * FROM users WHERE type=:type OR type="districtuser"');
        }
        elseif($_SESSION['type']=='districtauthority')
        {
            $type='districtuser';
            $district=$_SESSION['district'];
            $this->db->query('SELECT * FROM users WHERE type=:type AND district=:district');
            $this->db->bindvalues(':district',$district);
        }
        $this->db->bindvalues(':type',$type);
        return $this->db->resultSet();
    }

    public function checkUserNameExist($username)
    {
        $this->db->query('SELECT * FROM users WHERE username=:username');
        $this->db->bindvalues(':username',$username);
        $res=$this->db->resultSet();
        if($this->db->rowCount()>0)
        {
            return true;
        }
        else{
            return false;
        }

    }
    public function addNew($data)
    {
        $this->db->query('INSERT INTO users(name,username,password,type,tehsil,district) VALUES(:name,:username,:password,:type,:tehsil,:district)');
        $this->db->bindvalues(':name',$data['name']);
        $this->db->bindvalues(':username',$data['username']);
        $this->db->bindvalues(':type',$data['type']);
        $this->db->bindvalues(':password',$data['password']);
        $this->db->bindvalues(':tehsil',$data['tehsil']);
        $this->db->bindvalues(':district',$data['district']);
        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function checkUserNameChanged($username,$id)
    {
        $this->db->query('SELECT * FROM users WHERE id=:id');
        $this->db->bindvalues(':id',$id);
        $res=$this->db->single();
        if($res->username==$username)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function editUserData($data)
    {
        $this->db->query('UPDATE users SET name=:name,username=:username,tehsil=:tehsil,district=:district WHERE id=:id');
        $this->db->bindvalues(':name',$data['name']);
        $this->db->bindvalues(':username',$data['username']);
        $this->db->bindvalues(':tehsil',$data['tehsil']);
        $this->db->bindvalues(':district',$data['district']);
        $this->db->bindvalues(':id',$data['id']);
        return $this->db->execute();
    }

    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM users WHERE id=:id');
        $this->db->bindvalues(':id',$id);
        return $this->db->execute();
    }

    public function updatePassword($data)
       {
            if(session_status()==PHP_SESSION_NONE)
            {
              session_start();   
            }
            $this->db->query('UPDATE users SET password=:password WHERE username=:username');
            $this->db->bindvalues(':password',$data['password']);
            $this->db->bindvalues(':username',$_SESSION['username']);
            return $this->db->execute();
       }
}

?>