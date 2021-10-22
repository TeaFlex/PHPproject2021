<?php
include_once './controller/BaseController.php';
include_once './model/AccessSQL.php';

class RegistrationController extends BaseController {

    function index() {
        if(isset($_SESSION['error']) && $_SESSION['error'])
            self::getView($_GET['page'], $_SESSION['error']);
        else
            parent::index();
    }

    function handler() {
        $fields = [
            'pseudo' => &$_POST['pseudo'],
            'email' => &$_POST['email'],
            'pwd' => &$_POST['password'],
            'rpwd' => &$_POST['rpassword']
        ];

        try {
            foreach ($fields as $key => &$value) {
                if(empty($value) || !isset($value))
                    throw new Exception("Un des champs est vide !");
                self::sanitize($value);
            }

            if(strlen($fields['pseudo'])<5)
                throw new Exception("Votre pseudo doit comporter au moins 5 caractères.");
            
            if(!filter_var($fields['email'], FILTER_VALIDATE_EMAIL))
                throw new Exception("Vous devez rentrez une adresse électronique valide.");
            
            if(strlen($fields['pwd'])<6)
                throw new Exception("Votre mot de passe doit comporter au moins 6 caractères.");

            if($fields['pwd'] != $fields['rpwd'])
                throw new Exception("La confirmation du mot de passe n'est pas identique au mot de passe.");

            //TODO tester préexsitence mail

        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            self::redirectToPage("registration");
            //echo $th;
        }

        $sql = new AccessSQL();
        $sql->init();
        $sql->insertInto('users', [
            "user_name" => $fields['pseudo'],
            "user_hashpwd" => password_hash($fields['pwd'], null),
            "user_email" => strtolower($fields['email'])
        ]);
        $sql = null;
        
        // debug lines
        // print_r($fields);
        // echo count($fields);
        // exit();

        self::redirectToPage("connection");
    }
}