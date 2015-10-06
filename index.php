<?php

require __DIR__ . '/vendor/autoload.php';

use Jfacchini\BeeGame\Game\BeeGame;

if (isset($_POST['hit'])) {
    $beesFile = 'bees.json';
    $beeGame = new BeeGame($beesFile);

    $result = $beeGame->start();
}

?>

<html>
    <head></head>
    <body>
    <?php if (isset($result)) { ?>
        <div><?php echo $result ?></div>
    <?php } ?>
        <form method="post">
            <input type="submit" name="hit" value="Hit">
        </form>
    </body>
</html>