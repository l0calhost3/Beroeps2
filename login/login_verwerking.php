<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
//connectie database
    $pdo = new PDO("sqlite:../identifier.sqlite");
}catch(PDOException $e){
    echo $e->getMessage();
}

//$main = $pdo->prepare("SELECT * FROM users ORDER BY ID DESC");

$user = isset($_POST["login_input"]) ? $_POST["login_input"] : "";
$pass = isset($_POST["login_pass"]) ? $_POST["login_pass"] : "";

$errors = array();
$submit = $_POST["SUBMIT"];

    if ($submit == "login") {


        if (!$_SERVER["REQUEST_METHOD"] == "POST") {
            array_push($errors, "Ongeldige post request");
        }
        if (empty($user) || empty($pass)) {
            array_push($errors, "username of password is leeg");
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $user) || !preg_match("/^[a-zA-Z0-9]*$/", $pass)) {
            array_push($errors, "Ongeldige naam");
        }
        if (!count($errors) == 0) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
        //login part
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        $login_user = $stmt->fetch();
        if ($login_user['username'] === $user || $login_user['password'] === $pass) {
            session_start();
            var_dump($login_user);
        }
        else{
            echo "Invalid username or password";
        }


    }
    if ($submit == "create") {
        $create_pass = $_POST["create_pass"];
        $create_user = $_POST["create_user"];
    }
