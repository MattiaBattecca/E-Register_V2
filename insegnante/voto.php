<?php
//→ situzione_studente
session_start();
$id = $_GET["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
    header('Location:../login.php');
    exit;
}

include('../template/template_header_studente.php');
include('../dal.php');
$id_std =  $_GET["id_std"];
$id_mat =  $_GET["id_mat"];
$id_voto = $_GET["id_voto"];
$id_cls = $_GET["id_cls"];
?>
<div class="container" id="cerca_classe">
  <h1 style="color:rgb(42, 94, 206)"><?=valore($id_voto)?></h1>
  <p>
  <h3 style="color:rgb(42, 94, 206)">Descrizione:<br /><h3>
    <h4>
      <?php 
        if(descrizione($id_voto)==""){echo("Nessuna descrizione.");}
        else{echo(descrizione($id_voto));}    
      ?>
    </h4>
        <br />
      </p>
      <a href="edit_voto.php?id=<?=$id?>&id_mat=<?=$id_mat?>&id_std=<?=$id_std?>&id_voto=<?=$id_voto?>&id_cls=<?=$id_cls?>"
        class="btn">Modifica</a>
</div>

<div class="container">
  <a href="situazione_studente.php?id=<?=$id ?>&id_std=<?=$id_std?>&id_mat=<?=$id_mat?>&id_cls=<?=$id_cls?>" class="btn">Annulla</a>
</div>
<?php
include('../template/template_footer.php');
?>