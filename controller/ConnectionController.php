<?php
include_once './controller/BaseController.php';

class ConnectionController extends BaseController {

    function index() {
        $messages = [
            'error' => null,
            'success' => null
        ];

        if(isset($_SESSION['success']) && $_SESSION['success'])
            $messages['success'] = $_SESSION['success'];
        if(isset($_SESSION['error']) && $_SESSION['error'])
            $messages['error'] = $_SESSION['error'];
        
        self::getView($_GET['page'], $messages);
    }

    function handler() {
        $fields = [
            'email' => &$_POST['email'],
            'pwd' => &$_POST['password'],
        ];

        $sql = new AccessSQL();
        $sql->init();
        $db = $sql->getDB();

        try {
            foreach ($fields as $key => &$value) {
                if(empty($value) || !isset($value))
                    throw new Exception("Un des champs est vide !");
                self::sanitize($value);
            }
            $req = $db->prepare("SELECT * from Users WHERE user_email = :email;");
            $req->bindValue(":email", $fields['email']);
            $req->execute();
            $req->setFetchMode(PDO::FETCH_OBJ);
            $res = $req->fetchAll()[0];
            $req->closeCursor();

            if(!$res) 
                throw new Exception("Ce compte n'existe pas.");

            if(!password_verify($fields['pwd'], $res->user_hashpwd))
                throw new Exception("Le mot de passe n'est pas valide.");
            
            $_SESSION['user'] = [
                'id' => $res->user_id,
                'pseudo' => $res->user_name,
                'email' => $res->user_email
            ];
            
            self::redirectToPage('home');
        } 
        catch (\PDOException $pdoe) {
            throw $pdoe;
        }
        catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            self::redirectToPage("connection");
        }
        finally {
            $sql = null;
        }
    }
}