<?php
//→ insegnante
session_start();
$id = $_GET["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
    header('Location:../login.php');
    exit;
}

include('../template/template_header_studente.php');
include('../dal.php');
$id_cls = $_GET["classe"];
?>
<div class="container" id="cerca_classe">
  <h2>Materie della classe </h2>
  <?php 
    foreach(materie_del_prof_nella_classe($id, $id_cls) as $mat){
    ?>
  <a href="voti.php?id=<?=$id ?>&classe=<?=$id_cls?>&materia=<?=$mat[0]?>" class="btn"><?=$mat[1]?></a>
  <?php 
    }
    ?>
</div>
<div class="container">
  <a href="insegnante.php?id=<?=$id ?>" class="btn">Torna alle tue classi</a>
</div>
<?php
include('../template/template_footer.php');
?>