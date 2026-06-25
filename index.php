<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Specksteinofenbau</title>

    <link rel="stylesheet" href="assents/css/app.css">
</head>

<body>

<?php
require_once 'src/Calculator.php';
require_once 'src/schnittplan.php';
require_once 'src/Aufteilung.php';

$calculator = new Calculator(
    66, // Laenge
    42, // Breite
    121, //Hoehe
    7, //Stein
    3 //Ebenen
);
$result = $calculator->calculate();


$aufteilung = new Aufteilung($result['teile'], 190, 150);

$aufteilungResult = $aufteilung ->berechnen();
$positionen = $aufteilungResult['positionen'];
$maxHoehe = $aufteilungResult['maxHoehe'];
$maxBreite = $aufteilungResult['maxBreite'];

echo "Maximale Hoehe:" . $maxHoehe . "<br><br>";
echo "<h1>Specksteinofenbau</h1>";

echo "<h2> Berechnung</h2>";

echo "Nutzbare Hoehe: ".$result['nutzbareHoehe']. " cm<br>";
echo "Ebenenhoehe: ".$result['ebenenHoehe']. " cm<br>";

echo "<h2>Stuckliste</h2>";

    foreach ($result['stuckliste'] as $ebene => $teile){
        $roman = str_replace("Ebenen ", "", $ebene);

        foreach ($teile as $seite => $masse){
            echo $roman . " " . $seite . " | " . $masse[0] . " x " . round($masse[1]) . "<br>";
        }
        echo "<br>";

    }
        echo "Deckel: ". $result['deckel']['laenge']. "x" .$result['deckel']['breite']. "<br><br>";
echo "<h2>Aufteilung</h2>";
    echo "Maximale Plattenhoehe:" . $maxHoehe . "cm<br><br>";
    if ($maxHoehe > 150){
        echo "Platte zu Klein!!<br><br>";
    }else{
        echo "Platte ausreichend.<br><br>";
    }

    foreach ($positionen as $teil){
        echo $teil['id'] ." | X=".$teil['x'] ." | Y=".$teil['y'] ." | B=".$teil['laenge'] ." | H=".$teil['hoehe'] ."<br>"; 
    }
        echo "<h2>SVG Vorschau</h2>";

echo '<svg class="platten-svg" viewBox="0 0 250 200">';

// Pedra 190 x 150
echo '<rect x="30" y="25" width="190" height="150" fill="none" stroke="red";/>';

// Cota horizontal
echo '<line x1="30" y1="15" x2="220" y2="15" stroke="red"/>';

echo '<text x="125" y="10" class="bauteil-mass"> 190 cm</text>';


// Cota vertical
echo '<line x1="15" y1="25" x2="15" y2="175" stroke="red"/>';

echo '<text x="10" y="100" transform="rotate(-90 10 100)" class="bauteil-mass"> 150 cm</text>';


// Aufteilung
foreach ($positionen as $teil) {

    echo '<rect x="' . ($teil['x'] + 30) . '" y="' . ($teil['y'] + 25) . '" width="' . $teil['laenge'] . '" height="' . $teil['hoehe'] . '" fill="yellow" stroke="black" 
    />';

    // Nome da peça
    echo '<text
            class="bauteil-id"
            x="' . ($teil['x'] + 30 + ($teil['laenge'] / 2)) . '"
            y="' . ($teil['y'] + 25 + ($teil['hoehe'] / 2) - 5) . '"
    >' . $teil['id'] . '</text>';

    // Medidas da peça
    echo '<text
            class="bauteil-mass"
            x="' . ($teil['x'] + 30 + ($teil['laenge'] / 2)) . '"
            y="' . ($teil['y'] + 25 + ($teil['hoehe'] / 2) + 5) . '"
    >' . $teil['laenge'] . 'x' . $teil['hoehe'] . '</text>';
}

echo '</svg>';

$schnittplan = new Schnittplan($result['teile']);
$gruppen = $schnittplan->gruppierenNachHoehe();
echo "<h2>Schnittplan V2</h2>";
foreach ($gruppen as $streifen){
    echo "<strong>Tira {$streifen->getHoehe()} cm</strong><br>";
    echo "Gesamtbreite: {$streifen->getGesamtbreite()} cm <br><br>";
    foreach($streifen->getTeile() as $teil){
        echo $teil['id'] . " (" .$teil['laenge']. " cm)<br>";
    }
    echo "<br>";
}
?>


</body>
</html>