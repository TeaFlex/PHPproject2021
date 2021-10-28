<?php 
    $title = "Accueil";
?>
<h1>FILMCOLLECTIONGENIAL.COM</h1>
<div>Bonjour <?= $_SESSION['user']['pseudo']?> !</div>
<nav>
    <a href="index.php?page=filmform">Ajouter un film</a>
    <a href="index.php?action=disconnect">Se déconnecter</a>
</nav>
<h2>Liste des films:</h2>
<?php

?>