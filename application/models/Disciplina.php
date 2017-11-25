<?php

/**
 * Classe para representar uma disciplina do projeto
 * @author Projeto Incluir
 */
class Application_Model_Disciplina {
    const status_ativo = 1;
    const status_inativo = 2;

    /**
     * @var int
     */
    private $id_disciplina;

    /**
     * @var String
     */
    private $nome_disciplina;

    /**
     * @var String
     */
    private $ementa_disciplina;

    /**
     * @var int
     */
    private $vagas_do_curso;

    /**
     * @var int
     */
    private $fila_de_nivelamento;

    /**
     * @var int
     */
    private $fila_de_espera;

    /**
     * @var int
     */
    private $idade_minima;

    /**
     * @var int
     */
    private $total_vagas_do_curso;

    /**
     * @var int
     */
    private $total_fila_de_nivelamento;

    /**
     * @var int
     */
    private $total_fila_de_espera;

    /**
     * @var Application_Model_Curso
     */
    private $curso;

    /**
     * @var Application_Model_Disciplina[]
     */
    private $pre_requisitos;

    /**
     *
     * @var int
     */
    private $status;

    public function __construct($id_disciplina, $nome_disciplina = null, $ementa_disciplina = null, $curso = null, $pre_requisito = null, $status = null, $vagas_do_curso = null, $fila_de_nivelamento = null, $fila_de_espera = null, $idade_minima = null,
    $total_vagas_do_curso = null, $total_fila_de_nivelamento = null,
    $total_fila_de_espera = null) {
        $this->id_disciplina = ((!empty($id_disciplina)) ? (int) $id_disciplina : null);
        $this->nome_disciplina = $nome_disciplina;
        $this->ementa_disciplina = $ementa_disciplina;
        $this->vagas_do_curso = $vagas_do_curso;
        $this->fila_de_nivelamento = $fila_de_nivelamento;
        $this->fila_de_espera = $fila_de_espera;
        $this->idade_minima = $idade_minima;
        $this->total_vagas_do_curso = $total_vagas_do_curso;
        $this->total_fila_de_nivelamento = $total_fila_de_nivelamento;
        $this->total_fila_de_espera = $total_fila_de_espera;
        $this->curso = $curso;
        $this->pre_requisitos = array();
        $this->addPreRequisitos($pre_requisito);
        $this->status = (int)$status;
    }

    /**
     * Retorna o id da disciplina
     * @param boolean $isView Indica se o id será criptografado ou não
     * @return int|string
     */
    public function getIdDisciplina($isView = null) {
        if (!empty($isView))
            return base64_encode($this->id_disciplina);
        return $this->id_disciplina;
    }

    public function getNomeDisciplina() {
        return $this->nome_disciplina;
    }

    public function getEmentaDisciplina() {
        return $this->ementa_disciplina;
    }

    /**
     * Retorna o curso ao qual a disciplina pertence
     * @return Application_Model_Curso
     */
    public function getCurso() {
        return $this->curso;
    }

    /**
     * Inclui o pré requisito especificado por parâmetro para a disciplina.
     * @param Application_Model_Disciplina $disciplina
     */
    public function addPreRequisitos($disciplina) {
        if ($disciplina instanceof Application_Model_Disciplina)
            $this->pre_requisitos[] = $disciplina;

        else if (is_array($disciplina) && !empty($disciplina)) {
            foreach ($disciplina as $aux) {
                if ($aux instanceof Application_Model_Disciplina)
                    $this->pre_requisitos[] = $aux;
            }
        }
    }

    /**
     * Retorna os pré requisitos da disciplina
     * @return Application_Model_Disciplina
     */
    public function getPreRequisitos() {
        return $this->pre_requisitos;
    }

    public function hasPreRequisitos() {
        if (count($this->pre_requisitos) > 0)
            return true;
        return false;
    }

    public function getStatus(){
        return $this->status;
    }

    /**
     * Retorna um array com as informações da disciplina.
     * Utilizado tanto para popular formulários de disciplina quanto para cadastro/alteração no banco de dados
     * @param boolean $isView Indica qual será o formato de alguns dos dados (id, data...)
     * @return array
     */
    public function parseArray($isView = null) {
        return array(
            'id_disciplina' => $this->getIdDisciplina($isView),
            'nome_disciplina' => $this->nome_disciplina,
            'ementa_disciplina' => $this->ementa_disciplina,
            'id_curso' => $this->curso->getIdCurso(),
            'vagas_do_curso' => $this->vagas_do_curso,
            'fila_de_nivelamento' => $this->fila_de_nivelamento,
            'fila_de_espera' => $this->fila_de_espera,
            'total_vagas_do_curso' => $this->total_vagas_do_curso,
            'total_fila_de_nivelamento' => $this->total_fila_de_nivelamento,
            'total_fila_de_espera' => $this->total_fila_de_espera,
            'idade_minima' => $this->idade_minima,
            'status' => $this->status
        );
    }

}
