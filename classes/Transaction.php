<?php 
    class Transaction{

        private $pdo;
        public $author_id;
        public $description;
        public $category;
        public $type;
        public $amount;

        public function __construct($author_id, $description, $category, $type,  $amount)
        {
            $this->author_id = $author_id;
            $this->description = $description;
            $this->category = $category;
            $this->amount = $amount;
            $this->type = $type;
            $this->pdo = new Database();
        }

        public function add() {

            $sql = "INSERT INTO transaction (date, type_id, category_id, description, amount, author_id)
                    VALUES (CURRENT_TIMESTAMP,?,?,?,?,?)";
            $req = $this->pdo->bdd->prepare($sql);
            $req->execute( [$this->type, $this->category, $this->description,
                            $this->amount, $this->author_id] );
        }

        public function edit($id) {

            $sql = "UPDATE transaction 
            SET type_id = ?, category_id = ?, description = ?, amount = ?,
            WHERE id = ?";

            $req = $this->pdo->bdd->prepare($sql);
            $req->execute( [$this->type, $this->category, $this->description, $this->amount, $id] );
        }
    }
?>