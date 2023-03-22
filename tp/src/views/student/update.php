<?php

use \utils\{PublicFile, View};

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= PublicFile::getStyleFile('index') ?>">
    <title>Update <?= $student->getFullName() ?></title>
</head>

<body>
    <?php View::render('partials/header'); ?>
    <h1 class="padding-10">Update</h1>
    <div class="padding-10">
        <form action="/student/update" method="post">
            <input type="hidden" name="id" value="<?= $student->getId() ?>">
            <input type="text" name="name" placeholder="Name" value="<?= $student->getName() ?>">
            <input type="text" name="firstname" placeholder="Firstname" value="<?= $student->getFirstname() ?>">
            <input type="mail" name="email" placeholder="Email" value="<?= $student->getEmail() ?>">
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>