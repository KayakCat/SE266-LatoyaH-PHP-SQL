<?php 
include 'includes/header.php'; 
//create an array of animals
$animal = array('capybara', 'zebra', 'koala', 'moo deng(the cutest most disrespectful baby hippo)', 'sloth', 'salmon');

//create associations for animals
$animalInfo = array(
   'capybara' => 'are the largest rodents on earth.',
   'zebra' => 'are black with white stripes.',
   'koala'=> 'do not really drink water, they get water from all the greens they eat',
   'moo deng(the cutest most disrespectful baby hippo)' => 'lives at the Khao Kheow Open Zoo in Thailand',
   'sloth' => 'moves at a speed of .17mph when threatened',
   'salmon' => 'male salmon can adapt certain female characteristics that enable them to remain close to reproducing females without being veiwed as competition to more dominant males'
)
?>
<h2>Interesting Tidbits</h2>
<ul>
    <?php foreach($animalInfo as $animal => $description): ?>
        <li><?= $animal . ': ' . $description; ?></li>
    <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>