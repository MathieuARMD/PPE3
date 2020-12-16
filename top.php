<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fredi</title>
</head>
<body>
<img class="displayed" alt="FREDI" src="img\bg.png" title="FREDI">  
<!-- Code php de verification si l'utilisateur est connecté --> 
<?php 
session_start();

?>
<?php require_once "init.php";?>
<!-- Menu --> 
<hr color="black">
<nav>
  <ul>
    <li><a href="top.php">Accueil &ensp;</a></li>
    <li class="deroulant"><a href="#">Ligue &ensp;</a>
      <ul class="sous">
      <?php 
      $LigueDAO = new LigueDAO();
      $raws = $LigueDAO->findlib();
      foreach($raws as $raw) {
        foreach($raw as $value){
          echo "<li><a href='".$value.".php'>" .$value. "</a></li>";
        }
      }  
      ?>
      </ul>
    </li>
    <?php if(isset($_SESSION['session_username'])) {?>
      <li><a href="logout.php">Déconnexion</a></li>
      <li class="deroulant"><a href="#">Mon compte &ensp;</a>
      <ul class="sous">
        <li><a href="compte.php">Gestion Utilisateur</a></li>
        <li><a href="periodes.php">Gestion Periodes</a></li>
        <li><a href="motif_frais.php">Gestion Motifs</a></li>
        <li><a href="club.php">Gestion des Clubs</a></li>
        <li><a href="ligue.php">Gestion des Ligues</a></li>
        <li><a href="ligne_de_frais.php">Lignes de Frais</a></li>
        <li><a href="editing.php">Editing</a></li>
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