<?php

class PlataformaCadastroController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $usuario = Zend_Auth::getInstance()->getIdentity();
        $this->view->title = "Projeto Incluir - Plataforma de Cadastro";

        $mapper_plataforma_cadastro = new Application_Model_Mappers_ConfiguracaoCadastro();
        $form = new Application_Form_FormPlataformaCadastro();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
          $dados = $this->getRequest()->getPost();

          if (isset($dados['limpar_tabela_pre_matricula'])) {
            $pre_matriculas_mapper = new Application_Model_Mappers_PreMatricula();

            if ($pre_matriculas_mapper->removerPreMatriculas()) {
                $this->view->mensagem = "Pre matriculas deletadas com sucesso!";
                return;
            }
          }


          if (isset($dados['cancelar']))
              $this->_helper->redirector->goToRoute($usuario->getUserIndex(), null, true);

          if ($form->isValid($dados)) {

            $configuracao = new Application_Model_ConfiguracaoCadastro( $form->getValue('texto_inicial'),
            $form->getValue('texto_pagina_fila_espera'),
            $form->getValue('texto_pagina_fila_nivelamento'),
            $form->getValue('texto_pagina_vaga_disponivel'),
            $form->getValue('texto_popup_fila_espera'),
            $form->getValue('texto_popup_fila_nivelamento'),
            $form->getValue('texto_popup_vaga_disponivel'), 
            $form->getValue('somente_veterano'),
            $form->getValue('sistema_ativo'));

            $configuracao_mapper = new Application_Model_Mappers_ConfiguracaoCadastro($configuracao);

            if ($configuracao_mapper->updateConfiguracao($configuracao)) {
                $this->view->mensagem = "Configuração salva com sucesso!";
                return;
            }
          }
        }

        $configuracao_cadastro = $mapper_plataforma_cadastro->buscaConfiguracaoByID(1);

        if ($configuracao_cadastro instanceof Application_Model_ConfiguracaoCadastro) {
            $form->populate($configuracao_cadastro->parseArray());
            return;
        }

    }

}
