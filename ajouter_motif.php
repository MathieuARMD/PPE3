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
      <li><a href="ajouter_motif.php">Ajouter</a></li>
      <li><a href="modifier_motif.php">Modifier</a></li>
      <li><a href="desactiver_motif.php">Desactiver</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">
<br><br><br>
<form action="ajouter_motif.php" method="post">
  <label for="libmotif">Libellé motif</label><br>
  <input type="libmotif" id="libmotif" name="libmotif" required><br><br>
  <input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
     
    $dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        if(isset($_POST['enregistrement'])){
          $libmotif = $_POST['libmotif'];       
          $sql = "insert into motif_de_frais (`lib_mdf`)";
          $sql .=" VALUES (:libmotif);  "; 
          try { 
            $sth = $dbh->prepare($sql);
            $sth->execute(array( 
              ':libmotif' => $libmotif, 
              )); 
            }catch (PDOException $ex) { 
            die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
            }
        echo "<br><br>";    
        echo "<p> $libmotif a bien été inséré </p>";          
        }       
?>
</form>
</body>
</html>