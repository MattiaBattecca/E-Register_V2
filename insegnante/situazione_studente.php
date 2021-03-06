<?php
//→ voti
session_start();
$id = $_GET["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
    header('Location:../login.php');
    exit;
}

include('../template/template_header_studente.php');
include('../dal.php');
$id_std = $_GET["id_std"];
$id_mat =  $_GET["id_mat"];
$id_cls = $_GET["id_cls"];
$voti = voti($id_std, $id_mat);
$mat = materia_by_id($id_mat);
$std = nome_std($id_std);
?>



<div class="container" id="cerca_classe">
  <h2>Voti <?=$mat[0]?> - <?=$std[0]?></h2>

  <div class="voti">
    <?php foreach($voti as $record){ ?>
    <a href="voto.php?id=<?=$id?>&id_std=<?=$id_std?>&id_mat=<?=$id_mat?>&id_voto=<?=$record[0]?>&id_cls=<?=$id_cls?>" class="btnsmall">
      <?=$record[1]?></a>
    <?php } ?>

  </div>
  <p class="dist">
    <a href="inserisci_voto.php?id=<?=$id?>&id_std=<?=$id_std?>&id_mat=<?=$id_mat?>&id_cls=<?=$id_cls?>" class="btn ">Inserisci</a>
  </p>
</div>
<div class="container">
  <a href="voti.php?id=<?=$id ?>&classe=<?=$id_cls?>&materia=<?=$id_mat?>" class="btn">Torna alla tua classe</a>
</div>
<?php
include('../template/template_footer.php');
?>