<?php 
include 'includes/header.php'; 

//create an array of animals
$animal = array('capybara', 'zebra', 'koala', 'moo deng(the cutest most disrespectful baby hippo)', 'sloth', 'salmon');

?>

<h1> An array of interesting animals</h1>
<!--create an indexed array using unordered list-->
<ul>
    <?php foreach($animal as $x): ?>
        <li> <?= $x; ?></li><!--list items will allow the list to populate with bullets next to it-->
    <?php endforeach; ?>
</ul>


<?php include 'includes/footer.php'; ?>