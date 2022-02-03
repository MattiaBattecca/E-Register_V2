<?php
session_start();
$id = $_GET["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
    header('Location:../login.php');
    exit;
}

include('../template/template_header_studente.php');
include('../dal.php');
?>

<div class="container" id="cerca_classe">
  <h2>Le mie classi</h2>
  <?php 
    foreach(classi_del_prof($id) as $cls){
    ?>
  <a href="materia.php?id=<?=$id?>&classe=<?=$cls[2]?>" class="btn"><?=$cls[3]?><?=$cls[4]?></a>
  <?php 
    }
    ?>
</div>
<?php
include('../template/template_footer.php');
?>