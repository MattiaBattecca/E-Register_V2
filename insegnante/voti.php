<?php
//→ materia
session_start();
$id = $_GET["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
    header('Location:../login.php');
    exit;
}

include('../template/template_header_studente.php');
include('../dal.php');
$id = $_GET["id"];
$id_cls = $_GET["classe"];
$id_mat =  $_GET["materia"];
$cls_name = classe_from_id($id_cls);
$classe = classe_sel_studenti($id_cls);
$mat = materia_by_id($id_mat);
?>
<div class="container" id="cerca_classe">
  <h2>Voti <?=$cls_name?> - <?=$mat[0]?></h2>
  <table>
    <tr>
      <th>Cognome</th>
      <th>Nome</th>
      <th>Voti</th>
    </tr>
    <?php foreach($classe as $record){ ?>
    <tr>
      <td><?=$record[2]?></td>
      <td><?=$record[1]?></td>
      <td><a class="btnsmall"
          href="situazione_studente.php?id=<?=$id?>&id_std=<?=$record[0]?>&id_mat=<?=$id_mat?>&id_cls=<?=$id_cls?>">Visualizza</a>
      </td>
    </tr>
    <?php } ?>
  </table>

</div>

<div class="container">
  <a href="materia.php?id=<?=$id?>&classe=<?=$id_cls?>" class="btn">Torna alle tue materie</a>
</div>
<?php
include('../template/template_footer.php');
?>