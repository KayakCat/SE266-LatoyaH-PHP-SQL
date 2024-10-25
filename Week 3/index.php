<?php
$person = new Person('latoya', 'hall');

include 'person.php';
?>

<h1<?= $person->getFirst(); ?>

figure out how to pass in the account balance when submitting the form - do not use session variables. use sets and gets and constructors