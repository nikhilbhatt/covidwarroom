<?php
    
    function isLoggedIn($type)
    {
        if(PHP_SESSION_NONE)
        {
            session_start();
        }
        if($_SESSION['type']==$type)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

?>