<?php

/**
 * Classe para gerenciar as configurações do sistema de cadastro
 * @author Daniel Marchena Parreira
 */
class Application_Model_Mappers_ConfiguracaoCadastro {

    /**
     * @var Application_Model_DbTable_Curso
     */
    private $db_curso;

    /**
     * Buscar a configuração da plataforma de cadastro no BD
     * @param int $id
     * @return boolean
     */
    public function buscaConfiguracaoByID($id) {
      try {
        $this->db_configuracao_cadastro = new Application_Model_DbTable_ConfiguracaoCadastro();

        $select = $this->db_configuracao_cadastro->select()
                ->where('id = ?', $id);

        $configuracao_cadastro = $this->db_configuracao_cadastro->fetchRow($select);

        if (!empty($configuracao_cadastro))
            return new Application_Model_ConfiguracaoCadastro( $configuracao_cadastro->texto_inicial,
            $configuracao_cadastro->texto_pagina_fila_espera,
            $configuracao_cadastro->texto_pagina_fila_nivelamento,
            $configuracao_cadastro->texto_pagina_vaga_disponivel,
            $configuracao_cadastro->texto_popup_fila_espera,
            $configuracao_cadastro->texto_popup_fila_nivelamento,
            $configuracao_cadastro->texto_popup_vaga_disponivel, $configuracao_cadastro->somente_veterano,
            $configuracao_cadastro->sistema_ativo);

        return null;

      } catch (Zend_Exception $e) {
          echo $e->getMessage();
          return false;
      }
    }

    /**
     * Adiciona uma configuraçao para o sistema de cadastro no BD
     * @param Application_Model_ConfiguracaoCadastro $configuracao_cadastro
     * @return boolean
     */
    public function updateConfiguracao($configuracao_cadastro) {
        try {
            if ($configuracao_cadastro instanceof Application_Model_ConfiguracaoCadastro) {

              $this->db_configuracao_cadastro = new Application_Model_DbTable_ConfiguracaoCadastro();

              $where = $this->db_configuracao_cadastro->getAdapter()->quoteInto('id = ?', $configuracao_cadastro->getId());

              $this->db_configuracao_cadastro->update($configuracao_cadastro->parseArray(), $where);
              return true;
            }
            return false;
        } catch (Zend_Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
