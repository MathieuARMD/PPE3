<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css\style.css">
    <title>Login</title>
</head>
<body>
    <?php include 'top.php';?>
    <?php include 'menu.php'; ?> 
    <h2>Connexion</h2><br>
    <?php
    if(isset($_POST['submit'])) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $sql = "select password_util, nom_util from utilisateur where nom_util = '".$username."'";
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sth = $dbh->prepare($sql);
                $sth->execute(array());
                $row = $sth->fetch(PDO::FETCH_ASSOC);
                if ($username == $row['nom_util']) {
                    if (password_verify($_POST['password'], $row['password_util'])) {
                        echo '<p>Connexion réussie !</p>';
                        $_SESSION['session_username'] = $username;
                        $_SESSION['session_password'] = $password;
                        header('Location: index.php');
                        exit();
                        } else {
                        echo '<p>Mauvais mot de passe</p>';
                    }
                } else {
                    echo '<p>Cet utilisateur n\'existe pas</p>';
                }
            } 
            catch (PDOException $ex) {
                die("Erreur lors de la connexion SQL : " . $ex->getMessage());
            }
        }
    } ?>
        <div class="login">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>", method="post" >
            Nom d'utilisateur :<br>
            <input type="text" name="username" <?php if(isset($_POST['submit'])) { if (isset($_POST['username'])) { echo ' value='.$_POST['username']; } } ?> required><br>
            Mot de passe :<br>
            <input type="password" name="password" <?php if(isset($_POST['submit'])) { if (isset($_POST['password'])) { echo ' value='.$_POST['password']; } } ?> ><br><br>
            <input type="submit" name="submit" value="Connexion"><br><br><br>
            <a href="motdepasse.php">Mot de passe oublier!</a>
        </form>
        </div>
</body>
</html>