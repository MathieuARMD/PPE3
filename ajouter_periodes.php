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
      <li><a href="ajouter_periodes.php">Ajouter</a></li>
      <li><a href="modifier_periodes.php">Modifier</a></li>
      <li><a href="desactiver_periodes.php">Desactiver</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">
<br><br><br>
<form action="ajouter_periodes.php" method="post">
  <label for="date">Année :</label><br>
  <input type="number" id="date" name="date" required><br><br>
  <label for="forfait">Forfait Kilometrique :</label><br>
  <input type="number" id="forfait" name="forfait" required><br><br>
  <select name="Statut" id="Statut" required>
     <option value="0">Activer</option>
     <option value="1">Desactiver</option>
</select>
 <input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php

    $dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        if(isset($_POST['enregistrement'])){
          $date = $_POST['date'];
          $forfait = $_POST['forfait'];
          $statut = $_POST['Statut'];
          $sql2 = "SELECT annee_per, statut_per FROM periode WHERE statut_per = 0";
            try { 
              $sth = $dbh->prepare($sql2);
              $sth->execute(); 
              $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
              }catch (PDOException $ex) { 
                die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
              }
              foreach($rows as $row){
                $DByear = $row["annee_per"];
                $DBstatut = $row["statut_per"];
              } $res = $DByear - $date;
              if($res >= 0){
                echo "<br><br>"; 
                echo "<p>Vous ne pouvez pas créer la période $date car l’année n’est pas valide</p>";                
              }elseif($statut == $DBstatut){
                echo "<br><br>"; 
                echo "<p>Vous ne pouvez pas créer la période $date car une période active existe déjà</p>";  
              }else{
                  $sql = "INSERT INTO periode (annee_per, forfait_km_per, statut_per)";
                  $sql .=" VALUES (:date, :forfait, :statut);  "; 
                  try { 
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array( 
                      ':date' => $date, 
                      ':forfait' => $forfait, 
                      ':statut' => $statut,
                      )); 
                    }catch (PDOException $ex) { 
                      die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
                    }
                    $count = $sth->rowCount();
                    if($count == 1){
                      echo "<br><br>"; 
                      echo "<p>La periode de $date a été créé dans l’application FREDI</p>";
                    }
              }        
        } //fin if isset      
?>
</form>
</body>
</html>