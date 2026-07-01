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
            if ($x + $teil->getLaenge() > $this->plattenLaenge){
                $x = 0;
                $y +=$teil->getHoehe();
            }
            $teil->setX($x);
            $teil->setY($y);
            
            $positionen[] = [
                'id' => $teil->getId(),
                'x' => $x,
                'y' => $y,
                'laenge' => $teil->getLaenge(),
                'hoehe' => $teil->getHoehe()
            ];
            $x += $teil->getLaenge();
            $aktuellBreite =$x;
            if ($aktuellBreite > $maxBreite){
                $maxBreite = $aktuellBreite;
            }
            
        }
        $maxHoehe = $y + $teil->getHoehe();
        return [
        'positionen' => $positionen,
        'maxHoehe' => $maxHoehe,
        'maxBreite' => $maxBreite
        ];
    }
}