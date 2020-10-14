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

<?php if ($_SESSION['session_libtype']=="Administrateur") {// possibilité de réponse ou supression seulement si admin
?>
<br><br><br>
<center><button class="bouton" type="button" onclick="window.location.href = 'ajouter_motif.php'">
    Ajouter motif(s)
</button></center>

<br><br>

<center><button class="bouton" type="button" onclick="window.location.href = 'modifier_motif.php'">
    Modifier motif(s)
</button></center>

<br><br>

<center><button class="bouton" type="button" onclick="window.location.href = 'supprimer_motif.php'">
    Supprimer motif(s)

</button></center>

<br><br>

<center><button class="bouton" type="button" onclick="history.back()">
    Retour
</button></center>
<?php 
}?>


</body>
</html>