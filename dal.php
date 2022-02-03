<?php
include "config.php";

// ---------------------------------- CONNESSIONE ----------------------------------
function db_connect(){
  $mysqli = new mysqli("localhost", "eregister2", "W.n4#JtM", "eregister2");
  if($mysqli->connect_error){
    die('Connection failed. Error: '. $mysqli->connect_error);
  }
  return $mysqli;
} 

// ---------------------------------- MATEMATICA ----------------------------------

function media_tot(){
  $mysqli=db_connect();
  $sql="SELECT AVG(valore) FROM(SELECT voto.valore FROM voto) AS media_tot";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0];
}

function massimo_tot(){
  $mysqli=db_connect();
  $sql="SELECT MAX(valore) FROM(SELECT voto.valore FROM voto) AS massimo_tot";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0];
}

function minimo_tot(){
  $mysqli=db_connect();
  $sql="SELECT MIN(valore) FROM(SELECT voto.valore FROM voto) AS minimo_tot";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0];
}

function deviazione_tot(){
  $mysqli=db_connect();
  $sql="SELECT STDDEV_POP(voto.valore) FROM voto";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0];
}

function media_cls($classe){
  $mysqli=db_connect();
  $sql="SELECT AVG(valore) FROM(SELECT voto.valore FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe)) AS media_cls";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0][0];
}

function massimo_cls($classe){
  $mysqli=db_connect();
  $sql="SELECT MAX(valore) FROM(SELECT voto.valore FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe)) AS massimo_cls";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0][0];
}

function minimo_cls($classe){
  $mysqli=db_connect();
  $sql="SELECT MIN(valore) FROM(SELECT voto.valore FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe)) AS minimo_cls";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0][0];
}

function deviazione_cls($classe){
  $mysqli=db_connect();
  $sql="SELECT STDDEV_POP(dev.valore) FROM(SELECT voto.valore FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe)) AS dev";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0][0];
}

// ---------------------------------- GRAFICO ----------------------------------

function mesi(){
  $arr=[];
  $sql1="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-09-%') AS val";
  $sql2="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-10-%') AS val";
  $sql3="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-11-%') AS val";
  $sql4="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-12-%') AS val";
  $sql5="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-01-%') AS val";
  $sql6="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-02-%') AS val";
  $sql7="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-03-%') AS val";
  $sql8="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-04-%') AS val";
  $sql9="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-05-%') AS val";
  $sql10="SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-06-%') AS val";



  $mysqli=db_connect();



  $result=$mysqli->query($sql1);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql2);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql3);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql4);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql5);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql6);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql7);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql8);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql9);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql10);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);



  $mysqli->close();

  return $arr;
}

function mesi_cls($classe){
  $arr=[];
  $sql1="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-09-%')) AS val";
  $sql2="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-10-%')) AS val";
  $sql3="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-11-%')) AS val";
  $sql4="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-12-%')) AS val";
  $sql5="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-01-%')) AS val";
  $sql6="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-02-%')) AS val";
  $sql7="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-03-%')) AS val";
  $sql8="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-04-%')) AS val";
  $sql9="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-05-%')) AS val";
  $sql10="SELECT AVG(valore) FROM (SELECT voto.valore, voto.data FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe AND voto.data LIKE '%-06-%')) AS val";



  $mysqli=db_connect();



  $result=$mysqli->query($sql1);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql2);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql3);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql4);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql5);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql6);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql7);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql8);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql9);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);

  $result=$mysqli->query($sql10);
  $data=$result->fetch_all();
  $result->free();
  array_push($arr,$data[0][0]);



  $mysqli->close();

  return $arr;
}

// ---------------------------------- LOGIN ----------------------------------

function log_insegnante($user, $pass){
    
  $mysqli=db_connect();
  $sql="SELECT insegnante.id_insegnante FROM insegnante WHERE LOWER(insegnante.username) LIKE LOWER('$user') AND insegnante.password LIKE '$pass'";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();

  if($data!=null)
  {
    return $data[0][0];
  }
  else
  {
    return -1;
  }
}

function log_studente($user, $pass){
  $mysqli=db_connect();
  $sql="SELECT studente.id_studente FROM studente WHERE LOWER(studente.username) LIKE LOWER('$user') AND studente.password LIKE '$pass'";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();

  if($data!=null)
  {
    return $data[0][0];
  }
  else
  {
    return -1;
  }
}

// ---------------------------------- CLASSE ----------------------------------

function classi_sel_all(){
  $mysqli=db_connect();
  $sql="SELECT * FROM classe ";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all(MYSQLI_ASSOC);
  $result->free();
  $mysqli->close();
  return $data;
}

function classi_del_prof($id){
  $mysqli=db_connect();
  $sql="SELECT appartenenza.coordinatore, appartenenza.id_insegnante, appartenenza.id_classe, classe.numero, classe.sezione FROM appartenenza INNER JOIN classe ON appartenenza.id_classe = classe.id_classe WHERE appartenenza.id_insegnante = $id";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data;

}

