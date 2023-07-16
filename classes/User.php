<?php

    include "Database.php";

    class User{

        public $id;
        public $email;
        private $pdo;

        function __construct($email)
        {
            $this->email = $email;
            $this->pdo = new Database();
        }

        public function register($password, $firstname, $lastname) {
            
            $req = $this->pdo->bdd->prepare( "SELECT * FROM user WHERE email = ?" );
            $req->execute( [$this->email] );
            $user = $req->fetch();
            
            // Ajout de l'utilisateur a la base de données si le formulaire est valide et l'utilisateur n'existe pas déja
            if(empty($user)) {
                $sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (?,?,?,?)";
                $req = $this->pdo->bdd->prepare($sql);
                $req->execute( [$firstname, $lastname, $this->email, hash("sha256", $password)] );

                return True;
            }
            return false;
        }

        public function connect($password){

            $req = $this->pdo->bdd->prepare( "SELECT * FROM user WHERE email = ? AND password = ?" );
            $req->execute( [$this->email, hash("sha256", $password)] );
            $user = $req->fetch();
            
            if($user) {

                $this->id = $user["id"];

                $_SESSION["id"] = $user["id"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["firstname"] = $user["firstname"];
                $_SESSION["lastname"] = $user["lastname"];
                
                return true;
            }
            return False;
        }
    }
?> 