<?php

class Calculator{
    private float $laenge;
    private float $breite;
    private float $hoehe;
    private float $steinstarke;
    private int $ebenen;

    public function __construct(
        float $laenge,
        float $breite,
        float $hoehe,
        float $steinstarke,
        int $ebenen
    ){
        $this->laenge = $laenge;
        $this->breite = $breite;
        $this->hoehe = $hoehe;
        $this->steinstarke = $steinstarke;
        $this->ebenen = $ebenen;
    }
    public function calculate(): array{
        $deckel = ['laenge' => $this->laenge, 'breite' => $this->breite];

        $nutzbareHoehe = $this->hoehe - $this->steinstarke;
        $ebenenHoehe = $nutzbareHoehe / $this->ebenen;

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

            for ($i =1; $i <=$this ->ebenen; $i++){

                $stuckliste["Ebenen ".$roman[$i]] = [
                    'V' => [$vorderwand, $ebenenHoehe],
                    'H' => [$hinterwand, $ebenenHoehe],
                    'L' => [$links, $ebenenHoehe],
                    'R' => [$rechts, $ebenenHoehe]
                ];
                $teile [] = ['id' => $roman[$i] . ' V', 'laenge' => $vorderwand, 'hoehe' => $ebenenHoehe];
                $teile [] = ['id' => $roman[$i] . ' H', 'laenge' => $hinterwand, 'hoehe' => $ebenenHoehe];
                $teile [] = ['id' => $roman[$i] . ' L', 'laenge' => $links, 'hoehe' => $ebenenHoehe];
                $teile [] = ['id' => $roman[$i] . ' R', 'laenge' => $rechts, 'hoehe' => $ebenenHoehe];
            }
        return[
            'deckel' => $deckel,
            'nutzbareHoehe' => $nutzbareHoehe,
            'ebenenHoehe' => $ebenenHoehe,
            'stuckliste' => $stuckliste,
            'teile' => $teile,
            'vorderwand' => $vorderwand,
            'hinterwand' => $hinterwand,
            'links' => $links,
            'rechts' => $rechts
        ];
    }
}