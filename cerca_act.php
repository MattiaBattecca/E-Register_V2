<?php
include('dal.php');

$classe = $_GET['classe'];

echo($classe);

if(strlen($classe)==2){
    $id = classe_from_name($classe);
    if($id >= 0){
        header("Location: cerca.php?id_classe=".$id);
    }
    else{
        header("Location: classenontrovata.php");
    }
}

else{
    header("Location: classenontrovata.php");
}

?>