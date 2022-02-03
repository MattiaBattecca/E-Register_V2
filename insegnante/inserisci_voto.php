<?php
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
?>

<div class="container" id="cerca_classe">
  <h2>Inserisci voto</h2>
  <form method="post" action="inserisci_voto_act.php?id=<?=$id?>&id_mat=<?=$id_mat?>&id_std=<?=$id_std?>">
    <p>
      Voto:<br /><br />
    <div class="search_categories">
      <div class="select">
        <select name="value" id="value">
          <option value="1" selected="selected">1</option>
          <option value="1.25">1+</option>
          <option value="1.5">1.5</option>
          <option value="1.75">2-</option>
          <option value="2">2</option>
          <option value="2.25">2+</option>
          <option value="2.5">2.5</option>
          <option value="2.75">3-</option>
          <option value="3">3</option>
          <option value="3.25">3+</option>
          <option value="3.5">3.5</option>
          <option value="3.75">4-</option>
          <option value="4">4</option>
          <option value="4.25">4+</option>
          <option value="4.5">4.5</option>
          <option value="4.75">5-</option>
          <option value="5">5</option>
          <option value="5.25">5+</option>
          <option value="5.5">5.5</option>
          <option value="5.75">6-</option>
          <option value="6">6</option>
          <option value="6.25">6+</option>
          <option value="6.5">6.5</option>
          <option value="6.75">7-</option>
          <option value="7">7</option>
          <option value="7.25">7+</option>
          <option value="7.5">7.5</option>
          <option value="7.75">8-</option>
          <option value="8">8</option>
          <option value="8.25">8+</option>
          <option value="8.5">8.5</option>
          <option value="8.75">9-</option>
          <option value="9">9</option>
          <option value="9.25">9+</option>
          <option value="9.5">9.5</option>
          <option value="9.75">10-</option>
          <option value="10">10</option>
        </select>
      </div>
    </div>
    </p>
    <p>
      Descrizione:<br /><br />

      <input name="desc" id="desc" placeholder="Inserisci una descrizione..."><br />
      <input type="submit" class="btn" value="Inserisci voto">

    </p>
  </form>
</div>



<?php
include('../template/template_footer.php');
?>