<link rel="stylesheet" href="css/style.css">
<div class="top">
<h1><font size:"+2"><span style="font-family:Calibri"><strong>M2L FREDI</strong></span></font></h1>
<?php 
session_start();
if(isset($_SESSION['session_username'])) {
  echo '<p>Bienvenue, ' . $_SESSION['session_username'] . '</p>';
}
?>
<ul>
<?php if(isset($_SESSION['session_username'])) { ?>
  <li style="float:right"><a class="active" href="logout.php">Déconnexion</a></li>  
  <?php } else { ?>
  <li style="float:left"><a class="active" href="top.php">Accueil</a></li>  
  <li style="float:right"><a class="active" href="login.php">Connexion</a></li>
  <li style="float:right"><a class="active" href="register.php">Inscription</a></li>
  <?php } ?>
</ul>
</div>
