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

<hr color="black">
<nav>
  <ul>
      <li><a href="ajouter.php">Ajouter</a></li>
      <li><a href="modifier.php">Modifier</a></li>
      <li><a href="desactiver.php">Desactiver</a></li>
      <li><a href="supprimer.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">
<br><br><br>
<form action="/action_page.php">
  <label for="fname">E-Mail :</label><br>
  <input type="text" id="fname" name="fname"><br><br>
  <label for="lname">Mot de passe :</label><br>
  <input type="text" id="lname" name="lname"><br><br>
  <label for="lname">Nom :</label><br>
  <input type="text" id="lname" name="lname"><br><br>
  <label for="lname">Prenom :</label><br>
  <input type="text" id="lname" name="lname"><br><br>

  <label for="lname">Matricule</label><br>
  <input type="text" id="lname" name="lname"><br><br>

  <label for="pet-select">Choose a pet:</label>

  <p><SELECT name="type" size="1" required></p>
            <OPTION value="1">Adhérent 
            <OPTION value="2">Contrôleur
            <OPTION value="3">Administrateur
        </SELECT>

  <input type="submit" value=" &nbsp;Envoyer ">
</form>


</body>
</html>