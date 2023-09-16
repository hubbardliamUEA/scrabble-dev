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

$words = $scrabble->matchInDictionary($rack);
$split_letters = $scrabble->formatStringToArray($rack);

?>

<head>
    <style><?php include 'style.css'; ?></style>
</head>
<body>
<div class="container">
    <div style="display: flex; flex-direction: column">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <p>To change the letters in your rack simply replace them below and click update!</p>
            <p>Your current rack: </p>
            <?php echo "<form id='rackForm'>";
            foreach ($split_letters as $index => $letter) {
                echo "<input class='tile' value='$letter' type='text' maxlength='1' id='tile$index'/>";
            } ?>
        </div>
        <button id="updateButton" type="submit">Generate Scores</button>
    </div>
    <table border="1px" id="resultTable">
        <thead>
        <tr>
            <th>Word</th>
            <th>Score</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
    <script>
        document.getElementById("rackForm").addEventListener("submit", function (event) {
            let tiles = [];
            event.preventDefault();
            for (let i = 0; i < 12; i++) {
                tiles.push(document.getElementById(`tile${i}`).value)
            }
            fetch("word_scores.php", {
                method: "POST",
                body: JSON.stringify(tiles),
                headers: {
                    "Content-Type": "application/json"
                }
            }).then((response) => response.json())
                .then((result) => {
                    let tableBody = document.querySelector('#resultTable tbody');
                    tableBody.innerHTML = '';
                    for (let key in result) {
                        let row = tableBody.insertRow();
                        let word = row.insertCell(0);
                        word.textContent = key;
                        let score = row.insertCell(1);
                        score.textContent = result[key];
                    }
                })
                .catch((error) => {
                    console.error('An error occurred:', error);
                });
        });
    </script>
    </div>
</body>