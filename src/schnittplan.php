<?php
require_once 'streifen.php';
class Schnittplan{
    private array $teile;
    public function __construct(array $teile){
        $this->teile = $teile;
    }
    public function gruppierenNachHoehe():array{
        $gruppen = [];
        foreach ($this->teile as $teil){
            
            $hoehe = $teil['hoehe'];
            if (!isset($gruppen [$hoehe])){
                $gruppen[$hoehe] = new Streifen($hoehe);
            }
            $gruppen[$hoehe]->addTeil($teil);
        }
        krsort($gruppen);
        return $gruppen;

    }

}
?>