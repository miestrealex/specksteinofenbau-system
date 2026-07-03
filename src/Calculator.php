<?php
require_once 'src/Bauteil.php';
class Calculator{
    private float $laenge;
    private float $breite;
    private float $hoehe;
    private float $steinstarke;
    private int $ebenen;
    private float $sockel;

    public function __construct(
        float $laenge,
        float $breite,
        float $hoehe,
        float $steinstarke,
        int $ebenen,
        float $sockel         
    ){
        $this->laenge = $laenge;
        $this->breite = $breite;
        $this->hoehe = $hoehe;
        $this->steinstarke = $steinstarke;
        $this->ebenen = $ebenen;
        $this->sockel = $sockel;
    }
    public function calculate(): array{
        $deckel = ['laenge' => $this->laenge, 'breite' => $this->breite];

        $nutzbareHoehe = $this->hoehe - $this->steinstarke - $this->sockel;
        $ebenenHoehe = round(($nutzbareHoehe / $this->ebenen) * 2) / 2;

        $vorderwand = $this->laenge - $this ->steinstarke;
        $hinterwand = $this->laenge - $this ->steinstarke;

        $links = $this->breite - $this->steinstarke;
        $rechts = $this->breite - $this->steinstarke;

        $stuckliste = [];
        $roman = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X'
        ];

        $teile = [];

            for ($i = 1; $i <= $this->ebenen; $i++) {
                $stuckliste["Ebenen ".$roman[$i]] = [
                    'V' => [$vorderwand, $ebenenHoehe],
                    'H' => [$hinterwand, $ebenenHoehe],
                    'L' => [$links, $ebenenHoehe],
                    'R' => [$rechts, $ebenenHoehe]
                ];

            // Vorne
            $teile[] = new Bauteil($roman[$i] . ' V', $vorderwand, $ebenenHoehe);

            // Hinten
            $teile[] = new Bauteil($roman[$i] . ' H', $hinterwand, $ebenenHoehe);

            // Links 
            $l = new Bauteil($roman[$i] . ' L', $links, $ebenenHoehe);
            $l->setHorizontal(false);
            $teile[] = $l;

            // Rechts
            $r = new Bauteil($roman[$i] . ' R', $rechts, $ebenenHoehe);
            $r->setHorizontal(false);
            $teile[] = $r;
}
        return[
            'deckel' => $deckel,
            'nutzbareHoehe' => $nutzbareHoehe,
            'ebenenHoehe' => $ebenenHoehe,
            'stuckliste' => $stuckliste,
            'teile' => $teile,
            'gesamtBreite' => $this->steinstarke + $vorderwand,
            'gesamtLaenge' => $this->steinstarke + $links,
            'vorderwand' => $vorderwand,
            'hinterwand' => $hinterwand,
            'links' => $links,
            'rechts' => $rechts
        ];
    }
}