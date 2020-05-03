<?php
    
    function isLoggedIn($type)
    {
        if(session_status()==PHP_SESSION_NONE)
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