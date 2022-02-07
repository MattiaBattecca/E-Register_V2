<?php
//→ edit_voto
session_start();
$id = $_POST["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
    header('Location:../login.php');
    exit;
}

include('../dal.php');
$id_std =  $_POST["id_std"];
$id_mat =  $_POST["id_mat"];
$id_cls = $_POST["id_cls"];
$id_voto = $_POST["id_voto"];
$desc = $_POST["desc"];
$value = $_POST["value"];
edit_voto($id_std, $id_mat, $id, $desc, $value, $id_voto);
header("Location: situazione_studente.php?id=$id&id_std=$id_std&id_mat=$id_mat&id_cls=<?=$id_cls?>");
?>