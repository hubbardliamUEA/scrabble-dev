<?php

use Src\Boot;
use Src\Engine\Dictionary\Dictionary;
use Src\Engine\Scrabble;

require_once 'Src/Boot.php';

$boot = new Boot();

$dictionary = new Dictionary($boot);

$scrabble = new Scrabble($dictionary);

$rack = "hjkhkaseiwiq";

/**
 * Engine = $scrabble
 *
 * to run a match use the method matchInDictionary
 * this will return an array of words and scores
 */
var_dump($scrabble->matchInDictionary($rack));
