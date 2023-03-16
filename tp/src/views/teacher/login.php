<?php 
use \utils\PublicFile;

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('index')?>">
    <title>Document</title>
</head>

<body>
    <h1>Login/Register</h1>
    <div>
        <h2>Login</h2>
        <form action="/teacher/login" method="post">
            <input type="mail" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
    </div>
    <div>
        <h2>Register</h2>
        <form action="/teacher/create" method="post">
            <input type="mail" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">register</button>

        </form>
    </div>
</body>

</html>