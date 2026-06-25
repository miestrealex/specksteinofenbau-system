<?php
class schnittplan{
    private array $teile;
    public function __construct(array $teile){
        $this->teile = $teile;
    }
    public function erstellen():array{
        return[];
    }

}
?>