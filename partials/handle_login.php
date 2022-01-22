<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $hold=require 'C:/xampp/htdocs/forum/partials/db_connect.php';//CONNECTING TO DB//
    $login_username=$_POST['login_username'];
    $login_password=$_POST['login_password'];
    $sql="SELECT * FROM `idiscuss_user` where username='$login_username'";
    $result_exist=mysqli_query($conn,$sql);
    if($result_exist)
    {
        while($row= mysqli_fetch_assoc($result_exist))//fetch FUNC RETURNS A ROW AS AN ASSOCIATE ARRAY(KEY,VALUE) IF NO ROW AVAILABLE IT RETURN FALSE//
          {
              if(password_verify($login_password,$row['password']))//VERIFY FUNC COMPARE GIVEN PASSWORD WITH PASSWORD HASH IN DATABASE(ROW['PASSWORD']) THEN RETURN BOOLEAN//
              {
                session_start();//HERE OUR SESSION START.INFO UNDER SESSION CAN BE ACCESSED ACCROSS FILES.IT STORE/MANAGES INFO//
                $_SESSION['loggedin']=true;
                $_SESSION['login_username']=$login_username;
                $_SESSION['errorsms']="Login Successfully";
                header("location:/forum/index.php");//BACK TO INDEX PAGE//
                exit();
              }
              else
              {
                header("location:/forum/index.php");
             //   echo "INVALIDPASS";
              //ERROR//
              }
          }   
    }
    else
    {
        header("location:/forum/index.php");
       // echo "INVALID1";
        //ERROR//
    }
}
?>
