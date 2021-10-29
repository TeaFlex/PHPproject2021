<?php
include_once './controller/BaseController.php';

class FilmFormController extends BaseController {

    function index() {
        $sql = new AccessSQL();
        $sql->init();

        $data = [
            'error' => (isset($_SESSION['error']))? $_SESSION['error']: null,
            'actors' => $sql->getAllEntries("actors"),
            'languages' => $sql->getAllEntries("languages"),
            'genres' => $sql->getAllEntries("genres"),
            'countries' => $sql->getAllEntries("countries"),
        ];

        $sql = null;
        self::getView($_GET['page'], $data);
    }

    function handler() {
        
        $fields = [
            "movie_title" => &$_POST['movie_title'],
            "movie_year" => &$_POST['movie_year'],
            "available_in" => &$_POST['available_in'],
            "movie_score" => &$_POST['movie_score'],
            "movie_duration" => &$_POST['movie_duration'],
            //"movie_summary" => &$_POST['movie_summary'],
            //"movie_poster" => &$_POST['movie_poster'],
            "movie_genre" => &$_POST['movie_genre'],
            "movie_actors" => &$_POST['movie_actors'],
            "country_id" => &$_POST['country_id'],
        ];

        $facultatives = [
            "movie_summary" => &$_POST['movie_summary'],
            "movie_poster" => &$_POST['movie_poster'],
        ];

        $file = &$_FILES["movie_poster"];
        $target_folder = "assets/gallery/";

        try {
            foreach ($fields as &$value) {
                if(empty($value) || !isset($value))
                    throw new Exception("Un des champs est vide !");
                if(gettype($value) == "string")
                    self::sanitize($value);
            }

            if(!$file['error']) {
                if(!preg_match("/^image\/(png|gif|jpeg)$/m", $file['type']))
                throw new Exception("Le fichier doit être une image !");
            
                if($file['size'] > 400000)
                    throw new Exception("L'image est trop volumineuse !");

                if(strlen($file['name']) > 30)
                    throw new Exception("Le nom de l'image est trop long !");
                
                $file["name"] = self::sanitize($file["name"]);
            }

        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            self::redirectToPage("filmform");
        }

        if(!$file['error']) {
            if(!move_uploaded_file($file["tmp_name"], $target_folder.$file["name"]))
                throw new Exception("Error while uploading the file.");
        }

        $sql = new AccessSQL();
        $sql->init();
        $sql->insertInto('movies', [
            "movie_title" => $fields['movie_title'],
            "movie_poster" => (!empty($file["name"]))?$file["name"]: null,
            "movie_year" => $fields['movie_year'],
            "movie_duration" => $fields['movie_duration'],
            "movie_summary" => $facultatives['movie_summary'],
            "movie_score" => $fields['movie_score'],
            "country_id" => $fields['country_id'],
        ]);

        $id = $sql->getDB()->lastInsertId();

        foreach ($fields['available_in'] as $value) {
            $sql->insertInto("available_in", [
                "movie_id" => $id,
                "lang_id" => $value,
            ]);
        }

        foreach ($fields['movie_actors'] as $value) {
            $sql->insertInto("played_by", [
                "movie_id" => $id,
                "actor_id" => $value,
            ]);
        }

        foreach ($fields['movie_genre'] as $value) {
            $sql->insertInto("have", [
                "movie_id" => $id,
                "genre_id" => $value,
            ]);
        }

        $sql = null;
    }
}