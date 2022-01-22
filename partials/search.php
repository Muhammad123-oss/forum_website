<?php
if(!isset($_SESSION))
{
    session_start();
}
require 'C:/xampp/htdocs/forum/partials/db_connect.php';
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

    <title>Results!</title>
</head>

<body>
    <?php include "C:/xampp/htdocs/forum/partials/header.php";
  echo'
  <div class="container my-4">
  <h3 class="text-center">Search Results For<em> "'.$_GET['find'].'"</em></h3>';
  $find=$_GET['find'];

  //Natural language full-text search interprets the search string as a free text (natural human language) and no special operators are required.//
  //OPEN THE GIVEN LINK FOR Natural language full-text//
  //LINK: https://www.w3resource.com/mysql/mysql-full-text-search-functions.php //
  $sql="SELECT * FROM threads WHERE MATCH(thread_title,thread_description) AGAINST ('$find' IN NATURAL LANGUAGE MODE)";
  
  $run_query=mysqli_query($conn,$sql);
  $num=mysqli_num_rows($run_query);
  //echo $num;
  if($num>=1)
  {
  while($row_search=mysqli_fetch_assoc($run_query))
  {
    $title=$row_search['thread_title'];
    $desc=$row_search['thread_description'];
    $thread_id=$row_search['thread_id'];
    echo'
    <div class="flex-shrink-0">
    <img src="/forum/img/pic1.jpg" width=45px alt="...">
    <a class="mt-0 fw-bold" href="/forum/partials/threads_sol.php?thread_id='.$thread_id.' ">'.$title.'</a></p> 
    <p>'.$desc.'</p>
    </div>';
    }
}
    else{
        echo'
        <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Sorry!</h4>
  <p>No Result Found.</p>
</div>
        ';
    }
  echo'</div>';
  ?>
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