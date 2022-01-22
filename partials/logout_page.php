<?php
if(!isset($_SESSION)) //IF SESSION IS NOT STARTED THEN START IT ELSE MOVEON I USED THIS TO AVOID RESTARTING OF DUPLICATE SESSION ERROR//
{ 
    session_start(); 
}
//session_unset();//UNSET SESSION VARIABLES//
session_destroy();//DESTROY SESSION//
header("location:/forum/");
exit();
?>