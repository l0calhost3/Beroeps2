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

    if ($submit === "login") {
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
        $sql = "SELECT * FROM users WHERE user = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        $login_user = $stmt->fetch();
//        echo $user . "<br>"; echo $pass. "<br>";

        if ($login_user['user'] === $user && $login_user['pass'] === hash('sha256', $pass)) {
            session_start();
            $_SESSION['user'] = $login_user['user'];
            header("location: ../dashboard");

        }
        else{
            header("location: ./");
        }


    }
    if ($submit === "Create") {
        $create_pass = isset($_POST["create_pass"]) ? $_POST["create_pass"] : "";
        $create_user = isset($_POST["create_input"]) ? $_POST["create_input"] : "";
        var_dump($create_user); var_dump($create_pass);
        if (!$_SERVER["REQUEST_METHOD"] == "POST") {
            array_push($errors, "Ongeldige post request");
        }
        if (empty($create_user) || empty($create_pass)) {
            array_push($errors, "username of password is leeg");
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $create_user) || !preg_match("/^[a-zA-Z0-9]*$/", $create_pass)) {
            array_push($errors, "Ongeldige naam");
        }
        if (!count($errors) == 0) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
        else{
            $query = "
            INSERT INTO users (user, pass) values (:username, :password);
        ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':username' => $create_user,
                ':password' => hash('sha256', $create_pass),
            ]);
            header("location: ./");

        }
    }
