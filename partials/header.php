<?php
if(!isset($_SESSION))//The isset() function checks whether a variable is set, which means that it has to be declared and is not NULL.
{
  session_start();
}
if(isset($_SESSION['signup'])||isset($_SESSION['loggedin']))
{
  echo'
  <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
  <strong>Success!</strong> '.$_SESSION['errorsms'].'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  
  //HEADER NAVBAR WHEN USER LOGGEDIN
  echo'
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum/partials/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/partials/contact.php">Contact</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql="SELECT * FROM `categories` LIMIT 3";//"LIMIT" IS A KEYWORD IN PHP TO LIMIT NUMBER OF ROWS TO BE FETCHED//
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result))
        {
        $category_id=$row['category_id'];
        $category_name=$row['category_name'];
        echo'
        <li><a class="dropdown-item" href="partials/threads.php?category_id='.$category_id.'">'.$category_name.'</a></li>';
        }
        
        echo '</ul>
        </li>
      </ul>
      <form class="d-flex" action="/forum/partials/search.php" method="GET">
        <input class="form-control me-2" type="search" name="find" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success mx-2" type="submit">Search</button>
        <p class="text-light my-0 mx-0 pt-2">'.$_SESSION['login_username'].'</p>
        <a class="btn btn-primary ms-2" aria-current="page" href="/forum/partials/logout_page.php">Logout</a>
      </form>
    </div>
  </div>
</nav>
  ';
}

else
{
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum/partials/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/partials/contact.php">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
          $sql="SELECT * FROM `categories` LIMIT 3";//"LIMIT" IS A KEYWORD IN PHP TO LIMIT NUMBER OF ROWS TO BE FETCHED//
          $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result))
          {
          $category_id=$row['category_id'];
          $category_name=$row['category_name'];
          echo'
          <li><a class="dropdown-item" href="partials/threads.php?category_id='.$category_id.'">'.$category_name.'</a></li>';
          }
          
          echo '</ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>

        //<!-- Button trigger modal no need to include JS to toggle Modal just add "data-bs-toggle" AND "data-bs-target" class in our button-->//
        <div><button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">LogIn</button></div>
        <div><button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button></div>
      </form>
    </div>
  </div>
</nav>
';
include "C:/xampp/htdocs/forum/partials/login.php";//HERE WE INCLUDE LOGIN FILE HAVING MODAL IN IT//
include "C:/xampp/htdocs/forum/partials/signup.php";//HERE WE INCLUDE SIGNUP FILE HAVING MODAL IN IT//
}
?>