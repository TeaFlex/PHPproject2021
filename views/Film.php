<?php 
    $movie = $data['movie_infos'];
    $gallery = "assets/gallery/";
    $title = $movie->movie_title;
    //print_r($movie);
    echo "<a href=\"index.php?action=film&id=$movie->movie_id&operation=delete\">Supprimer</a>"
?>

<h3 class="movie_title"><?= $movie->movie_title ?></h3>
<div class="flex film">
    <div class="show">
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
    </div>
    <div class="infos">
        <h5>Année:</h5>
        <p><?= $movie->movie_year ?></p>
        <h5>Résumé:</h5>
        <p><?= $movie->movie_summary ?></p>
        <h5>Durée:</h5>
        <span><?= $movie->movie_duration ?></span>
        <h5>Note:</h5>
        <div class="score">
            <?php
            $score = round($movie->movie_score);
            $classscore = "bad";
            if($score >=  5)
                $classscore = "average";
            if($score >= 8)
                $classscore = "good";
            
            for($i=0; $i<$score; $i++) 
                echo "<div class=\"scoreblock $classscore\"></div>";
            ?>
        </div>
        <span><?= $score ?>/10</span>
    </div>
</div>
