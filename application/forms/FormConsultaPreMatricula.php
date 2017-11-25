<?php

class Application_Form_FormConsultaPreMatricula extends Zend_Form {

    public function init() {
        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'Decorators/form-consulta-pre-matricula.phtml')))
        );

        $string_filter = new Aplicacao_Filtros_StringFilter();

        $nome_aluno = new Zend_Form_Element_Text('nome_aluno');
        $nome_aluno->setLabel('Nome do aluno:')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addFilter($string_filter)
                ->setDecorators(array(
                    'ViewHelper',
                    'Errors',
                    'Label'
        ));

        $numero_comprovante = new Zend_Form_Element_Text('numero_comprovante');
        $numero_comprovante->setLabel('Numero Comprovante:')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addFilter($string_filter)
                ->setDecorators(array(
                    'ViewHelper',
                    'Label',
                    'Errors'
        ));

        $buscar = new Zend_Form_Element_Submit('buscar');
        $buscar->setLabel('Buscar')
                ->setDecorators(array(
                    'ViewHelper'
        ));

        $this->addElements(array(
            $nome_aluno,
            $numero_comprovante,
            $buscar
        ));

    }

}
