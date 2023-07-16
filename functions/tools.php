<?php

    function getCategories($bdd){
        $sql = "SELECT * FROM category";

        $req = $bdd->prepare($sql);
        $req->execute();
        $res = $req->fetchall(PDO::FETCH_ASSOC);

        return $res;
    }

    function getTransactions($bdd, $id) {

        $sql = "SELECT transaction.*,
                    category.name AS category_name,
                    transaction_type.name AS type
                FROM transaction
                JOIN category ON category_id = category.id
                JOIN transaction_type ON type_id = transaction_type.id";


        if($id != 1) {
            $sql = $sql .  " WHERE author_id =  ?";
        }

        $req = $bdd->prepare($sql);
        if($id != 1) {
            $req->execute([$id]);
        } else {
            $req->execute();
        }
        $res = $req->fetchall(PDO::FETCH_ASSOC);

        return $res;
    }

    function getTransaction($bdd, $id) {

        $sql = "SELECT * FROM transaction WHERE author_id = ?";

        $req = $bdd->prepare($sql);
        $req->execute([$id]);
        $res = $req->fetchall(PDO::FETCH_ASSOC);

        return $res;
    }

    function getBalance($bdd) {
       $sql = " SELECT
                (SELECT IFNULL(SUM(transaction.amount),0) FROM transaction WHERE author_id = " . $_SESSION["id"] . " AND type_id = 2)
                - (SELECT IFNULL(SUM(transaction.amount),0) FROM transaction WHERE author_id = " . $_SESSION["id"] . " AND type_id = 1) AS Balance";

        $req = $bdd->prepare($sql);
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);

        return $res["Balance"];
    }

    function getDebitTransactions($bdd, $id) {

        $sqlAllDebit = "SELECT transaction.id, date, description, amount, category.name AS category_name,
                        transaction_type.name AS type
                    FROM transaction
                    JOIN category ON category_id = category.id
                    JOIN transaction_type ON type_id = transaction_type.id
                    WHERE author_id = ? AND type_id = 1";

        $req = $bdd->prepare($sqlAllDebit);
        $req->execute([$id]);
        $res = $req->fetchall(PDO::FETCH_ASSOC);

        return $res;
    }

    function getCreditTransactions($bdd, $id) {

        $sqlAllCredit = "SELECT transaction.id, date, description, amount, category.name AS category_name,
                        transaction_type.name AS type
                    FROM transaction
                    JOIN category ON category_id = category.id
                    JOIN transaction_type ON type_id = transaction_type.id
                    WHERE author_id = ? AND type_id = 2";

        $req = $bdd->prepare($sqlAllCredit);
        $req->execute([$id]);
        $res = $req->fetchall(PDO::FETCH_ASSOC);

        return $res;
    }

    function getDebitOverview($bdd, $id) {

        $sqlDebit = "SELECT SUM(amount) AS amount, category.name AS category_name
                    FROM transaction
                    JOIN category ON category_id = category.id
                    WHERE author_id = ? AND type_id = 1
                    GROUP BY category_id";  

        $req = $bdd->prepare($sqlDebit);
        $req->execute([$id]);
        $res = $req->fetchall(PDO::FETCH_ASSOC);

        return $res;
    }

    function getCreditOverview($bdd, $id) {

        $sqlCredit = "SELECT SUM(amount) AS amount, category.name AS category_name
                    FROM transaction
                    JOIN category ON category_id = category.id
                    WHERE author_id = ? AND type_id = 2
                    GROUP BY category_id";      

        $req = $bdd->prepare($sqlCredit);
        $req->execute([$id]);
        $res = $req->fetchall(PDO::FETCH_ASSOC);

        return $res;
    }
?>