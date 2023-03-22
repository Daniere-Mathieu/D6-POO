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
    <title>Delete <?= $teacher->getFullName()?></title>
</head>

<body>
    <?php View::render('partials/header'); ?>
    <h1 class="padding-10">Delete</h1>
    <div class="padding-10">
        <p>Are you sure to delete <?= $teacher->getFullName() ?> ?</p>
        <form action="/student/delete" method="post">
            <input type="hidden" name="id" value="<?= $teacher->getId() ?>">
            <button type="submit">Sure to delete</button>
        </form>
    </div>
</body>

</html>