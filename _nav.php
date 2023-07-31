<?php
$lg = false;
// session_start();
$role = false;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $lg = true;
  $role = $_SESSION['role'];
}

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/project"><img src="ISO_C++_Logo.svg.png" height="32px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/project/welcome.php">Home <span class="sr-only">(current)</span></a>
      </li>';
      if(!$lg)
      {
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/project/signup.php">Signup</a>
      </li>';
      }
      if($lg)
      {
      echo '<li class="nav-item">
        <a class="nav-link" href="/project/logout.php">Logout</a>
      </li>';
      }
      if($role == 'student')
      {
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/dashboard.php">DashBoard</a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/profile.php">Profile</a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/courses.php">Courses</a>
      </li>';
      }
      if($role == 'faculty')
      {
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/enrollment_request.php">Enrollment Requests</a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/profile.php">Profile</a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/my_courses.php">My Courses</a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/enrolled_students.php">Enrolled Students</a>
      </li>';
      }
      if($role == 'admin')
      {
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/enrollment_request.php">Enrollment Requests</a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/profile.php">Profile</a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/project/my_courses.php">My Courses</a>
      </li>';
      }
      
       
      
    echo '</ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>'
?>
