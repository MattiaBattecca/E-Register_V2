<?php
session_start();
$id = $_GET["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
    header('Location:../login.php');
    exit;
}

include('../dal.php');
$id_std =  $_GET["id_std"];
$id_mat =  $_GET["id_mat"];
$id = $_GET["id"];
$id_voto = $_GET["id_voto"];
$desc =$_POST["desc"];
$value = $_POST["value"];
edit_voto($id_std, $id_mat, $id, $desc, $value, $id_voto);
header("Location: situazione_studente.php?id=$id&id_std=$id_std&id_mat=$id_mat");
?>