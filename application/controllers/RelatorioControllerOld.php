<?php

class RelatorioController extends Zend_Controller_Action
{

    public function init()
    {
        ob_start();
        ob_clean();
    }

    public function relatorioAlunosTurmaAction()
    {
        @ini_set('memory_limit', '512M');

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $mapper_turma = new Application_Model_Mappers_Aluno();

        $excel = new Aplicacao_Relatorio_Excel();
        if (base64_decode($this->getParam('unico_sheet')) == 'nao')
            $resultado = $excel->writeAlunos($mapper_turma->getAlunosOrganizadosByTurma(unserialize(base64_decode($this->getParam('turmas'))), false, (int) base64_decode($this->getParam('periodo'))), base64_decode($this->getParam('formato')));
        else
            $resultado = $excel->writeAlunosUnicoSheet($mapper_turma->getAlunosTurmaUnicoArray(unserialize(base64_decode($this->getParam('turmas'))), false, (int) base64_decode($this->getParam('periodo'))), base64_decode($this->getParam('formato')));

        if (is_null($resultado))
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'As salas escolhidas não possuem nenhum aluno cadastrado'), null, true);

        if ($resultado === false)
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'Houve erro ao gerar o relatório, consulte o administrador do sistema'), null, true);
    }

    public function opcoesRelatorioAlunosTurmaAction()
    {
        $usuario = Zend_Auth::getInstance()->getIdentity();
        $periodo = new Application_Model_Mappers_Periodo();

        $this->view->title = "Projeto Incluir - Relatório Alunos por Turma";

        $form_opcoes_relatorio = new Application_Form_RelatorioAlunosTurma();
        $form_opcoes_relatorio->initializePeriodo($periodo->getPeriodos(), $periodo->getPeriodoAtual());

        if ($this->_request->isPost()) {
            $dados = $this->_request->getPost();
            $form_opcoes_relatorio->controleTurmas($dados);

            if (isset($dados['cancelar']))
                $this->_helper->redirector->goToRoute($usuario->getUserIndex(), null, true);

            if ($form_opcoes_relatorio->isValid($dados))
                $this->_helper->redirector->goToRoute(array('controller' => 'relatorio', 'action' => 'relatorio-alunos-turma', 'turmas' => base64_encode(serialize($form_opcoes_relatorio->getValue('turmas'))), 'formato' => $form_opcoes_relatorio->getValue('formato_saida'), 'periodo' => $form_opcoes_relatorio->getValue('periodo'), 'unico_sheet' => $form_opcoes_relatorio->getValue('unico_sheet')), null, true);
        }

        $this->view->form = $form_opcoes_relatorio;
    }

    public function opcoesListaPresencaAction()
    {
        $usuario = Zend_Auth::getInstance()->getIdentity();
        $periodo = new Application_Model_Mappers_Periodo();
        $form_opcoes_relatorio = new Application_Form_RelatorioListaPresenca();

        $this->view->title = "Projeto Incluir - Emissão de Lista de Presença";

        $form_opcoes_relatorio->initializePeriodo($periodo->getPeriodos(), $periodo->getPeriodoAtual());

        if ($this->_request->isPost()) {
            $dados = $this->_request->getPost();
            $form_opcoes_relatorio->controleTurmas($dados);

            if (isset($dados['cancelar']))
                $this->_helper->redirector->goToRoute($usuario->getUserIndex(), null, true);

            if ($form_opcoes_relatorio->isValid($dados))
                $this->_helper->redirector->goToRoute(array('controller' => 'relatorio', 'action' => 'lista-presenca', 'turmas' => base64_encode(serialize($form_opcoes_relatorio->getValue('turmas'))), 'formato' => $form_opcoes_relatorio->getValue('formato_saida'), 'periodo' => $form_opcoes_relatorio->getValue('periodo'), 'data' => base64_encode($form_opcoes_relatorio->getValue('data'))), null, true);
        }

        $this->view->form = $form_opcoes_relatorio;
    }

    public function listaPresencaAction()
    {
        @ini_set('memory_limit', '512M');

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $mapper_turma = new Application_Model_Mappers_Aluno();

        $excel = new Aplicacao_Relatorio_Excel();
        $resultado = $excel->getListaPresenca($mapper_turma->getAlunosOrganizadosByTurma(unserialize(base64_decode($this->getParam('turmas'))), false, (int) base64_decode($this->getParam('periodo'))), base64_decode($this->getParam('formato')), base64_decode($this->getParam('data')));

        if (is_null($resultado))
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'As salas escolhidas não possuem nenhum aluno cadastrado'), null, true);

        if ($resultado === false)
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'Houve erro ao gerar o relatório, consulte o administrador do sistema'), null, true);
    }

    public function relatorioFrequenciaAlunoAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $mapper_turma = new Application_Model_Mappers_Aluno();
        $mapper_calendario = new Application_Model_Mappers_DatasAtividade();

        $excel = new Aplicacao_Relatorio_Excel();
        $resultado = $excel->getRelatorioFrequenciaAluno($mapper_turma->getAlunosOrganizadosByTurma(unserialize(base64_decode($this->getParam('turmas'))), false, (int) base64_decode($this->getParam('periodo')), true), base64_decode($this->getParam('formato')), $mapper_calendario->getDatasByPeriodo(new Application_Model_Periodo((int) base64_decode($this->getParam('periodo')))));

        if (is_null($resultado))
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'As salas escolhidas não possuem nenhum aluno cadastrado'), null, true);

        if ($resultado === false)
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'Houve erro ao gerar o relatório, consulte o administrador do sistema'), null, true);
    }

    public function opcoesRelatorioFrequenciaAlunoAction()
    {
        $usuario = Zend_Auth::getInstance()->getIdentity();

        $this->view->title = "Projeto Incluir - Relatório de Frequência de Alunos";
        $form_opcoes_relatorio = new Application_Form_RelatorioFrequenciaAlunos();

        $periodo = new Application_Model_Mappers_Periodo();
        $form_opcoes_relatorio->initializePeriodo($periodo->getPeriodos(), $periodo->getPeriodoAtual());

        if ($this->_request->isPost()) {
            $dados = $this->_request->getPost();
            $form_opcoes_relatorio->controleTurmas($dados);

            if (isset($dados['cancelar']))
                $this->_helper->redirector->goToRoute($usuario->getUserIndex(), null, true);

            if ($form_opcoes_relatorio->isValid($dados))
                $this->_helper->redirector->goToRoute(array('controller' => 'relatorio', 'action' => 'relatorio-frequencia-aluno', 'turmas' => base64_encode(serialize($form_opcoes_relatorio->getValue('turmas'))), 'formato' => $form_opcoes_relatorio->getValue('formato_saida'), 'periodo' => $form_opcoes_relatorio->getValue('periodo')), null, true);
        }

        $this->view->form = $form_opcoes_relatorio;
    }

    public function opcoesRelatorioNotasAlunoTurmaAction()
    {
        $usuario = Zend_Auth::getInstance()->getIdentity();

        $this->view->title = "Projeto Incluir - Relatório de Notas/Frequências de Alunos";
        $form_opcoes_relatorio = new Application_Form_RelatorioNotaAlunos();

        $periodo = new Application_Model_Mappers_Periodo();
        $form_opcoes_relatorio->initializePeriodo($periodo->getPeriodos(), $periodo->getPeriodoAtual());

        if ($this->_request->isPost()) {
            $dados = $this->_request->getPost();
            $form_opcoes_relatorio->controleTurmas($dados);

            if (isset($dados['cancelar']))
                $this->_helper->redirector->goToRoute($usuario->getUserIndex(), null, true);

            if ($form_opcoes_relatorio->isValid($dados))
                $this->_helper->redirector->goToRoute(array('controller' => 'relatorio', 'action' => 'relatorio-notas-aluno-turma', 'turmas' => base64_encode(serialize($form_opcoes_relatorio->getValue('turmas'))), 'formato' => $form_opcoes_relatorio->getValue('formato_saida'), 'periodo' => $form_opcoes_relatorio->getValue('periodo')), null, true);
        }

        $this->view->form = $form_opcoes_relatorio;
    }

    public function relatorioNotasAlunoTurmaAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $mapper_turma = new Application_Model_Mappers_Aluno();

        $excel = new Aplicacao_Relatorio_Excel();
        $resultado = $excel->getRelatorioNotasAluno($mapper_turma->getAlunosTurmaUnicoArray(unserialize(base64_decode($this->getParam('turmas'))), false, (int) base64_decode($this->getParam('periodo'))), base64_decode($this->getParam('formato')));

        if (is_null($resultado))
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'As salas escolhidas não possuem nenhum aluno cadastrado'), null, true);

        if ($resultado === false)
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'Houve erro ao gerar o relatório, consulte o administrador do sistema'), null, true);
    }

    public function relatorioDiarioClasseAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $mapper_turma = new Application_Model_Mappers_Aluno();
        $mapper_calendario = new Application_Model_Mappers_DatasAtividade();

        $excel = new Aplicacao_Relatorio_Excel();
        $resultado = $excel->getRelatorioDiarioClasse($mapper_turma->getAlunosOrganizadosByTurma(unserialize(base64_decode($this->getParam('turmas'))), false, (int) base64_decode($this->getParam('periodo')), true), base64_decode($this->getParam('formato')), $mapper_calendario->getDatasByPeriodo(new Application_Model_Periodo((int) base64_decode($this->getParam('periodo')))));

        if (is_null($resultado))
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'As salas escolhidas não possuem nenhum aluno cadastrado'), null, true);

        if ($resultado === false)
            $this->_helper->redirector->goToRoute(array('controller' => 'error', 'action' => 'error', 'msg' => 'Houve erro ao gerar o relatório, consulte o administrador do sistema'), null, true);
    }
    public function opcoesRelatorioDiarioClasseAction()
    {
        $usuario = Zend_Auth::getInstance()->getIdentity();

        $this->view->title = "Projeto Incluir - Relatório Diário de Classe";
        $form_opcoes_relatorio = new Application_Form_RelatorioFrequenciaAlunos();

        $periodo = new Application_Model_Mappers_Periodo();
        $form_opcoes_relatorio->initializePeriodo($periodo->getPeriodos(), $periodo->getPeriodoAtual());

        if ($this->_request->isPost()) {
            $dados = $this->_request->getPost();
            $form_opcoes_relatorio->controleTurmas($dados);

            if (isset($dados['cancelar']))
                $this->_helper->redirector->goToRoute($usuario->getUserIndex(), null, true);

            if ($form_opcoes_relatorio->isValid($dados))
                $this->_helper->redirector->goToRoute(array('controller' => 'relatorio', 'action' => 'relatorio-diario-classe', 'turmas' => base64_encode(serialize($form_opcoes_relatorio->getValue('turmas'))), 'formato' => $form_opcoes_relatorio->getValue('formato_saida'), 'periodo' => $form_opcoes_relatorio->getValue('periodo')), null, true);
        }
        
        $this->view->form = $form_opcoes_relatorio;    // action body
             
        
       }
   


}




