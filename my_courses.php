<?php 
session_start();
$success = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include '_dbconnect.php';
  $c_id = $_POST['c_id'];   
  $user = $_SESSION['username'];
  $sql = "insert into `enroll` values('$c_id','$user','NO');";
  $result = mysqli_query($conn, $sql);
  
  if ($result){
      $success = true;
  } 
  else{
      $showError = "Already requested";
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

    <title>DashBoard - <?php $_SESSION['username']?></title>
  </head>
  <body>
    <?php 
    require '_nav.php';
    if($showError){
      echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> '. $showError.'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
      </div> ';
      }
    if($success){
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Course Requested</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
      </div> ';
    }
    ?>
    <div class="container">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No.</th>  
          <th scope="col">Course ID</th>
          <th scope="col">Course Name</th>
          <th scope="col">Instructor ID</th>
          <th scope="col">Instructor Name</th>
          <th scope="col">Price</th>
          <th scope="col">Duration</th>          
        </tr>
      </thead>
      <tbody>
        <?php
        include '_dbconnect.php';
        $user = $_SESSION['username'];
        $sql = "SELECT * FROM `course` where instructor_id = '$user'";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        $user = $_SESSION['username'];
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['course_id'] . "</td>
            <td>" . $row['course_name'] . "</td>
            <td>" . $row['instructor_id'] . "</td>
            <td>" . $row['faculty_name'] . "</td>
            <td>" . $row['price'] . "</td>
            <td>" . $row['course_duration'] . "</td>";
            
        echo "</tr>";
        }
        ?>
        
      </tbody>
    </table>
    </div>
    <div class="container">
    <br><br>
    <a href='add_course.php' class='btn btn-primary'>Add course</a>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
