<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/compte.css">
</head>
<body>
<?php include 'top.php';?>
<?php include 'menu.php'; ?> 

<br>
<div class="outer-div">
        <div class="inner-div">
<?php if(isset($_SESSION['session_username'])) {
  echo '<h2>'.$_SESSION['session_libtype'].'</h2>'; 
  }else {
    echo'<center><h3 style="color:red"> Il semblerai qu&apos;il y ai une erreur, veuillez r&eacute;essayer.</h3></center>';
  }?>
  
<br><br><br>

<hr color="orange">
<nav>
  <ul>
      <li><a href="ajouter_motif.php">Ajouter</a></li>
      <li><a href="modifier_motif.php">Modifier</a></li>
      <li><a href="supprimer_motif.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="orange">  
<?php

$order ='';
  $tri = isset($_GET['tri']) ? $_GET['tri']: 0; // recupere le tri, envoyé avec les icones du tableau
  switch ($tri){ // switch, completera le order by de la requete sql
    case 0:
      $order = "id_mdf";
    break;
    case 1:
        $order = "lib_mdf";
      break;
    default:
    break;
  }

  //pour filtrer les questions sans réponse
  if (isset($_POST['vide'])){ // si $post[vide] existe
    $is_vide = $_POST['vide'];
  }
  else {
      $is_vide =0; // sinon booléen à 0
  } 
  if ($is_vide==1){ // regarde le booleen est vrai
    $filtre_vide="AND reponse IS NULL"; //rajoute la condition en sql si vrai
  }
  else {$filtre_vide="";} //sinon ne rajoute rien dans la requete
  
  //pour filtrer par utilisateur
  if (isset($_POST['utilisateur'])){ // si $post[utilisateur] existe
    if ($_POST['utilisateur'] != '0') { // si ce n'est pas tous les utilisateurs
        $utilisateur = " AND pseudo='".$_POST['utilisateur']."'"; // complete la requete pour filtrer avec son nom
    }
    else {
      $utilisateur=""; // sinon requete inchangée
  }
  }
  else {
      $utilisateur=""; // sinon requete inchangée
  }

  $sql = "select id_mdf ,lib_mdf from motif_de_frais"; // requete sql
  $dsn = 'mysql:host=localhost;dbname=fredi;charset=UTF8'; 
  $user = 'root';
  $password = '';
  try {
  $dbh = new PDO($dsn, $user, $password);
  $sth = $dbh->prepare($sql);
  $sth->execute(); 
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
  die("Erreur lors de la requête SQL : ".$ex->getMessage());
  }


  $modif = isset($_GET['modif']) ? $_GET['modif']: 0;  //Reception  numero erreur
switch ($modif) { //si pas de session -> echo erreur
  case 1 :
  echo"<p class='centre'>1 enregistrement ajouté.</p>";
  break;
  case 2:
  echo"<p class='centre'>1 enregistrement modifié.</p>"; 
  break;
  case 3:
  echo"<p class='centre'>1 enregistrement supprimé.</p>"; 
  break;
  default:
  break;
 }

echo"<br><br>";
  // Affichage de la liste des colonnes
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo "<tr><th>ID</th>";
  echo "<th>Libellé</th>";
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['id_mdf']."</td>"; 
  echo "<td>".$row['lib_mdf']."</td>"; 
  }
  echo "</tr>"; 
echo "</table>";
?><!--From pour modifier l'utilisateur en question -->
<br>
<form action="modifier_motif.php" method="post">
  <label for="idmotif">ID Motif</label><br>
  <input type="idmotif" id="idmotif" name="idmotif" required><br><br>
  <label for="libmotif">Libellé motif</label><br>
  <input type="libmotif" id="libmotif" name="libmotif" required><br><br>
  <input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
     
    $dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        if(isset($_POST['enregistrement'])){
          $idmotif = $_POST['idmotif']; 
          $libmotif = $_POST['libmotif']; 
          $sql = "UPDATE motif_de_frais SET lib_mdf=:libmotif WHERE id_mdf=:idmotif"; 
          try { 
            $sth = $dbh->prepare($sql);
            $sth->execute(array( 
              ':idmotif' => $idmotif, 
              ':libmotif' => $libmotif,
              )); 
            }catch (PDOException $ex) { 
            die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
            }            
        }
        if(isset($_POST['enregistrement'])){
          echo "<br> Le motif ".$libmotif." a été modifié dans la FREDI";
          $delai=2; 
          $url='modifier_motif.php';
          header("Refresh: $delai;url=$url");
        }

  ?>
</form>

</body>
</html>