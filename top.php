<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fredi</title>
</head>
<body>

<br>
<img class="displayed" alt="FREDI" src="img\fredi.png" title="FREDI">  
<br><br>

<!-- Code php de verification si l'utilisateur est connecté --> 
<?php 
session_start();
?>

<!-- Menu --> 
<hr color="black">
<nav>
  <ul>
    <li><a href="#">Accueil &ensp;</a></li>
    <li class="deroulant"><a href="#">Ligue &ensp;</a>
      <ul class="sous">
        <li><a href="#">Ligue de football</a></li>
        <li><a href="#">Ligue de IDK</a></li>
      </ul>
    </li>
    <?php if(isset($_SESSION['session_username'])) {?>
      <li><a href="logout.php">Déconnexion</a></li>
      <li class="deroulant"><a href="#">Mon compte &ensp;</a>
      <ul class="sous">
        <li><a href="compte.php">Gestion utilisateur</a></li>
        <li><a href="#">Gestion periodes</a></li>
        <li><a href="#">Gestion motifs de frais</a></li>
      </ul>
    </li>
    <?php } else {?>
    <li><a href="login.php">Se connecter</a></li>
    <?php }?>
    
  </ul>
</nav>
<hr color="black">
<!-- Paragraphe --> 

<br>
<div class="outer-div">
        <div class="inner-div">
<?php if(isset($_SESSION['session_username'])) {
  echo '<h2>Bienvenue '.$_SESSION['session_libtype'].' sur le site de la M2L FREDI </h2>'; 
  }else {
    echo'<h2>BIENVENUE SUR LE SITE DE LA M2L FREDI </h2>';
  }?>
<br>
</div>
</body>
</html>