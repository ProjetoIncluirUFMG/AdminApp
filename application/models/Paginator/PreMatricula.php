<?php

/**
 * Paginação -> converte array do BD em objetos da pre-matricula e faz controle de paginação
 *
 * @author Daniel Marchena Parreira
 */
class Application_Model_Paginator_PreMatricula extends Zend_Paginator_Adapter_DbSelect {

    public function getItems($offset, $itemCountPerPage) {
        $pre_matriculas = parent::getItems($offset, $itemCountPerPage);
        $array_pre_matriculas = array();

        foreach ($pre_matriculas as $pre_matricula)
            $array_pre_matriculas[] = new Application_Model_PreMatricula($pre_matricula['numero_comprovante'], $pre_matricula['turma'], $pre_matricula['id_aluno'], $pre_matricula['cpf_aluno'], $pre_matricula['nome_aluno'], $pre_matricula['id_disciplina'], $pre_matricula['nome_disciplina'], $pre_matricula['veterano'], $pre_matricula['vaga_garantida'], $pre_matricula['fila_de_nivelamento'], $pre_matricula['fila_de_espera'], $pre_matricula['status']);

        return $array_pre_matriculas;
    }

}
