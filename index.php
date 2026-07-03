<?php
require_once 'src/Calculator.php';
require_once 'src/schnittplan.php';
require_once 'src/Aufteilung.php';
require_once 'src/EbenenPlan.php';
require_once 'src/Bauteil.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $laenge = (float) $_POST['laenge'];
    $breite = (float) $_POST['breite'];
    $hoehe = round((float) $_POST['hoehe'] * 2) / 2;
    $steinstaerke = (float) $_POST['steinstaerke'];
    $ebenen = (int) $_POST['ebenen'];
    $sockel = (float) $_POST['sockel'];

    $calculator = new Calculator($laenge, $breite, $hoehe, $steinstaerke, $ebenen, $sockel);

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
        echo $teil->getId() . " (" .$teil->getLaenge() . " cm)<br>";
    }
    echo "<br>";
}


$ebenenPlan = new EbenenPlan($result['teile'], $result['gesamtBreite'], $result['gesamtLaenge']);
echo $ebenenPlan ->render($steinstaerke);





}

?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Specksteinofenbau</title>

    <link rel="stylesheet" href="assents/css/app.css">
</head>

<body>
<div class="container">
    <h1>Neues Projekt</h1>
    <form action="" method="POST">

    <label for="typ">Ofentyp</label>
    <select name="typ" id="typ">
        <option value="rechteckig">Rechteckiger Ofen</option>
    </select>

    <label for="laenge">Gesamtlaenge</label>
    <input type="number" id="laenge" name="laenge">

    <label for="breite">Gesamtbreite</label>
    <input type="number" id="breite" name="breite">

    <label for="hoehe">Gesamthöhe</label>
    <input type="number" id="hoehe" name="hoehe" step="0.5" min="0">

    <label for="steinstaerke">Steinstärke</label>
    <select id="steinstaerke" name="steinstaerke">
        <option value="7">7 cm</option>
        <option value="5">5 cm</option>
    </select>

    <label for="ebenen">Anzahl Ebenen</label>
    <input type="number" id="ebenen" name="ebenen">

    <label for="sockel">Sockel</label>
    <input type="number" id="sockel" name="sockel" value="0">




    <button type="submit">Berechnen</button>

</form>
</div>



</body>
</html>