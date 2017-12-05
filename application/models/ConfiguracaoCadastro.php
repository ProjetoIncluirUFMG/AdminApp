<?php

class Application_Model_ConfiguracaoCadastro {

    private $id;
    private $texto_inicial;
    private $texto_pagina_fila_espera;
    private $texto_pagina_fila_nivelamento;
    private $texto_pagina_vaga_disponivel;
    private $texto_popup_fila_espera;
    private $texto_popup_fila_nivelamento;
    private $texto_popup_vaga_disponivel;
    private $somente_veterano;
    private $sistema_ativo;

    public function __construct($texto_inicial, $texto_pagina_fila_espera, $texto_pagina_fila_nivelamento, $texto_pagina_vaga_disponivel, $texto_popup_fila_espera, $texto_popup_fila_nivelamento, $texto_popup_vaga_disponivel, $somente_veterano, $sistema_ativo) {
        $this->id = 1;
        $this->texto_inicial = $texto_inicial;
        $this->texto_pagina_fila_espera = $texto_pagina_fila_espera;
        $this->texto_pagina_fila_nivelamento = $texto_pagina_fila_nivelamento;
        $this->texto_pagina_vaga_disponivel = $texto_pagina_vaga_disponivel;
        $this->texto_popup_fila_espera = $texto_popup_fila_espera;
        $this->texto_popup_fila_nivelamento = $texto_popup_fila_nivelamento;
        $this->texto_popup_vaga_disponivel = $texto_popup_vaga_disponivel;
        $this->somente_veterano = $somente_veterano;
        $this->sistema_ativo = $sistema_ativo;
    }

    public function getId() {
        return $this->id;
    }

    public function getTextoInicial() {
        return $this->texto_inicial;
    }

    public function getTextoPaginaFilaDeEspera() {
        return $this->texto_pagina_fila_espera;
    }

    public function getTextoPaginaFilaDeNivelamento() {
        return $this->texto_pagina_fila_nivelamento;
    }

    public function getTextoPaginaVagaDisponivel() {
        return $this->texto_pagina_vaga_disponivel;
    }

    public function getTextoPopupFilaDeEspera() {
        return $this->texto_popup_fila_espera;
    }

    public function getTextoPopupFilaDeNivelamento() {
        return $this->texto_popup_fila_nivelamento;
    }

    public function getTextoPopupVagaDisponivel() {
        return $this->texto_popup_vaga_disponivel;
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
            'texto_pagina_fila_espera' => $this->getTextoPaginaFilaDeEspera(),
            'texto_pagina_fila_nivelamento' => $this->getTextoPaginaFilaDeNivelamento(),
            'texto_pagina_vaga_disponivel' => $this->getTextoPaginaVagaDisponivel(),
            'texto_popup_fila_espera' => $this->getTextoPopupFilaDeEspera(),
            'texto_popup_fila_nivelamento' => $this->getTextoPopupFilaDeNivelamento(),
            'texto_popup_vaga_disponivel' => $this->getTextoPopupVagaDisponivel(),
            'somente_veterano' => $this->getSomenteVeteranos()
        );
    }

}
