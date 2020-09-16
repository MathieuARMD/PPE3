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
if(isset($_SESSION['session_username'])) {
  echo '<p>Bienvenue, ' . $_SESSION['session_username'] . '</p>';
}
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
    <li><a href="login.php">Se connecter</a></li>
  </ul>
</nav>
<hr color="black">
<!-- Paragraphe --> 

<br>
<div class="outer-div">
        <div class="inner-div">

<h2>BIENVENUE SUR LE SITE DE LA M2L FREDI </h2>
<br>
</div>

</body>
</html>