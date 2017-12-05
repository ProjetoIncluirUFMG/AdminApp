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

        // Mudar status tabela de pre-matricula
        $this->db_pre_matricula = new Application_Model_DbTable_PreMatricula();
        $where = $this->db_pre_matricula->getAdapter()->quoteInto('status = ?', 'Ativo');
        $this->db_pre_matricula->update(array('status' => 'Deletado', 'data_modificado' => date("Y-m-d h:i:s")), $where);

        // Atualizar contadores das disciplinas
        $this->db_disciplina = new Application_Model_DbTable_Disciplina();
        $where = $this->db_disciplina->getAdapter()->quoteInto('id_disciplina != ?', '');
        $this->db_disciplina->update(array('vagas_do_curso' => 0, 'fila_de_nivelamento' => 0, 'fila_de_espera' => 0, 'total_vagas_do_curso' => 0, 'total_fila_de_nivelamento' => 0, 'total_fila_de_espera' => 0), $where);

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
                    ->from('pre_matricula', array('numero_comprovante', 'turma', 'id_aluno', 'cpf_aluno', 'nome_aluno', 'id_disciplina', 'nome_disciplina', 'veterano', 'vaga_garantida', 'fila_de_nivelamento', 'fila_de_espera', 'status'))
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
                        $array_pre_matriculas[] = new Application_Model_PreMatricula($pre_matricula->numero_comprovante, $pre_matricula->turma, $pre_matricula->id_aluno, $pre_matricula->cpf_aluno, $pre_matricula->nome_aluno, $pre_matricula->id_disciplina, $pre_matricula->nome_disciplina, $pre_matricula->veterano, $pre_matricula->vaga_garantida, $pre_matricula->fila_de_nivelamento, $pre_matricula->fila_de_espera, $pre_matricula->status);

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
