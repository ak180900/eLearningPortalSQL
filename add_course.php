<?php
session_start();
$showAlert = false;
$showError = false;
$unique = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $c_id = $_POST["c_id"];
    $c_name = $_POST["c_name"];
    $price = $_POST["price"];
    $duration = $_POST["duration"];
    $exists=false;
    $user = $_SESSION['username'];
    
    $query = "SELECT * FROM `course` WHERE course_id = '$c_id'";
    $check = mysqli_query($conn, $query);
    $row = mysqli_num_rows($check);
    if($row > 0)
    {
      $unique = true;
    }
    $query = "SELECT name FROM `user` WHERE id = '$user'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    if($exists==false && !$unique){
        $sql = "INSERT INTO `course` VALUES ('$c_id', '$user', '$c_name', '$price', '$name', '$duration')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
        }
        else
        {
            $showError = true;
        }
    }
}
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SignUp</title>
  </head>
  <body>
    <?php require '_nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>Course Added Succesfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($unique){
      echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Course with same Course Id exists</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
      </div> ';  
    }
    ?>

    <div class="container my-4">
     <h1 class="text-center">Signup to our website</h1>
     <form action="/project/add_course.php" method="post">
        <div class="form-group">
            <label for="c_id">Course Id</label>
            <input type="text" class="form-control" id="c_id" name="c_id" aria-describedby="emailHelp">
            
        </div>
        <div class="form-group">
            <label for="c_name">Course Name</label>
            <input type="text" class="form-control" id="c_name" name="c_name">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="text" class="form-control" id="duration" name="duration">
        </div>
        <br>      
        <button type="submit" class="btn btn-primary">Add Course</button>
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>




