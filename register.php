<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>

    <?php include 'top.php'; ?>
    <?php include 'menu.php'; ?>
    <?php
    //Connexion à la BDD
    if(isset($_POST['submit'])) {
        try {
            $bdd = new PDO ('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $username = $_POST['username'];
            $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $mail = $_POST['email'];
            $prenomuser = $_POST['prenom'];
            $matricule = $_POST['matricule'];
            $sql = "insert into utilisateur (email_util, password_util, nom_util, prenom_util, matricule_cont, id_type_util) values ('".$mail."','".$mdp."','".$username."','".$prenomuser."', '".$matricule."',3)";
            $req = $bdd->prepare($sql);
            $req->execute();
            echo '<p>Inscription réussie !</p>';
            header('Location: login.php');
            exit();
        }
        catch(Exception $e) {
            die('Erreur :'.$e->getMessage());
            echo '<p>marche pas</p>';
        }
        /*
        <form id='loginForm' action="login.php", method="post" >
            <input type="hidden" name="username" value=<?php $username ?>><br>
            <input type="hidden" name="password" value=<?php $mdp ?>><br><br>
        </form>

        <script type="text/javascript">
            document.getElementById("loginForm").submit(); // Here formid is the id of your form
        </script>
        */  
    } else { ?>
    <form class="register", action="<?php echo $_SERVER['PHP_SELF']; ?>", method="post">
        Nom d'utilisateur :<br>
        <input type="text" name="username" required><br>
        Prenom d'utilisateur :<br>
        <input type="text" name="prenom" required><br>
        Mot de passe :<br>
        <input type="password" name="password" required><br>
        Confirmer :<br>
        <input type="password" name="password" required><br>
        Mail :<br>
        <input type="email" name="email" required><br>
        Matricule :<br>
        <input type="number" name="matricule" required><br>        
        </select>
            <input type="submit" name="submit" value="submit">
    </form>
    <?php } ?>
        <?php
        /* if(empty($ID_user) && empty($username) && empty($mdp) && empty($mail) && empty($ligue))
        else{
        session_start();
        $_SESSION['username'] = $_POST['username'];
        header('Location: index.php');
        */

?>
</body>
</html>
