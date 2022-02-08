<?php
include_once './controller/BaseController.php';

class FilmController extends BaseController {

    function index(array $toappend = []) {

        $id = &$_GET['id'];

        $data = [];

        $sql = self::getSQLAccess();
        $db = $sql->getDB();
        $query = "SELECT * FROM movies WHERE movie_id=:id;";
        $req = $db->prepare($query);
        $req->bindValue(":id", $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_OBJ);
        $res = $req->fetch();
        $req->closeCursor();

        if(!empty($res))
            parent::index([
                'movie_infos' => $res
            ]);
        else
            self::redirectToPage('home');
    }

    function handler() {
        $action = &$_GET["operation"];
        $id = &$_GET['id'];
        $sql = self::getSQLAccess();
        $db = $sql->getDB();
        switch($action) {
            case "delete":
                $query = "DELETE * from movies WHERE movie_id=:id;";
                $req = $db->prepare($query);
                $req->bindValue(":id", $id);
                $req->execute();
                break;
        }
        exit();
        self::redirectToPage("home");
    }
}