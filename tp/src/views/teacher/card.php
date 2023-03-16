<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $teacher->getname() ?></title>
</head>
<body>
    <div>
        <div>
            <img src="<?php $teacher->getimage() ?>" alt="">
        </div>
        <div>
            <h1><?php $teacher->getname() ?></h1>
            <p><?php $teacher->getemail() ?></p>
        </div>
    </div>
</body>
</html>