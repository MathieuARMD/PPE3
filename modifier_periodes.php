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
<?php

  //pour filtrer par utilisateur
  if (isset($_POST['utilisateur'])){ // si $post[utilisateur] existe
    if ($_POST['utilisateur'] != '0') { // si ce n'est pas tous les utilisateurs
        $utilisateur = " AND pseudo='".$_POST['utilisateur']."'"; // complete la requete pour filtrer avec son nom
    }
    else {
      $utilisateur=""; // sinon requete inchangée
  }
  }
  else {
      $utilisateur=""; // sinon requete inchangée
  }

  $sql = "SELECT * FROM periode"; // requete sql
  $dsn = 'mysql:host=localhost;dbname=fredi;charset=UTF8'; 
  $user = 'root';
  $password = '';
  try {
  $dbh = new PDO($dsn, $user, $password);
  $sth = $dbh->prepare($sql);
  $sth->execute(); 
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
  die("Erreur lors de la requête SQL : ".$ex->getMessage());
  }

    // Affichage de la liste des colonnes
  echo "<br><br>";
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo '<tr align="center" ><th>Année</th>';
  echo '<th align="center" >Forfait Kilometrique</th>';
  echo '<th align="center" >Status</th>';
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['annee_per']."</td>"; 
  echo "<td>".$row['forfait_km_per']."</td>";
  if($row['statut_per'] == 0) 
    echo "<td>".$row['statut_per']." - Activer</td>";
  if($row['statut_per'] == 1)
    echo "<td>".$row['statut_per']." - Desactiver</td>";
  }
  echo "</tr>"; 
echo "</table>";

//autre requette sql pour liste deroulante dinamique

$sql = "SELECT annee_per FROM periode"; // requete sql
  $dsn = 'mysql:host=localhost;dbname=fredi;charset=UTF8'; 
  $user = 'root';
  $password = '';
  try {
  $dbh = new PDO($dsn, $user, $password);
  $sth = $dbh->prepare($sql);
  $sth->execute(); 
  $raws = $sth->fetchALL(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
  die("Erreur lors de la requête SQL : ".$ex->getMessage());
  }
  ?>
<br>
 <form action="modifier_periodes.php" method="post"> 
  <select name="Année" id="Année" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }    
  ?>
  </select><br><br>
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
            $date = $_POST['Année'];
            $forfait = $_POST['forfait'];
            $statut = $_POST['Statut'];       
          $sql = "UPDATE utilisateur SET annee_per = :datereg, forfait_km_per = :forfait, statut_per = :statut WHERE annee_per = :datereg"; 
          try { 
            $sth = $dbh->prepare($sql);
            $sth->execute(array( 
              ':datereg' => $date, 
              ':forfait' => $forfait,
              ':statut' => $statut,              
              ));
              print_r($sth);
            }catch (PDOException $ex) { 
            die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
            }
            $count = $sth->rowCount();
            if($count == 1){ 
              echo "<p>test ok</p>";
            }else{ 
              echo "<p>test non ok</p>";
            }           
        }
        /*if(isset($_POST['enregistrement'])){
          echo "<br>La période $date a été modifiée";
          $delai=2; 
          $url='modifier_periodes.php';
          header("Refresh: $delai;url=$url");
        }*/

  ?>
</form>

</body>
</html>