<?php

class Streifen {
    private float $hoehe;
    private array $teile =[];
    private float $gesamtbreite = 0;
    
    public function getHoehe(): float{
        return $this->hoehe;
    }
    public function getGesamtbreite(): float{
        return$this->gesamtbreite;
    }
    public function getTeile(): array{
        return $this->teile;
    }
    public function getAnzahlTeile(): int{
        return count($this->teile);
    }

    public function __construct(float $hoehe){
        $this->hoehe = $hoehe;
    }
    public function addTeil(array $teil): void {
        $this->teile[] = $teil;
        $this->gesamtbreite += $teil ['laenge'];

    }
}
?>