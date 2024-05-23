<?php 
include('config.php');
if(isset($_POST['Modifier']))
{
    $id=$_SESSION['id'];
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $objet=$_POST['objet'];
    $msg=$_POST['msg'];
    

    $query = "UPDATE contact SET nom = '$nom' , email = '$email' , objet = '$objet' , msg = '$msg'  where id = '$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data Updated Successfully";
        header("Location: afficher.php");
    }
    else
    {
        $_SESSION['status'] = "Not Updated";
        header("Location: afficher.php");
    }
}
?>