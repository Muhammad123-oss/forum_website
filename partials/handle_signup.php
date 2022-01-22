<!-- WE CREATE THIS PAGE IN ORDER TO AVOID TWO "POST" REQUEST/ACTION ON SAME PAGE THAT IS NOT POSSIBLE -->
<?php
$insert=false;
$show_error=false;
$errorsms;

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $hold=require 'C:/xampp/htdocs/forum/partials/db_connect.php';//CONNECTING TO DB//
    if($hold)//IF TRUE THEN DB CONNECTED//
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirmpassword=$_POST['confirmpassword'];
        
        $sql="SELECT * FROM `idiscuss_user` where username='$username'";//SQL QUERY TO CHECK IF USERNAME ALREADY EXSIST OR NOT//
        $result_exist=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result_exist);//TELL NUMBER OF ROWS FETCHED//
        if($num==1)//MEANS RECORD EXIST//
        {
            $show_error=true;
            $errorsms="UserName AlReady Exist";            
        }
        else
        {
        
        if($password==$confirmpassword)
        {
         //SQL INSERT QUERY//
         $hash=password_hash($password,PASSWORD_DEFAULT);//FUNC USED TO BCRYPT OUR PASSWORD SO EVEN IF OUR DATABASE IS HACKED NO ONE CAN ACCESS USER PASSWORD//
         $sql="INSERT INTO `idiscuss_user` (`username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
         $result=mysqli_query($conn,$sql);
         if($result)
         {
             $insert=true;
             session_start();
             $_SESSION['signup']=true;
             $_SESSION['errorsms']="SignUp And Login Successfully";
             header("location:/forum/index.php");//BACK TO INDEX PAGE//
             exit();
         }
        }
        else
        {
            $show_error=true;
            $errorsms="Password HasNot Matched";
        }
        }
    }
}
?>
