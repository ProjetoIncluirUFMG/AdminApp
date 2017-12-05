<?php

/**
 * Classe para representar uma pre-matricula do projeto
 * @author Projeto Incluir
 */
class Application_Model_PreMatricula {

    /**
     * @var int
     */
    private $numero_comprovante;

    /**
     * @var String
     */
    private $turma;

    /**
     * @var int
     */
    private $id_aluno;

    /**
     * @var String
     */
    private $cpf_aluno;

    /**
     * @var String
     */
    private $nome_aluno;

    /**
     * @var int
     */
    private $id_disciplina;

    /**
     * @var String
     */
    private $nome_disciplina;

    /**
     * @var int
     */
    private $veterano;

    /**
     * @var int
     */
    private $vaga_garantida;

    /**
     * @var int
     */
    private $fila_de_nivelamento;

    /**
     * @var int
     */
    private $fila_de_espera;

    /**
     * @var String
     */
    private $status;


    public function __construct($numero_comprovante = null, $turma = null, $id_aluno = null, $cpf_aluno = null, $nome_aluno = null, $id_disciplina = null, $nome_disciplina = null, $veterano = null, $vaga_garantida = null, $fila_de_nivelamento = null, $fila_de_espera = null, $status = null) {
        $this->numero_comprovante = $numero_comprovante;
        $this->turma = $turma;
        $this->id_aluno = $id_aluno;
        $this->cpf_aluno = $cpf_aluno;
        $this->nome_aluno = $nome_aluno;
        $this->id_disciplina = $id_disciplina;
        $this->nome_disciplina = $nome_disciplina;
        $this->veterano = $veterano;
        $this->vaga_garantida = $vaga_garantida;
        $this->fila_de_nivelamento = $fila_de_nivelamento;
        $this->fila_de_espera = $fila_de_espera;
        $this->status = $status;
    }

    public function getNumeroComprovante() {
        return $this->numero_comprovante;
    }

    public function getTurma() {
        return $this->turma;
    }

    public function getIdAluno() {
        return $this->id_aluno;
    }

    public function getNomeAluno() {
        return $this->nome_aluno;
    }

    public function getCPFAluno() {
        return $this->cpf_aluno;
    }

    public function getIdDisciplina() {
        return $this->id_disciplina;
    }

    public function getNomeDisciplina() {
        return $this->nome_disciplina;
    }

    public function getVeterano() {
        return $this->veterano;
    }

    public function getVagaGarantida() {
        return $this->vaga_garantida;
    }

    public function getFilaDeNivelamento() {
        return $this->fila_de_nivelamento;
    }

    public function getFilaDeEspera() {
        return $this->fila_de_espera;
    }

    public function getStatus() {
        return $this->status;
    }

    /**
     * Retorna um array com as informações da pre-matricula.
     * Utilizado para popular a tabela de pre-matricula
     * @return array
     */
    public function parseArray() {
        return array(
            'numero_comprovante' => $this->numero_comprovante,
            'turma' => $this->turma,
            'id_aluno' => $this->id_aluno,
            'cpf_aluno' => $this->cpf_aluno,
            'nome_aluno' => $this->nome_aluno,
            'id_disciplina' => $this->id_disciplina,
            'nome_disciplina' => $this->nome_disciplina,
            'veterano' => $this->veterano,
            'vaga_garantida' => $this->vaga_garantida,
            'fila_de_nivelamento' => $this->fila_de_nivelamento,
            'fila_de_espera' => $this->fila_de_espera,
            'status' => $this->status,
        );
    }

}
