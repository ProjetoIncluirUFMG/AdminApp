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
    private $aluno_cpf;

    /**
     * @var String
     */
    private $nome_curso;

    /**
     * @var int
     */
    private $id_curso;

    /**
     * @var String
     */
    private $nome_disciplina;

    /**
     * @var int
     */
    private $id_disciplina;

    /**
     * @var String
     */
    private $nome_turma;

    /**
     * @var int
     */
    private $id_turma;

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
    private $fila_nivelamento;

    /**
     * @var int
     */
    private $fila_espera;

    /**
     * @var String
     */
    private $nome_aluno;

    /**
     * @var int
     */
    private $id_aluno;

    public function __construct($numero_comprovante = null, $aluno_cpf = null, $nome_curso = null, $id_curso = null, $nome_disciplina = null, $id_disciplina = null, $nome_turma = null, $id_turma = null, $veterano = null, $vaga_garantida = null, $fila_nivelamento = null, $fila_espera = null, $nome_aluno = null, $id_aluno = null) {

        $this->numero_comprovante = $numero_comprovante;
        $this->aluno_cpf = $aluno_cpf;
        $this->nome_curso = $nome_curso;
        $this->id_curso = $id_curso;
        $this->nome_disciplina = $nome_disciplina;
        $this->id_disciplina = $id_disciplina;
        $this->nome_turma = $nome_turma;
        $this->id_turma = $id_turma;
        $this->veterano = (int) $veterano;
        $this->vaga_garantida = (int) $vaga_garantida;
        $this->fila_nivelamento = (int) $fila_nivelamento;
        $this->fila_espera = (int) $fila_espera;
        $this->nome_aluno = $nome_aluno;
        $this->id_aluno = $id_aluno;

    }

    public function getNumeroComprovante() {
        return $this->numero_comprovante;
    }

    public function getAlunoCPF() {
        return $this->aluno_cpf;
    }

    public function getNomeCurso() {
        return $this->nome_curso;
    }

    public function getIdCurso() {
        return $this->id_curso;
    }

    public function getNomeDisciplina() {
        return $this->nome_disciplina;
    }

    public function getIdDisciplina() {
        return $this->id_disciplina;
    }

    public function getNomeTurma() {
        return $this->nome_turma;
    }

    public function getIdTurma() {
        return $this->id_turma;
    }

    public function getVeterano() {
        return $this->veterano;
    }

    public function getVagaGarantida() {
        return $this->vaga_garantida;
    }

    public function getFilaNivelamento() {
        return $this->fila_nivelamento;
    }

    public function getFilaEspera() {
        return $this->fila_espera;
    }

    public function getNomeAluno() {
        return $this->nome_aluno;
    }

    public function getIdAluno() {
        return $this->id_aluno;
    }

    /**
     * Retorna um array com as informações da pre-matricula.
     * Utilizado para popular a tabela de pre-matricula
     * @return array
     */
    public function parseArray() {
        return array(
            'numero_comprovante' => $this->numero_comprovante,
            'aluno_cpf' => $this->aluno_cpf,
            'nome_curso' => $this->nome_curso,
            'id_curso' => $this->id_curso,
            'nome_disciplina' => $this->nome_disciplina,
            'id_disciplina' => $this->id_disciplina,
            'nome_turma' => $this->nome_turma,
            'id_turma' => $this->id_turma,
            'veterano' => $this->veterano,
            'vaga_garantida' => $this->vaga_garantida,
            'fila_nivelamento' => $this->fila_nivelamento,
            'fila_espera' => $this->fila_espera,
            'nome_aluno' => $this->nome_aluno,
            'id_aluno' => $this->id_aluno
        );
    }

}
