<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $nom = $_POST["nom"];
  $email = $_POST["email"];
  $mdp = $_POST["mdp"];
  $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE nom = '$nom' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else{
    $sql = 'INSERT INTO user(id,nom,email, mdp) VALUES (0,"'.$nom.'","'.$email.'","'.$mdp.'")';
    if($conn->query($sql)===TRUE){
      header("Location: login.php");
    }else{
      echo"Erreur :".$sql."<br>".$conn->error;
    }
    $conn->close();
  }
}
?>