function classe_from_name($str){  
  $a = $str[0];
  $b = $str[1];
  $mysqli=db_connect();
  $sql="SELECT classe.id_classe FROM classe WHERE classe.numero = $a AND LOWER(classe.sezione) = LOWER('$b')";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();

  if(count($data)>0){
    return $data[0][0];
  }
  else{
    return -1;
  }
}

function classe_from_id($id){
  $mysqli=db_connect();
  $sql="SELECT classe.numero, classe.sezione FROM classe WHERE classe.id_classe = $id";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return strval($data[0][0]).strtoupper(strval($data[0][1]));
}

function classe_sel_studenti($id){
  //
  $mysqli=db_connect();
  $sql="SELECT studente.id_studente, studente.nome, studente.cognome FROM studente INNER JOIN classe ON studente.id_classe = classe.id_classe WHERE classe.id_classe = $id";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data;
}

// ---------------------------------- PROFESSORE ----------------------------------

function materie_del_prof_nella_classe($id_prof, $id_classe){
  $mysqli=db_connect();
  $sql="SELECT materia.id_materia, materia.nome FROM materia WHERE materia.id_materia IN (SELECT insegnamento.id_materia FROM appartenenza INNER JOIN insegnamento ON appartenenza.id_insegnante = insegnamento.id_insegnante WHERE appartenenza.id_insegnante = 40 AND appartenenza.id_classe = 1)";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data;
}

function materia_by_id($id){
  $mysqli=db_connect();
  $sql="SELECT materia.nome FROM materia WHERE materia.id_materia = $id";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0];
}

function voti($id_std, $id_mat){
  $mysqli=db_connect();
  $sql="SELECT * FROM `voto` WHERE voto.id_studente = $id_std AND voto.id_materia = $id_mat";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data;
}

// ---------------------------------- STUDENTE ----------------------------------

function nome_std($id_std){
  $mysqli=db_connect();
  $sql="SELECT CONCAT ( studente.nome, ' ' ,studente.cognome) FROM `studente` WHERE studente.id_studente = $id_std";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0];
}

function mat(){
  $mysqli=db_connect();
  $sql="SELECT * FROM `materia`";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data;
}

function voti_std_mat($id_std, $id_mat){
  $mysqli=db_connect();
  $sql="SELECT * FROM voto WHERE voto.id_studente = $id_std AND voto.id_materia = $id_mat";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data;
}

// ---------------------------------- VOTO ----------------------------------

function add_voto($id_std, $id_mat, $id_prof, $desc, $value){
  $dat = date("Y-m-d");
  if($desc == ''){
    $sql="INSERT INTO voto (voto.id_voto, voto.valore, voto.data, voto.descrizione, voto.id_studente, voto.id_materia, voto.id_insegnante) VALUES (NULL,$value, '$dat', NULL,$id_std, $id_mat, $id_prof)";
  }
  else{
    $sql="INSERT INTO voto (voto.id_voto, voto.valore, voto.data, voto.descrizione, voto.id_studente, voto.id_materia, voto.id_insegnante) VALUES (NULL,$value, '$dat', $desc,$id_std, $id_mat, $id_prof)";
  }
  $mysqli=db_connect();
  $mysqli->query($sql);
  $mysqli->close();  
}

function edit_voto($id_std, $id_mat, $id_prof, $desc, $value, $id_voto){
  $dat = date("Y-m-d");
  if($desc == ''){
    $sql="UPDATE voto SET voto.id_voto= $id_voto, voto.valore=$value, voto.data='$dat', voto.descrizione=NULL, voto.id_studente=$id_std, voto.id_materia=$id_mat, voto.id_insegnante=$id_prof WHERE voto.id_voto = $id_voto";
  }
  else{
    $sql="UPDATE voto SET voto.id_voto= $id_voto, voto.valore=$value, voto.data='$dat', voto.descrizione=$desc, voto.id_studente=$id_std, voto.id_materia=$id_mat, voto.id_insegnante=$id_prof WHERE voto.id_voto = $id_voto";
  }
  $mysqli=db_connect();
  $mysqli->query($sql);
  $mysqli->close(); 

}


function delete_voto($id_voto){
  $sql="DELETE FROM voto WHERE voto.id_voto = $id_voto";
  $mysqli=db_connect();
  $mysqli->query($sql);
  $mysqli->close(); 
}























// aggiorna
function nazioni_mod_id($oldcode, $code, $name, $cont){
  $mysqli=db_connect();
  $sql="UPDATE country SET Code='$code', Name='$name', Continent='$cont' where Code='$oldcode'";
  $result=$mysqli->query($sql);
  $mysqli->close();
}
// elimina
function delete($text){
  $mysqli=db_connect();
  $sql="DELETE FROM column WHERE attribute='$text'";
  $result=$mysqli->query($sql);
  $mysqli->close();
}



?>