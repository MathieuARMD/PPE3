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
<?php require_once "init.php";?>

<br>
<div class="outer-div">
        <div class="inner-div">
<?php if(isset($_SESSION['session_username'])) {
  echo '<h2>'.$_SESSION['session_libtype'].'</h2>'; 
  }else {
    echo'<center><h3 style="color:red"> Il semblerai qu&apos;il y ai une erreur, veuillez r&eacute;essayer.</h3></center>';
  }?>
  
<br><br><br>

<hr color="black">
<nav>
  <ul>
      <li><a href="ajouter_ligue.php">Ajouter</a></li>
      <li><a href="modifier_ligue.php">Modifier</a></li>
      <li><a href="supprimer_ligue.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">  
<?php

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

  $LigueDAO = new LigueDAO();
  $rows = $LigueDAO->findAll();

    // Affichage de la liste des colonnes
  echo "<br><br>";
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo '<tr align="center" ><th>ID</th>';
  echo '<th align="center" >Libellé</th>';
  echo '<th align="center" >URL</th>';
  echo '<th align="center" >Contact</th>';
  echo '<th align="center" >Telephone</th>';
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['id_ligue']."</td>"; 
  echo "<td>".$row['lib_ligue']."</td>";
  echo "<td>".$row['URL_ligue']."</td>";
  echo "<td>".$row['contact_ligue']."</td>";
  echo "<td>".$row['telephone_ligue']."</td>";
  }
  echo "</tr>"; 
echo "</table>";
?>
<?php
$raws = $LigueDAO->findperiode();
  ?>
<br>
 <form action="modifier_ligue.php" method="post"> 
  <select name="ID" id="id" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }    
  ?>
  </select><br><br>
<form action="ajouter_ligue.php" method="post">
<label for="lib">Libellé :</label><br>
<input type="text" id="lib" name="lib" required><br><br>
<label for="url">URL :</label><br>
<input type="text" id="url" name="url" required><br><br>
<label for="contact">Contact :</label><br>
<input type="text" id="contact" name="contact" ><br><br>
<label for="tel">Telephone :</label><br>
<input type="number" id="tel" name="tel" ><br><br>
<input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
        if(isset($_POST['enregistrement'])){
            $lib = $_POST['lib'];
            $url = $_POST['url'];
            $contact = $_POST['contact'];
            $tel = $_POST['tel'];

            $Ligue = new Ligue(array(
              'lib'=>$lib,
              'url'=>$url,
              'contact'=>$contact,
              'tel'=>$tel,
            ));
            $nb = $LigueDAO->update($Ligue);
            if($nb == 1){ 
              echo "<br>$lib a bien été modifié(e)";
            }else{ 
              echo "<br>$lib n'a pas été modifié(e)";
            }           
        }
  ?>
</form>
<!-- <button onclick="myFunction()">Reload page</button>
<script>
function myFunction() {
    location.reload();
}
</script> -->
</body>
</html>