<?php
require("config.php");
$id=$_SESSION['id'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$objet = $_POST['objet'];
$msg = $_POST['msg'];

if(isset($_POST['envoyer'])){

$sql  ="INSERT INTO contact VALUES('$id','$nom','$email','$objet','$msg')";
    
if($conn->query($sql)===TRUE){
  header("Location:contact.php");
}else{
  echo"Erreur :".$sql."<br>".$conn->error;
}
$conn->close();
}
  
?>