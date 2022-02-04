<?php
include "config.php";

// ---------------------------------- CONNESSIONE ----------------------------------

function db_connect(){
  $mysqli = new mysqli(SERVER, USERNAME,PASSWORD, DATABASE);
  if($mysqli->connect_error){
    die('Connection failed. Error: '. $mysqli->connect_error);
  }
  return $mysqli;
} 

// ---------------------------------- MATEMATICA ----------------------------------

function stat_tot(){
  $mysqli=db_connect();
  $sql="SELECT AVG(voto.valore) AS 'avg', MAX(voto.valore) AS 'max', MIN(voto.valore) AS 'min', STDDEV_POP(voto.valore) AS 'dev' FROM voto";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0];
}

function stat_cls($classe){
  $mysqli=db_connect();
  $sql="SELECT AVG(voto.valore) AS 'avg', MAX(voto.valore) AS 'max', MIN(voto.valore) AS 'min', STDDEV_POP(voto.valore) AS 'dev' FROM voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = $classe)";
  $result=$mysqli->query($sql);
  $data=$result->fetch_all();
  $result->free();
  $mysqli->close();
  return $data[0];
}

// ---------------------------------- GRAFICO ----------------------------------

function mesi(){
  $query = [];
  for ($x = 9; $x <= 12; $x++) {
    if($x<10){
      array_push($query, "SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-0".$x."-%') AS val");
    }
    else{
      array_push($query, "SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-".$x."-%') AS val");
    }
  }
  for ($x = 1; $x <= 6; $x++) {
    if($x<10){
      array_push($query, "SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-0".$x."-%') AS val");
    }
    else{
      array_push($query, "SELECT AVG(valore) FROM (SELECT voto.valore FROM voto WHERE voto.data LIKE '%-".$x."-%') AS val");
    }
  }

  $mysqli=db_connect();
  $arr=[];

  for ($x = 0; $x <= count($query)-1; $x++){
    $result=$mysqli->query($query[$x]);
    $data=$result->fetch_all();
    $result->free();
    array_push($arr,$data[0][0]);
  }

  $mysqli->close();
  return $arr;
}

function mesi_cls($classe){
  $query = [];
  
  for ($x = 9; $x <= 12; $x++) {
    if($x<10){
      array_push($query, "SELECT AVG(voto.valore) AS val FROM  voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = 1 AND voto.data LIKE '%-0".$x."-%')");
    }
    else{
      array_push($query, "SELECT AVG(voto.valore) AS val FROM  voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = 1 AND voto.data LIKE '%-".$x."-%')");
    }
  }
  for ($x = 1; $x <= 6; $x++) {
    if($x<10){
      array_push($query, "SELECT AVG(voto.valore) AS val FROM  voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = 1 AND voto.data LIKE '%-0".$x."-%')");
    }
    else{
      array_push($query, "SELECT AVG(voto.valore) AS val FROM  voto WHERE voto.id_studente IN (SELECT studente.id_studente FROM studente WHERE studente.id_classe = 1 AND voto.data LIKE '%-".$x."-%')");
    }
  }

  $mysqli=db_connect();
  $arr=[];

  for ($x = 0; $x <= count($query)-1; $x++){
    $result=$mysqli->query($query[$x]);
    $data=$result->fetch_all();
    $result->free();
    array_push($arr,$data[0][0]);
  }

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
?>