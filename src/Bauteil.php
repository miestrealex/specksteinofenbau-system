<?php

   

class Bauteil{
    private string $id;
    private float $laenge;
    private float $hoehe;
    private float $x = 0;
    private float $y = 0;
    private bool $horizontal = true;
    
    private float $scale = 10;
    private float $pixelProcm = 40;

    public function __construct(string $id, float $laenge, float $hoehe){
        $this->id = $id;
        $this->laenge = $laenge;
        $this->hoehe = $hoehe;

    }
    public function getId(): string {
        return $this->id;
        
    }
    public function getLaenge(): float {
        return $this->laenge;
        
    }
    public function getHoehe(): float {
        return $this->hoehe;
        
    }
    public function setHorizontal(bool $horizontal){
        $this->horizontal = $horizontal;
    }
    public function setX(float $x): void{
        $this->x = $x;
    }
    public function setY(float $y): void{
        $this->y = $y;
    }
    public function getX(): float{
        return $this->x;
    }
    public function getY(): float{
        return $this->y;
    }
    public function isHorizontal() : bool {
        return $this->horizontal;
    }
    public function renderSvg(float $steinstaerke): string{
        
        if ($this->horizontal){
            $width = $this->laenge / $this->scale * $this->pixelProcm;
            $height = $steinstaerke / $this->scale * $this->pixelProcm;
        }else {
            $width = $steinstaerke / $this->scale * $this->pixelProcm;
            $height = $this->laenge / $this->scale * $this->pixelProcm;
        }

        $x = $this->x / $this->scale * $this->pixelProcm;
        $y = $this->y / $this->scale * $this->pixelProcm;

        $cx = $x + $width / 2;  
        $cy = $y + $height / 2;

        $rotation = "";

        if (!$this->horizontal) {
            $rotation = " transform='rotate(-90 {$cx} {$cy})'";
        }

    return
        "<rect x='{$x}' y='{$y}' width='{$width}' height='{$height}' fill='#bab6b6' stroke='#3e3a3a' stroke-width='3'/>"
        . "<text x='{$cx}' y='" . ($cy - 6) . "' class='ebene-id'{$rotation}>
            {$this->id}
        </text>"

        . "<text x='{$cx}' y='" . ($cy + 6) . "' class='ebene-mass'{$rotation}>
            {$this->laenge} × {$this->hoehe} cm
        </text>";
        
    }

        
}

?>