<?php
 class Logout{
     public function __construct()
     {

     }
     public function index()
     {
         if(session_status()==PHP_SESSION_NONE)
         {
             session_start();
         }
         session_unset();
         session_destroy();
         echo '<script>alert("Logout Successful");location="'.URLROOT.'/Login"</script>';

     }
 }

?>