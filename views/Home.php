<?php 
    $title = "Accueil";
    $gallery = "assets/gallery/";
?>
<h1>FILMCOLLECTIONGENIAL.COM</h1>
<div>Bonjour <?= $_SESSION['user']['pseudo']?> !</div>
<nav>
    <a href="index.php?page=filmform">Ajouter un film</a>
    <a href="index.php?action=disconnect">Se déconnecter</a>
</nav>
<h2>Liste des films:</h2>
<div class="gallery flex">
    <?php
        foreach ($data['movies'] as $movie) {
    ?>
        <figure>
            <a href="index.php?page=film&id=<?= $movie->movie_id?>">
                <?php 
                    if(!empty($movie->movie_poster))
                        echo "<img src=\"$gallery$movie->movie_poster\" alt=\"$movie->movie_title\">";
                    else 
                        echo '<div class="noposter">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        </div>';
                ?>
            <figcaption><?= $movie->movie_title ?></figcaption>
            </a>
        </figure>
    <?php
        }
        if(sizeof($data['movies']) == 0)
            echo "Il n'y a aucun film à montrer !";
    ?>
</div>