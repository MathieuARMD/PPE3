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

<?php if ($_SESSION['session_libtype']=="Administrateur"||"GOD") {// possibilité de réponse ou supression seulement si admin
?>
<br><br><br>
<center><button class="bouton" type="button" onclick="window.location.href = 'ajouter_periodes.php'">
    Ajouter periodes
</button></center>

<br><br>

<center><button class="bouton" type="button" onclick="window.location.href = 'modifier_periodes.php'">
    Modifier periodes
</button></center>

<br><br>

<center><button class="bouton" type="button" onclick="window.location.href = 'desactiver_periodes.php'">
    Desactiver periodes

</button></center>

<br><br>

<center><button class="bouton" type="button" onclick="history.back()">
    Retour
</button></center>
<?php 
}?>


</body>
</html>