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

<hr color="orange">
<nav>
  <ul>
      <li><a href="ajouter_club.php">Ajouter</a></li>
      <li><a href="modifier_club.php">Modifier</a></li>
      <li><a href="supprimer_club.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="orange">

<br><br>
<?php $ClubDao = new ClubDao();
      $raws = $ClubDao->findclub();
?>
<form action="supprimer_club.php" method="post">
  <select name="libmotif" id="libmotif" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }    
  ?>
  </select><br><br>
  <input type="submit" name="Supprimer" value="&nbsp;Supprimer&nbsp;">
</form>
<br>
<?php
        if(isset($_POST['Supprimer'])){
          $libmotif = $_POST['libmotif'];
          $id = $ClubDao->findtheID($libmotif);     
          $nb = $ClubDao->delete($id);
          if($nb == 1){
            echo "<br>Le motif N°$id a bien été Supprimer dans la base FREDI";
          }else{
            echo "<br>Le motif N°$id n'a pas été Supprimer dans la base FREDI";
          }
        }        
?>
</body>
</html>