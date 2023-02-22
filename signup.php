<?php
$showalert = false ;
$passnotmatch = false;
$userexist = false ;
  if($_SERVER["REQUEST_METHOD"]== "POST"){
    include 'connect.php' ;
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $exit = false ;
  $query = "SELECT `user` from `user` WHERE `user`='$username'" ;
  $result2 = mysqli_query($conn , $query) ;
    $noofuser = mysqli_num_rows($result2) ;
    if($noofuser>=1){
      $userexist = true ;
    }else{
  if(($password == $cpassword)&& $exit == false ){
    $hash = password_hash($password, PASSWORD_DEFAULT) ;
    $sql = "INSERT INTO `user` ( `user`, `pass`, `date`) VALUES ('$username', '$hash', current_timestamp())" ;
    $result = mysqli_query($conn , $sql) ;
    
    if((!$result)){
      echo"no able to signup"; 
    }
    else{
      $showalert = true ;
    }
  }
  else{
    $passnotmatch = true ;
  }
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
    if($showalert){
      echo"
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>You have successfully signup!</strong> Now log in to continue.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
if($userexist){
  echo"
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>You haven't been successfully signup! </strong>This Username is already taken by someone else, Try again.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
  " ;
}
if($passnotmatch){
  echo"
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>You haven't been successfully signup!</strong>Both Password don't matched, Try again.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
  " ;
}
    ?>
    <div class="container my-4">
        <h1 class="text" >Signup to our website</h1>
        <form action="signup.php" method="post">
  <div class="mb-3 col-md-6">
    <label for="exampleInputEmail1" class="form-label">username(max char-11)</label>
    <input type="text" class="form-control" maxlength = "11" required id="exampleInputEmail1" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 col-md-6">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" required id="exampleInputPassword1" name="password" >
  </div>
  <div class="mb-3 col-md-6">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control"  required id="exampleInputPassword1"name="cpassword" >
    <div id="emailHelp" class="form-text">Should be same as above</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</body>
</html>
