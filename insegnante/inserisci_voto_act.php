<?php
//→ inserisci_voto
session_start();
$id = $_POST["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
    header('Location:../login.php');
    exit;
}

include('../dal.php');
$id_std =  $_POST["id_std"];
$id_mat =  $_POST["id_mat"];
$value = $_POST["value"];
$desc = $_POST["desc"];
$id_cls = $_POST["id_cls"];
add_voto($id_std, $id_mat, $id, $desc, $value);
header("Location: situazione_studente.php?id=$id&id_std=$id_std&id_mat=$id_mat&id_cls=$id_cls");
?>