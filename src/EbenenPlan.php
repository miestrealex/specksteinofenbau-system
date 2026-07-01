<?php
class EbenenPlan {
    private array $teile;
    private float $gesamtBreite;
    private float $gesamtLaenge;

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
            $this->positionereWaende($teile, $steinstaerke, $this->gesamtBreite, $this->gesamtLaenge);
            $html .= "<h2>Ebene {$ebene}</h2>";
            $html .= "<svg width ='800' height='400' style='border:1px solid black; margin-bottom:20px;'>";

            foreach ($teile as $teil) {
                $html .= $teil->renderSvg($steinstaerke);
            }
            $html .="</svg>";
        }
        return $html;

    }
    public function positionereWaende(array &$teile, float $steinstarke, float $gesamtBreite, $gesamtLaenge): void {
        foreach ($teile as $teil){
            $seiteId = explode(" ", $teil->getId());

            if (count($seiteId) < 2){
                continue;
            }
            $seite = $seiteId[1];
            switch ($seite){
                case 'V': 
                    $teil ->setX(0);
                    $teil ->setY(0);
                    break;
                case 'H': 
                    $teil ->setX($steinstarke);
                    $teil ->setY($gesamtLaenge - $steinstarke );
                    break;
                case 'L': 
                    $teil ->setX(0);
                    $teil ->setY($steinstarke);
                    break;
                case 'R': 
                    $teil ->setX($gesamtBreite - $steinstarke);
                    $teil ->setY(0);
                    break;
            }
        }

    }
}