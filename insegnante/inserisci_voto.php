<?php
//→ situazione_studente
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
$id_cls = $_GET["id_cls"];
?>
<div class="container" id="cerca_classe">
  <h2>Inserisci voto</h2>
  <form method="post" action="inserisci_voto_act.php">
    <input type="hidden" name="id_cls" value="<?=$id_cls?>">
    <p>
      Voto:<br /><br />
    <div class="search_categories">
      <div class="select">
        <select name="value" id="value">

        <?php
          $s = 0;
          $v = 0;
          $c = ['','+','.5','-'];
          for ($i = 0; $i < 1000; $i+=25)
          {
            ?><option value="<?=$i/100?>"><?=$v.$c[$s]?></option><?php
            
            $s++;
            if($s==4){$s=0;}
            if($s==3){$v++;}
          }            
        ?>
        <option value="10" selected="selected">10</option>


        </select>
      </div>
    </div>
    </p>
    <p>
      Descrizione:<br /><br />
      <input name="desc" id="desc" placeholder="Inserisci una descrizione..."><br />
      <input type="submit" class="btn" value="Inserisci voto">
    </p>
    <input type="hidden" name="id" id="id" value="<?=$id?>">
    <input type="hidden" name="id_mat" id="id_mat" value="<?=$id_mat?>">
    <input type="hidden" name="id_std" id="id_std" value="<?=$id_std?>">
  </form>
</div>



<div class="container">
  <a href="situazione_studente.php?id=<?=$id ?>&id_std=<?=$id_std?>&id_mat=<?=$id_mat?>&id_cls=<?=$id_cls?>" class="btn">Annulla</a>
</div>



<?php
include('../template/template_footer.php');
?>