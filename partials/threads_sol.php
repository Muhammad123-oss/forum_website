<?php
if(!isset($_SESSION))
{
    session_start();
}
require 'C:/xampp/htdocs/forum/partials/db_connect.php';
$show_Alert=false;
$id=$_GET['thread_id'];
if($_SERVER['REQUEST_METHOD']=='POST')
{
  $thread_response=$_POST['comment_area'];
  $username=$_SESSION['login_username'];

  //In order to avoid any attack in the form of a user type html/javascript command on input and then it executes//
  $thread_response=htmlentities($thread_response,ENT_QUOTES);//Convert all applicable characters to HTML entities//
  
  //echo $thread_response
  $sql="INSERT INTO `comments` (`comment_content`, `thread_id`,`comment_by`,`comment_time`) VALUES ('$thread_response', '$id','$username', current_timestamp());";
  $query_success=mysqli_query($conn,$sql);
  //echo"WTF1";
  if($query_success)
    {
     // echo"WTF02";
        $show_Alert=true;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Responses!</title>
</head>

<body>
    <?php include "C:/xampp/htdocs/forum/partials/header.php";
  if($show_Alert)
  {
      echo'
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your Response has been added successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      ';
  }
  ?>

    <!-- THREAD DETAILS -->
    <div class="container my-4 bg-primary p-2 text-dark bg-opacity-25">
        <?php
    $sql="SELECT * FROM `threads` where thread_id='$id'";
    $result=mysqli_query($conn,$sql);
    while($row2=mysqli_fetch_assoc($result))
    {
      $title=$row2['thread_title'];
      $desc=$row2['thread_description'];
      $user=$row2['user_id'];
      echo'
          <h5 class="mt-0">'.$title.'</h5> 
          <p>'.$desc.'</p>
          <p class="fw-bold">Posted by User Id: '.$user.'</p>
        ';
      }
    ?>
    </div>
    <!-- Post a Comment container -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true)
    {
        echo'
    <div class="container mb-5">
        <h3>Post a Comment</h3>
        <!-- TO POST REQUEST/ACTION TO SAME PAGE WE USE "REQUEST_URI" -->
        <form class="mb-3" action=" '.$_SERVER['REQUEST_URI'].' " method="POST">
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Write a comment here..." id="comment_area"
                    name="comment_area" style="height: 100px" required></textarea>
                <label for="comment_area">Comment</label>
            </div>
            <button type="submit" class="btn btn-success">Post a Comment</button>
        </form>
    </div>';
    }
    else
    {
        echo'
        <div class="container mb-5">
        <h3>Post a Comment</h3>
        <p class="lead">You have to loggedin in order to post a comment</p>
        </div>';
    }
    ?>
    <!-- Discussion CONTAINER -->
    <div class="container">
    <?php
     $noresult=true;
     $sql="SELECT * FROM `comments` where thread_id='$id'";
     $result=mysqli_query($conn,$sql);
     while($row3=mysqli_fetch_assoc($result))
     {
        $noresult=false;
         $comment_content=$row3['comment_content'];
         $comment_id=$row3['comment_id'];
         $comment_time=strtotime($row3['comment_time']);
         $comment_by=$row3['comment_by'];
         $date = date('d-m-Y', $comment_time);
         echo'
        <div class="d-flex mb-2">
            <div class="flex-shrink-0">
            <img src="/forum/img/pic1.jpg" width=35px alt="...">
            </div>
            <div class="flex-grow-1 ms-2">
            <p class="fw-bold m-0">'.$comment_by.' At <span>'.$date.'</span></p>
            <p class="border border-info px-2 py-1">'.$comment_content.'</p>
            </div>
        </div>
         ';
     }


    
    ?>
    </div>

    <?php
        if($noresult)
        {
            echo '
            <div class=" container alert alert-success" role="alert">
            <p class="display-5">No Response Found</p>
            Be The Fisrt To Respond
            </div>';
        }
        ?>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>