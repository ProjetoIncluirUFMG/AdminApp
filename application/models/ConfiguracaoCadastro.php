<?php

class Application_Model_ConfiguracaoCadastro {

    private $id;
    private $texto_inicial;
    private $somente_veterano;
    private $sistema_ativo;

    public function __construct($texto_inicial, $somente_veterano, $sistema_ativo) {
        $this->id = 1;
        $this->texto_inicial = $texto_inicial;
        $this->somente_veterano = $somente_veterano;
        $this->sistema_ativo = $sistema_ativo;
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

    public function getSistemaAtivo() {
        return $this->sistema_ativo;
    }

    public function parseArray() {
        return array(
            'id' => 1,
            'sistema_ativo' => $this->getSistemaAtivo(),
            'texto_inicial' => $this->getTextoInicial(),
            'somente_veterano' => $this->getSomenteVeteranos()
        );
    }

}
