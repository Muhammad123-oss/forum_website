<?php
if(!isset($_SESSION))
{
    session_start();
}
require 'C:/xampp/htdocs/forum/partials/db_connect.php';
$show_Alert=false;
$id=$_GET['category_id'];
$sql="SELECT * FROM `categories` where category_id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $thread_title=$_POST['thread_title'];
    $thread_description=$_POST['question_desc'];

  //  echo $thread_description;
  //  echo"<br>";

    //In order to avoid any attack in the form of a user type html/javascript command on input and then it executes//
    $thread_description=htmlentities($thread_description,ENT_QUOTES);
    $thread_title=htmlentities($thread_title,ENT_QUOTES);

    // $things_to_replace=array("<",">");
    // $replacement=array("&lt;","&lt;");
    // $thread_description=str_replace($things_to_replace,$replacement,$thread_description);

    $sql="INSERT INTO `threads` (`thread_title`, `thread_description`, `user_id`, `category_id`, `Date_time`) VALUES ('$thread_title', '$thread_description', '5', '$id', current_timestamp() )";
    $query_result=mysqli_query($conn,$sql);
    if($query_result)
    {
        $show_Alert=true;
    }
}

//PAGINATION//
if (!isset ($_GET['page']) ) 
{  
    $page_num=1;  
} 
else 
{  
    $page_num=$_GET['page'];  
}  

$next_page=$page_num+1;
$previous_page=$page_num-1;
$num_query_per_page=2;

$my_query="SELECT * FROM `threads` where category_id='$id'";
$result_query=mysqli_query($conn,$my_query);
$num=mysqli_num_rows($result_query);
$count_pages=ceil($num/$num_query_per_page);
//echo $count_pages;
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>iDiscuss</title>
</head>

<body>
    <?php include "C:/xampp/htdocs/forum/partials/header.php";
        if($show_Alert)
        {
            echo'
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added successfully. Wait for community to respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    ?>
    <!-- Categories Container Start Here -->
    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading text-center">WelCome To <?php echo"$row[category_name]" ?> Forum</h4>
            <?php echo"$row[category_description]" ?>
            <h5>Forum Rules</h5>
            <p>
                No Spam / Advertising / Self-promote in the forums.<br>
                Do not post copyright-infringing material.<br>
                Do not post “offensive” posts, links or images.
            </p>
            <button type="button" class="btn btn-link">Learn More</button>
            <hr>
            <p class="mb-0 fw-bolder">Testing leads to failure, and failure leads to understanding.</p>
        </div>
    </div>

    <!-- ASK A QUESTION CONTAINER -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true) 
    {
    echo'
    <div class="container mb-5">
        <h3>Ask A Questions</h3>
        <form class="mb-3" action=" '.$_SERVER['REQUEST_URI'].' " method="POST">
            <!-- TO POST REQUEST/ACTION TO SAME PAGE WE USE "REQUEST_URI" -->
            <div class="mb-3">
                <label for="thread_title" class="form-label">Title</label>
                <input type="text" class="form-control" id="thread_title" name="thread_title"
                    aria-describedby="descHelp" required>
                <div id="descHelp" class="form-text">Keep Your Title Short And Crisp As Possible</div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Write a description here..." id="floatingTextarea2"
                    name="question_desc" style="height: 100px" required></textarea>
                <label for="floatingTextarea2">Description</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>';
    }
    else
    {
        echo'
        <div class="container mb-5">
        <h3>Ask A Questions</h3>
        <p class="lead">You have to loggedin in order to ask a question</p>
        </div>';
    }
    ?>
    <!-- QUESTIONS CONTAINER -->
    <div class="container mb-5">
        <h3>Browse Questions</h3>
        <div class="d-flex">
            <div class="flex-grow-1 ms-3">
                <?php
                $base_index=($page_num-1)*$num_query_per_page;
                //echo $base_page;
                $noresult=true;
                //The SQL query below says "return only $num_query_per_page records, start on record $base_index (OFFSET)//
                $sql="SELECT * FROM `threads` where category_id='$id' limit $base_index,$num_query_per_page";
                $result=mysqli_query($conn,$sql);
                while($row2=mysqli_fetch_assoc($result))
                {
                    $noresult=false;
                    $title=$row2['thread_title'];
                    $desc=$row2['thread_description'];
                    $thread_id=$row2['thread_id'];
                    echo'
                    <div class="flex-shrink-0">
                    <img src="/forum/img/pic1.jpg" width=45px alt="...">
                    <a class="mt-0 fw-bold" href="/forum/partials/threads_sol.php?thread_id='.$thread_id.' ">'.$title.'</a></p> 
                    <p>'.$desc.'</p>
                    </div>';
                }
                ?>
            </div>
        </div>
        <?php
        if($noresult)
        {
            echo '
            <div class="alert alert-success" role="alert">
            <p class="display-5">No Result Found</p>
            Be The Fisrt To Ask
            </div>';
        }
        ?>
    </div>

    <?php
    //NEXT AND PREVIOUS BUTTON WORKING//
    echo'
    <div class="container d-flex justify-content-around">';
        if($page_num!=1)
        {
        echo'
        <a href="/forum/partials/threads.php?category_id='.$id.'&page='.$previous_page.'" class="btn btn-primary">Previous</a>';
        }
        else
        {
            echo'
            <button type="button" class="btn btn-primary" disabled>Previous</button>';
        }
        
        if($page_num<$count_pages)
        {
        echo'
        <a href="/forum/partials/threads.php?category_id='.$id.'&page='.$next_page.'" class="btn btn-primary">Next</a>';
        }
        else
        {
            echo'
            <button type="button" class="btn btn-primary" disabled>Next</button>';
        }
        echo'
    </div>';
    ?>
    <?php include "C:/xampp/htdocs/forum/partials/footer.php"; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>