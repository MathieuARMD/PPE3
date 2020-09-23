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
  echo '<h2>BIENVENUE '.$_SESSION['session_libtype'].'</h2>'; 
  }else {
    echo'<h2> Il semblerai qu il y ai une erreur, veuillez reessayer. </h2>';
  }?>
<br><br><br>
<button class="bouton" type="button"><a href:''>
    Modifier
</button>
<button class="bouton" type="button">
    Supprimer
</button>
<button class="bouton" type="button">
    Desactiver
</button>


</body>
</html>