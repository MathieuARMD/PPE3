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
  <li><a href="ajouter_periodes.php">Ajouter</a></li>
    <li><a href="modifier_periodes.php">Modifier</a></li>
    <li><a href="desactiver_periodes.php">Desactiver</a></li>
    <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">
<br><br>
<?php $PeriodeDAO = new PeriodeDAO();
      $raws = $PeriodeDAO->findperiode();
?>
<form action="desactiver_periodes.php" method="post">
    <select name="Année" id="annee" required>
    <?php
        foreach($raws as $raw){
        foreach($raw as $value){
            echo "<option value='" .$value. "'>" .$value. "</option>";
        }
        }    
    ?>
    </select><br><br>
  <input type="submit" name="Desactiver" value="&nbsp;Desactiver OU Activer&nbsp;">
</form>
<br>
<?php
        if(isset($_POST['Desactiver'])){
          $datereg = $_POST['Année'];
          $val =  $PeriodeDAO->disalbedornot($datereg);
          $nb = $PeriodeDAO->Disabled($datereg, $val);
          if($nb == 1){
            echo "<br><p>La periode $datereg a bien ete desactivée</p>";
          }elseif($nb == 2){
            echo "<br><p>La periode $datereg a bien ete Activer</p>";
          }else{
            echo "<br><p>La periode $datereg n'a pas ete desactivée ou Activer</p>";
          }
        }
?>
</body>
</html>