<?php
$username="root";
$server="localhost";
$password="";
$database="idiscuss";

$conn=mysqli_connect($server,$username,$password,$database);
if($conn)
{
  //  echo"DB CONNECTED";
}
else
{
    die("error".mysqli_connect_error());
}
?>