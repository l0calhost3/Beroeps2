<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="./login_verwerking.php" method="POST">
    <label for="login_input">username</label>
    <input type="text" id="login_input" name="login_input">
    <label for="login_pass">pass</label>
    <input type="password" id="login_pass" name="login_pass">
    <input type="submit">
    <input type="text" value="login" name="submit" style="display: none">
</form>
<form action="./login_verwerking.php" method="POST">
    <label for="create_input">username</label>
    <input type="text" id="create_input" name="create_input">
    <label for="create_pass">pass</label>
    <input type="password" id="create_pass" name="create_pass">
    <input type="submit">
    <input type="text" value="login" name="submit" style="display: none">

</form>
</body>
</html>
