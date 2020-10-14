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
      <li><a href="supprimer_motif.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">

<br><br>

<form action="supprimer_motif.php" method="post">
  <label for="idmotif">ID Motif :</label><br>
  <input type="idmotif" id="idmotif" name="idmotif" required><br><br>
  <input type="submit" name="Supprimer" value="&nbsp;Supprimer&nbsp;">
</form>
<br>
<?php
    //  $dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // if(isset($_POST['Supprimer'])){
    // $idmotif = $_POST['idmotif'];       
    // $sql = "SELECT id_mdf FROM ligne_de_frais"; 
    // try { 
    // $sth = $dbh->prepare($sql);
    // $sth->execute(array(':idmotif' => $idmotif));
    // }catch (PDOException $ex) { 
    // die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
    // }   
    // $count = $sth->rowCount();
    // if($count == 0 ){
    //  echo "<br><br>"; 
    // echo "<p>Le motif $idmotif est déjà utilisé dans une note de frais</p>";
    // }          
    // }  
$dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        if(isset($_POST['Supprimer'])){
          $idmotif = $_POST['idmotif'];       
          $sql = "DELETE FROM motif_de_frais WHERE id_mdf = :idmotif"; 
          try { 
            $sth = $dbh->prepare($sql);
            $sth->execute(array(':idmotif' => $idmotif));
            }catch (PDOException $ex) { 
            die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
            }   
            echo "<br><br>"; 
            echo "<p>Le motif $idmotif a bien été supprimé</p>"; 
        }
        
?>
<!-- DELETE FROM utilisateur WHERE email_util = :email -->
</body>
</html>