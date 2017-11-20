<?php

class Application_Model_ConfiguracaoCadastro {

    private $id;
    private $texto_inicial;
    private $somente_veterano;

    public function __construct($texto_inicial, $somente_veterano) {
        $this->id = 1;
        $this->texto_inicial = $texto_inicial;
        $this->somente_veterano = $somente_veterano;
    }

    public function getId() {
        return $this->id;
    }

    public function getTextoInicial() {
        return $this->texto_inicial;
    }

    public function getSomenteVeteranos() {
        return $this->somente_veterano;
    }

    public function parseArray($isView = null) {
        return array(
            'id' => 1,
            'texto_inicial' => $this->getTextoInicial(),
            'somente_veterano' => $this->getSomenteVeteranos()
        );
    }

}
