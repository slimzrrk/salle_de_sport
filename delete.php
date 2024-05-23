<?php
include('config.php');
$id=$_SESSION['id'];
$sql ="DELETE FROM contact WHERE id = '$id' ";           
    if($conn -> query($sql) === TRUE){      
      $_SESSION['status']="Suppression avec sucès ";
      header("location:afficher.php");
      unset($_SESSION['id']);
    } else {   
        $_SESSION['statusbad']= "Error: ". $sql . "<br>" . $conn->error;
    header("location:afficher.php");  
    unset($_SESSION['id']);
    }
?>