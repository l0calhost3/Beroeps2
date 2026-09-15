<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$errors = array();
$submit = $_POST["submit"];

    if ($submit == "login") {
        $user = $_POST["create_input"];
        $pass = $_POST["create_pass"];

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
        } else {
            echo "je bent ingelogd";
        }
    }
    if ($submit == "create") {
        $create_pass = $_POST["create_pass"];
        $create_user = $_POST["create_user"];
    }
