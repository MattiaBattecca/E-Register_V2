<?php
session_start();
include('dal.php');
$username = $_POST["username"];
$password = $_POST["password"];

if($username == "" || $password == "" || strpos($username, " ") == false || strpos($password, " ") == false ){
    header("Location: login_credenzialierrate.php");
}


$id = log_insegnante($username, $password);
if($id>=0){
    $_SESSION["id"] = $id;
    header("Location: insegnante/insegnante.php?id=".$id);
}
else{
    $id=log_studente($username, $password);

    if($id>=0){
        $_SESSION["id"] = $id;
        header("Location: studente/studente.php?id=".$id);
    }
    else{
        session_destroy();
        header("Location: login_credenzialierrate.php");
    }
}
?>