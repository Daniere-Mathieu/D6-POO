<?php

use MyClass\Animal;

require_once './class/Animal.php';

$zoo[] = array();

for ($i = 0; $i < 10; $i++) {
    $name = "Number-" . $i;
    $animal = new Animal('Éléphant', $name);
    $zoo[] = $animal;
}

echo $zoo[4]->getName();
$zoo[4]->passAway();
