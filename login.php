<?php
  $login = false ;
  $showerror = false ;
  if($_SERVER["REQUEST_METHOD"]== "POST"){
    include 'connect.php' ;
  $username = $_POST["username"];
  $password = $_POST["password"];
  $sql = "select * from user where user='$username'" ;
  $result = mysqli_query($conn , $sql) ;
  $num = mysqli_num_rows($result) ;
  if($num == 1){
    while($row = mysqli_fetch_assoc($result)){
      if(password_verify($password, $row['pass'])){
      $login = true ;
    session_start() ;
    $_SESSION['loggedin'] = true ;
    $_SESSION['username'] = $username ;
    header("location:welcome.php") ;
      }
      else{
        $showerror = true ;
      }
    }
  }
  else{
    $showerror = true ;
    // $showerror = "Invalid Credentials" ;
  }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
    require 'nav.php'
    ?>
    <?php
    if($login){
      echo"
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>You have successfully Logged in!</strong> 
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
if($showerror){
  echo"
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>You haven't successfully Logged in!</strong> Check your username and password again.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
    ?>
    <div class="container my-4">
        <h1 class="text" >Login to our website</h1>
        <form action="login.php" method="post">
  <div class="mb-3 col-md-6">
    <label for="exampleInputEmail1" class="form-label">username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 col-md-6">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" >
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</body>
</html>
