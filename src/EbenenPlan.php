<?php
class EbenenPlan {
    private array $teile;
    private float $gesamtBreite;
    private float $gesamtLaenge;
    private float $padding = 12;


    public function __construct(array $teile, float $gesamtBreite, float $gesamtLaenge){
        $this->teile = $teile;
        $this->gesamtBreite = $gesamtBreite;
        $this->gesamtLaenge = $gesamtLaenge;
    }
    public function gruppierNachEbene(): array {
        $ebenen =[];
        foreach ($this->teile as $teil){
            $id = $teil->getId();
            $teileId = explode (' ', $id);
            $ebene = $teileId[0];
            $ebenen [$ebene][] = $teil;
        }
        return $ebenen;

    }
    public function render(float $steinstaerke):string{
        $ebenen = $this ->gruppierNachEbene();
        $html = "";
        foreach ($ebenen as $ebene =>$teile){
            $this->positionereWaende($teile, $steinstaerke, $this->gesamtBreite, $this->gesamtLaenge, $ebene);
            $html .= "<h2>Ebene {$ebene}</h2>";
            $margin = 50;
            $svgWidth = $this->gesamtBreite * 4 + $margin * 2;
            $svgHeight = $this->gesamtLaenge * 4 + $margin * 2;
            $html .= "<svg class='ebenenplan-svg' width ='{$svgWidth}' height='{$svgHeight}'  margin-bottom:20px;'>";
            $html .= $this->renderMasse($steinstaerke);
           
            foreach ($teile as $teil) {

                $html .= $teil->renderSvg($steinstaerke);
            }
            $html .="</svg>";
        }
        return $html;

    }
    public function positionereWaende(array &$teile, float $steinstaerke, float $gesamtBreite, $gesamtLaenge, string $ebene): void {
        $ebeneNummer = ['I'=>1, 'II'=> 2, "III"=>3, 'IV'=>4, 'V'=>5];
        $ebene = $ebeneNummer[$ebene];
        $padding = $this->padding;

        foreach ($teile as $teil){
            $seiteId = explode(" ", $teil->getId());

            if (count($seiteId) < 2){
                continue;
            }
            $seite = $seiteId[1];
            switch ($seite){
                case 'V': 
                    if ($ebene % 2 == 0){
                        $teil ->setX($padding);
                        $teil ->setY($padding);
                    } else{
                        $teil ->setX($steinstaerke + $padding);
                        $teil ->setY($padding);
                    }
                break;
                case 'H': 
                    if ($ebene % 2 == 0){
                        $teil ->setX($steinstaerke + $padding);
                        $teil ->setY($gesamtLaenge - $steinstaerke + $padding);
                    }else{
                        $teil ->setX($padding);
                        $teil ->setY($gesamtLaenge - $steinstaerke + $padding);
                    }
                    break;
                case 'L':
                    if($ebene % 2 == 0){ 
                        $teil ->setX($padding);
                        $teil ->setY($steinstaerke + $padding);
                    }else{
                        $teil ->setX($padding);
                        $teil ->setY($padding);
                    } 

                    break;
                case 'R': 
                    if ($ebene % 2 == 0){
                        $teil ->setX($gesamtBreite - $steinstaerke + $padding);
                        $teil ->setY($padding);
                    }else{
                        $teil ->setX($gesamtBreite - $steinstaerke + $padding);
                        $teil ->setY($steinstaerke + $padding);
                    }
                    break;
            }
        }

    }
    private function renderMasse(float $steinstaerke): string {
    $scale = 10;
    $pixelProcm = 40;

    $padding = $this->padding;

    $breite = $this->gesamtBreite / $scale * $pixelProcm;
    $hoehe = $this->gesamtLaenge / $scale * $pixelProcm;

    $x = $padding / $scale * $pixelProcm;
    $y = $padding / $scale * $pixelProcm;

    return

    "<line
        x1='{$x}'
        y1='" . ($y - 15) . "'
        x2='" . ($x + $breite) . "'
        y2='" . ($y - 15) . "'
        stroke='red'
        stroke-width='2'/>"

    . "<text
        x='" . ($x + $breite / 2) . "'
        y='" . ($y - 25) . "'
        class='ebene-mass'>
        {$this->gesamtBreite} cm
      </text>"

    . "<line
        x1='" . ($x - 15) . "'
        y1='{$y}'
        x2='" . ($x - 15) . "'
        y2='" . ($y + $hoehe) . "'
        stroke='red'
        stroke-width='2'/>"

    . "<text
        x='" . ($x - 25) . "'
        y='" . ($y + $hoehe / 2) . "'
        transform='rotate(-90 " . ($x - 25) . " " . ($y + $hoehe / 2) . ")'
        class='ebene-mass'>
        {$this->gesamtLaenge} cm
      </text>";
    }
}