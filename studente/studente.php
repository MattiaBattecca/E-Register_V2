<?php
session_start();
include('../template/template_header_studente.php');
include('../dal.php');
$id_std = $_GET["id"];
if (!isset($_SESSION['id']) || $_SESSION['id'] != $id_std) {
    header('Location:../login.php');
    exit;
}
$materie = mat();
?>
<p class="intestazione"><?=nome_std($id_std)[0]?></p>

<div class="container" id="cerca_classe">
  <h2>I tuoi voti</h2>
  <?php foreach($materie as $mat){ ?>
  </p>

  <h3><?=$mat[1]?></h3>

  <?php
        $voti = voti_std_mat($id_std, $mat[0]);
        foreach($voti as $voto){
        ?>

  <a class="btnsmall"><?=$voto[1]?></a>

  <?php } ?>

  </p>
  <hr>

  <?php } ?>
</div>

<?php
include('../template/template_footer.php');
?>