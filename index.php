<?php
require 'C:/xampp/htdocs/forum/partials/db_connect.php'
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
    ?>

    <!-- Slider Start Here -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/random/2400x600/?coding,linux" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/random/2400x600/?programmer,working" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">

                <!-- WIDTH PLAYS VITAL ROLE THE MORE THE WIDTH THE CLEAR PIC IS HERE HEIGHT IS ADJUSTED AUTOMATICALLY -->
                <img src="https://source.unsplash.com/random/2400x600/?coding,microsoft" class="d-block w-100"
                    alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories Container Start Here -->
    <div class="container">
        <h2 class="text-center my-3">iDiscuss- Browse Categories</h2>
        <div class="row">
            <!-- Fetch All Categories -->
            <?php
        $sql="SELECT * FROM `categories`";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result))
        {
            $page=1;
          $category_id=$row['category_id'];
          $category_name=$row['category_name'];
          $category_description=$row['category_description'];
          echo'
          <div class="col-md-4">
        <div class="card my-3" style="width: 18rem;">

               <!-- WIDTH PLAYS VITAL ROLE THE MORE THE WIDTH THE CLEAR PIC IS HERE HEIGHT IS ADJUSTED AUTOMATICALLY --> 
              <img src="https://source.unsplash.com/random/500x400/?coding,'.$category_name.'" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><a href="partials/threads.php?category_id='.$category_id.'&page=1">'.$category_name.'</a></h5>
                <p class="card-text">'.substr($category_description,0,110).'...</p>
                <a href="partials/threads.php?category_id='.$category_id.'&page=1" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
        </div>
          ';
        }
        //NOTE:For a description of equal number of words we use "substr"//
        ?>
        </div>
    </div>
    <?php include "partials/footer.php"; ?>
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