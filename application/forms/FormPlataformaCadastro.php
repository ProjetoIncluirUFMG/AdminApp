<?php

class Application_Form_FormPlataformaCadastro extends Zend_Form {

    public function init() {
        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'Decorators/form-plataforma-cadastro.phtml')))
        );

        $sistema_ativo = new Zend_Form_Element_Radio('sistema_ativo');
        $sistema_ativo->setMultiOptions(array(
                    1 => 'Sistema ativo',
                    0 => 'Sistema inativo'
                ))
                ->setValue(1)
                ->setDecorators(array(
                    'ViewHelper',
                    'Errors'
                ))
                ->setSeparator(' ');

        $somente_veterano = new Zend_Form_Element_Radio('somente_veterano');
        $somente_veterano->setMultiOptions(array(
                    1 => 'Somente veterados',
                    0 => 'Todos os alunos'
                ))
                ->setValue(1)
                ->setDecorators(array(
                    'ViewHelper',
                    'Errors'
                ))
                ->setSeparator(' ');

        $texto_inicial = new Zend_Form_Element_Textarea('texto_inicial');
        $texto_inicial->setLabel('Texto página inicial:')
                ->setAttrib('class', 'obrigatorio')
                ->setRequired(true)
                ->addValidator('NotEmpty')
                ->setDecorators(array(
                    'ViewHelper',
                    'Errors',
                    'Label'
        ));

        $enviar = new Zend_Form_Element_Submit('enviar');
        $enviar->setLabel('Salvar')
                ->setDecorators(array(
                    'ViewHelper'
        ));

        $cancelar = new Zend_Form_Element_Submit('cancelar');
        $cancelar->setLabel('Cancelar')
                ->setAttrib('class', 'cancel')
                ->setDecorators(array(
                    'ViewHelper'
        ));

        $limpar_tabela_pre_matricula = new Zend_Form_Element_Submit('limpar_tabela_pre_matricula');
        $limpar_tabela_pre_matricula->setLabel('Limpar tabela de pre matricula')
                ->setDecorators(array(
                    'ViewHelper'
        ));

        $this->addElements(array(
            $sistema_ativo,
            $texto_inicial,
            $somente_veterano,
            $enviar,
            $limpar_tabela_pre_matricula,
            $cancelar
        ));
    }
}
