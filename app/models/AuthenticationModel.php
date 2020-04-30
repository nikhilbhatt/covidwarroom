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
}

?>