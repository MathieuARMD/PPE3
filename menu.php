<div id=conteneur>
<div id="menu">
    <h2>MENU</h2>
    <?php if(isset($_SESSION['session_idusertype'])) {
            if ($_SESSION['session_idusertype'] == 2 || $_SESSION['session_idusertype'] == 3) {
                echo '<li><a href="backoffice.php">Back-office</a></li>';
            }
        } ?>
</div>
