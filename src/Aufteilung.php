<?php
class Aufteilung{
    private array $teile;
    private int $plattenLaenge;
    private int $plattenBreite;

    public function __construct(array $teile, int $plattenLaenge, int $plattenBreite){
        $this ->teile = $teile;
        $this ->plattenLaenge = $plattenLaenge;
        $this ->plattenBreite = $plattenBreite;
    }
    public function berechnen(): array{
        $x = 0;
        $y = 0;

        $maxBreite = 0;

        
        $positionen = [];

        foreach ($this->teile as $teil){
            if ($x + $teil['laenge'] > $this->plattenLaenge){
                $x = 0;
                $y +=$teil['hoehe'];
            }
            $positionen[] = [
                'id' => $teil['id'],
                'x' => $x,
                'y' => $y,
                'laenge' => $teil['laenge'],
                'hoehe' => $teil['hoehe']
            ];
            $x += $teil['laenge'];
            $aktuellBreite =$x;
            if ($aktuellBreite > $maxBreite){
                $maxBreite = $aktuellBreite;
            }
            
        }
        $maxHoehe = $y + $teil['hoehe'];
        return [
        'positionen' => $positionen,
        'maxHoehe' => $maxHoehe,
        'maxBreite' => $maxBreite
        ];
    }
}