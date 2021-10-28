<div class="center">
    <h2>FilmForm</h2>

    <span class="error"><?= $data['error'] ?></span>
    <form action="index.php?action=filmform" method="post" enctype="multipart/form-data">

        <label for="movie_title">Titre:</label>
        <input type="text" name="movie_title"/>

        <label for="movie_year">Année:</label>
        <input type="number" name="movie_year"/>

        <label for="movie_duration">Durée:</label>
        <input type="time" name="movie_duration"/>

        <label for="available_in">Langue(s):</label>
        <select name="available_in[]" multiple>
            <?php
                foreach ($data['languages'] as $value) 
                    echo "<option value=\"{$value->lang_id}\">{$value->lang_short} ({$value->lang_name})</option>";
            ?>
        </select>

        <label for="country_id">Pays:</label>
        <select name="country_id">
            <?php
                foreach ($data['countries'] as $value) 
                    echo "<option value=\"{$value->country_id}\">{$value->country_name}</option>";
            ?>
        </select>

        <label for="movie_score">Appréciation:</label>
        <select name="movie_score">
            <?php
                for ($i=0; $i <= 10; $i++) 
                    echo "<option value=\"{$i}\">{$i}</option>";   
            ?>
        </select>

        <label for="movie_summary">Sommaire:</label>
        <textarea name="movie_summary" cols="30" rows="10"></textarea>

        <label for="movie_poster">Affiche:</label>
        <input type="file" name="movie_poster">

        <label for="movie_genre">Genre(s):</label>
        <div class="checkboxes">
            <?php
                foreach ($data['genres'] as $value) 
                    echo "<div><input type=\"checkbox\" name=\"movie_genre[]\" value=\"{$value->genre_id}\"/>{$value->genre_name}</div>";
            ?> 
        </div>

        <label for="movie_actors">Acteur(s):</label>
        <select name="movie_actors[]" multiple>
            <?php
                foreach ($data['actors'] as $value) 
                    echo "<option value=\"{$value->actor_id}\">{$value->actor_firstname} {$value->actor_lastname}</option>";
            ?>
        </select>
        <input type="submit" value="Valider"/>
    </form>
</div>