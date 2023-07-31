<?php 
session_start();
$success = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include '_dbconnect.php';
  $c_id = $_POST['c_id'];  
  $s_id = $_POST['s_id']; 
  $user = $_SESSION['username']; 
  $query = "select * from `enroll` where course_id = '$c_id' and student_id = '$s_id'";
  $result = mysqli_query($conn, $query);
  $num = mysqli_num_rows($result);
  if ($num > 0){
      $success = true;  
  } 
  else{
      $showError = "Invalid Request";
  }
  if($success)
  {
    $sql = "update `enroll` set confirmation = 'YES' where course_id = '$c_id' and student_id = '$s_id';";
    $result = mysqli_query($conn, $sql);
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
            <strong>Student Enrolled</strong>
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
          <th scope="col">Student ID</th>
          <th scope="col">Student Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $user = $_SESSION['username'];
        include '_dbconnect.php';
        $sql = "select * from `course` as c, `enroll` as e, `user` as u
        where c.course_id = e.course_id and u.id = e.student_id and instructor_id = '$user' and e.confirmation = 'NO';";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        $flag = false;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          $flag = true;
          echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['course_id'] . "</td>
            <td>" . $row['course_name'] . "</td>
            <td>" . $row['student_id'] . "</td>
            <td>" . $row['name'] . "</td>
          </tr>";
        }
        if(!$flag)
        {
            echo "<td>No Pending Requests</td>";
        }
        ?>
      </tbody>
    </table>
    </div>
    <br><br>
    <div class="container">
    <form action="/project/enrollment_request.php" method="post">
        <div class="form-group">
            <label for="username">Enter Course Id</label>
            <input type="text" class="form-control" id="c_id" name="c_id" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="username">Enter Student Id</label>
            <input type="text" class="form-control" id="s_id" name="s_id" aria-describedby="emailHelp">
        </div>         
        <button type="submit" class="btn btn-primary">Accept Enrollment</button>
     </form>  
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
