<?php

/**
 * Classe para gerenciar as pre-matriculas do projeto no banco de dados
 * @author Daniel Marchena Parreira
 */
class Application_Model_Mappers_PreMatricula {

    /**
     * @var Application_Model_DbTable_PreMatricula
     */
    private $db_curso;

    /**
     * Remover todas pre-matriculas
     * @return boolean
     */
    public function removerPreMatriculas() {

      try {

        $this->db_pre_matricula = new Application_Model_DbTable_PreMatricula();
        $where = $this->db_pre_matricula->getAdapter()->quoteInto('status = ?', 'Ativo');

        $this->db_pre_matricula->update(array('status' => 'Deletado', 'data_modificado' => date("Y-m-d h:i:s")), $where);

        return true;

      } catch (Zend_Exception $e) {
          echo $e->getMessage();
          return null;
      }

    }

    /**
     * Busca as pre-matriculas de acordo com os filtros especificados
     * @param array $filtros_busca
     * @param boolean $paginator
     * @return \Application_Model_PreMatricula|null|\Zend_Paginator
     */
    public function buscaPreMatriculas($filtros_busca = null, $paginator = null) {
        try {
            $this->db_pre_matricula = new Application_Model_DbTable_PreMatricula();
            $select = $this->db_pre_matricula->select()
                    ->from('pre_matricula', array('numero_comprovante', 'aluno_cpf', 'nome_curso', 'id_curso', 'nome_disciplina', 'id_disciplina', 'nome_turma', 'id_turma', 'veterano', 'vaga_garantida', 'fila_nivelamento', 'fila_espera', 'nome_aluno', 'id_aluno'))
                    ->order('numero_comprovante ASC');

            $select->where('status = ?', 'Ativo');

            if (!empty($filtros_busca['nome_aluno']))
                $select->where('nome_aluno LIKE ?', '%' . $filtros_busca['nome_aluno'] . '%');

            if (!empty($filtros_busca['numero_comprovante']))
                $select->where('numero_comprovante = ?', $filtros_busca['numero_comprovante']);

            if (empty($paginator)) {
                $pre_matriculas = $this->db_pre_matricula->fetchAll($select);

                if (!empty($pre_matriculas)) {
                    $array_pre_matriculas = array();

                    foreach ($pre_matriculas as $pre_matricula)
                        $array_pre_matriculas[] = new Application_Model_PreMatricula($pre_matricula->numero_comprovante, $pre_matricula->aluno_cpf, $pre_matricula->nome_curso, $pre_matricula->id_curso, $pre_matricula->nome_disciplina, $pre_matricula->id_disciplina, $pre_matricula->nome_turma, $pre_matricula->id_turma, $pre_matricula->veterano, $pre_matricula->vaga_garantida, $pre_matricula->fila_nivelamento, $pre_matricula->fila_espera, $pre_matricula->nome_aluno, $pre_matricula->id_aluno);

                    return $array_pre_matriculas;
                }
                return null;
            }
            return new Zend_Paginator(new Application_Model_Paginator_PreMatricula($select->order('numero_comprovante')));
        } catch (Zend_Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

}
