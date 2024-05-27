<?php
$sAlert = false;
$sError = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  include 'partials/_dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  //check whether this username Exists
  $existSql = "SELECT * FROM `users` WHERE `username` ='$username';";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if ($numExistRows > 0) {
    $sError = "Username Already Exists";
  } else {
    if (($password == $cpassword)) {
      $hash = password_hash($password,PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ( '$username', '$hash', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $sAlert = true;
      }
    } else {
      $sError = "Passwords do not match";
    }
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Sign up</title>
  <style>
    .image {
      display: flex;
    }

    img {
      width: 40px;
      height: 40px;
      border-radius: 50px;
      margin-right: 5px;
    }
    button:hover
    {
      opacity: 0.7;
    }

    body {
      background-image: url("bg4.jpg");
      background-repeat: no-repeat;
      background-size: auto;
    }
  </style>
</head>

<body>
  <?php
  require 'partials/_nav.php'; ?>
  <?php
  if ($sAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is now created and you can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  if ($sError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong>' . $sError . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  ?>
  <div class="container my-4" style="display: flex;align-items:center;flex-direction:column">
    <h1 class="text-center">Signup</h1>
    <form method="post" action="/loginsystem/signup.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label" for="username"></label>
        <div class="image">
          <img src="user2.jpeg" style="width: 35px;height: 35px;">
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Username" maxlength=11>

        </div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label" for="password"></label>
        <div class="image">
          <img src="pwd2.jpeg" alt="">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength=8 
          title="Password must contain 8 characters">
        </div>
      </div>
      
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label" for="cpassword"></label>
        <div class="image">
          <img src="pwd2.jpeg" alt="">
          <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" maxlength=23>

        </div>

        <div id="emailHelp" class="form-text">Make sure to type the same password</div>

      </div>
      <button type="submit" class="btn " style="background-color: #0077b6;color:white;width:250px;">Signup</button>
      <p>Already have an account? <a href="/loginsystem/login.php" style="color: black;"><b>Login</b></a></p>

    </form>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>