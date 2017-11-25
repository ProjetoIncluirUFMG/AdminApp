<?php

class PreMatriculaController extends Zend_Controller_Action {

    public function init() {
      /* Initialize action controller here */
    }

    public function indexAction() {
        $this->view->title = "Projeto Incluir - Gerenciar Matriculas";

        $form_pre_matricula = new Application_Form_FormConsultaPreMatricula();

        $this->view->form = $form_pre_matricula;

        if ($this->getRequest()->isPost()) {
            $dados = $this->getRequest()->getPost();
            $pagina = 1;
        } else {
            $dados = $this->getRequest()->getParams();
            $pagina = $this->_getParam('pagina');
        }

        if ($form_pre_matricula->isValid($dados)) {
            if ($this->getRequest()->isPost() || !empty($pagina)) {
                $mapper_pre_matriculas = new Application_Model_Mappers_PreMatricula();
                
                $paginator = $mapper_pre_matriculas->buscaPreMatriculas($dados, true);
                $paginator->setItemCountPerPage(10);
                $paginator->setCurrentPageNumber($pagina);

                $this->view->resultado_busca = $paginator;
            }
        }
    }

}
