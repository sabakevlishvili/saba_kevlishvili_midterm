<?php

include 'db.php';

class Queries{
    public $conn;
    
    function __construct(){
        $db = new DB();
        $this->conn = $db->connection();
    }


    function getAllDictionary(){
        $stmt = $this->conn->prepare('SELECT * FROM dictionary');
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }


    function checkAnsware($answerID){
        $stmt = $this->conn->prepare('SELECT * FROM dictionary WHERE correctAnswer=:answerID');
        $stmt->bindParam(':answerID', $answerID);
        $stmt->execute();
        $data = $stmt->fetchAll();
        echo $data;
        print_r($data);
        return $data;
    }

    function insertDictionary($english, $georgian, $georgianTwo, $correctAnswer){

        if(strlen($english) > 50 || strlen($georgian) > 50 || strlen($english) < 2 || strlen($georgian) <= 2){
        echo 'there has been an error please try adding again';
           
        }else{
            $stmt = $this->conn->prepare("INSERT INTO `dictionary`(`english`, `georgian`, `georgianTwo`, `correctAnswer`) VALUES (:english,:georgian, :georgianTwo, :correctAnswer)");
            $stmt->bindParam(':english', $english);
            $stmt->bindParam(':georgian', $georgian);
            $stmt->bindParam(':georgianTwo', $georgianTwo);
            $stmt->bindParam(':correctAnswer', $correctAnswer);
            
            
            $stmt->execute();
            echo 'it has been added';
        }

    }
}
?>


<?php 

$query = new Queries();
if (isset($_POST['english'])) {
    $query->insertDictionary($_POST['english'], $_POST['georgian'], $_POST['georgianTwo'], $_POST['correctAnswer']);
}

?>