<?php
 class Logout{
     public function __construct()
     {

     }
     public function index()
     {
         if(PHP_SESSION_NONE)
         {
             session_start();
         }
         session_unset($_SESSION['type']);
         session_unset($_SESSION['username']);
         session_unset($_SESSION['district']);
         session_destroy();
     }
 }

?>