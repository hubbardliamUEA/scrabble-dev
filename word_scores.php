<?php
use Src\Boot;
use Src\Engine\Dictionary\Dictionary;
use Src\Engine\Scrabble;

require_once 'Src/Boot.php';

$boot = new Boot();
$dictionary = new Dictionary($boot);
$scrabble = new Scrabble($dictionary);

    $tiles = json_decode(file_get_contents('php://input'), true);
    $scores = $scrabble->matchInDictionary(implode($tiles));
    echo json_encode($scores);

?>
