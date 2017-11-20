<?php

class Application_Form_FormPlataformaCadastro extends Zend_Form {

    public function init() {
        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'Decorators/form-plataforma-cadastro.phtml')))
        );

        $liberacao_cadastro = new Zend_Form_Element_Radio('somente_veterano');
        $liberacao_cadastro->setMultiOptions(array(
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

        $this->addElements(array(
            $texto_inicial,
            $liberacao_cadastro,
            $enviar,
            $cancelar
        ));
    }
}
