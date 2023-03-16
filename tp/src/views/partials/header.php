<?php 
use \utils\{PublicFile, Verification};

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
    <header class="header">
        <div>
            <h1>LOGO</h1>
        </div>
        <nav class="nav">
            <ul class="navList">
                <li><a href="/">Home</a></li>
                <li><a href="/teachers">Teachers</a></li>
                <?php if(Verification::isLogged()) {?>
                <li><a href="/teacher/logout">Logout</a></li>
                <?php } else {?>
                    <li><a href="/teacher/log">Login</a></li>
                <?php }?>
            </ul>
        </nav>
    </header>
</body>
</html>