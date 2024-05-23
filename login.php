<?php
require 'config.php';

if(isset($_POST["submit"])){

  $email = $_POST["email"];
  $mdp = $_POST["mdp"];
  $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($mdp == $row['mdp']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: index.php");
    }
    else{
        echo
        "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
  
    <div class="center">
      <h1>Login</h1>
      <form  method="post" >
        <div class="txt_field">
        <input type="text" name="email" Placeholder="Email" required="">
        </div>
        <div class="txt_field">
        <input type="password" name="mdp" Placeholder="Password" required="">
        </div>
        <input  name="submit" type="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="Signup.php">Sign up</a>
        </div>
      </form>
    </div>

  </body>
</html>