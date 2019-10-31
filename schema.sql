SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `eiciscom_projetoprod_fechado` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eiciscom_projetoprod_fechado`;

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL,
  `nome_admin` varchar(100) NOT NULL,
  `login_admin` varchar(100) NOT NULL,
  `senha_admin` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `alimento`;
CREATE TABLE `alimento` (
  `id_alimento` int(11) NOT NULL,
  `nome_alimento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL COMMENT 'Código',
  `nome_aluno` varchar(100) NOT NULL COMMENT 'Nome',
  `sexo` tinyint(1) DEFAULT NULL,
  `cpf` varchar(15) NOT NULL,
  `is_cpf_responsavel` tinyint(1) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL COMMENT 'Telefone residencial',
  `celular` varchar(20) DEFAULT NULL COMMENT 'Celular',
  `data_nascimento` date DEFAULT NULL COMMENT 'Data de nascimento',
  `email` varchar(45) DEFAULT NULL COMMENT 'E-mail',
  `endereco` varchar(150) DEFAULT NULL COMMENT 'Endereço',
  `numero` int(10) UNSIGNED DEFAULT NULL COMMENT 'Número do endereço',
  `complemento` varchar(50) DEFAULT NULL COMMENT 'Complemento do endereço',
  `bairro` varchar(150) DEFAULT NULL COMMENT 'Bairro',
  `cidade` varchar(100) DEFAULT NULL COMMENT 'Código da cidade',
  `cep` varchar(20) DEFAULT NULL COMMENT 'CEP',
  `data_registro` date DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT 'Status',
  `data_desligamento` date DEFAULT NULL,
  `motivo_desligamento` varchar(300) DEFAULT NULL,
  `escolaridade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `nome_responsavel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cadastro comum de associados';

DROP TABLE IF EXISTS `atividade`;
CREATE TABLE `atividade` (
  `id_atividade` int(11) NOT NULL,
  `data_funcionamento` date NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `valor_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome_curso` varchar(45) NOT NULL,
  `descricao_curso` varchar(300) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `datas_funcionamento`;
CREATE TABLE `datas_funcionamento` (
  `data_funcionamento` date NOT NULL,
  `id_periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `datas_lancamentos_frequencias_turmas`;
CREATE TABLE `datas_lancamentos_frequencias_turmas` (
  `id_data_lancamento` int(11) NOT NULL,
  `data_funcionamento` date NOT NULL,
  `id_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE `disciplina` (
  `id_disciplina` int(11) NOT NULL,
  `nome_disciplina` varchar(100) NOT NULL,
  `ementa_disciplina` varchar(300) DEFAULT NULL,
  `id_curso` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `disciplina_pre_requisitos`;
CREATE TABLE `disciplina_pre_requisitos` (
  `id_disciplina` int(11) NOT NULL,
  `id_disciplina_pre_requisito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `discp_turma`;
CREATE TABLE `discp_turma` (
  `nome_disciplina` varchar(100) NOT NULL,
  `nome_turma` varchar(100) NOT NULL,
  `id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `django_migrations`;
CREATE TABLE `django_migrations` (
  `id` int(11) NOT NULL,
  `app` varchar(255) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `applied` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `escala_frequencia_voluntario`;
CREATE TABLE `escala_frequencia_voluntario` (
  `id_frequencia` int(11) NOT NULL DEFAULT 0,
  `data_funcionamento` date NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_saida` time DEFAULT NULL,
  `is_presente` tinyint(1) DEFAULT NULL,
  `id_voluntario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `falta`;
CREATE TABLE `falta` (
  `id_falta` int(11) NOT NULL,
  `id_turma_aluno` int(11) NOT NULL,
  `data_funcionamento` date NOT NULL,
  `observacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `data_log` date NOT NULL,
  `tipo_tarefa` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `nfaltas`;
CREATE TABLE `nfaltas` (
  `faltas` bigint(21) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `nome`;
CREATE TABLE `nome` (
  `nome_aluno` varchar(100) NOT NULL COMMENT 'Nome',
  `id_turma_aluno` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `nota` double DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `nota_aluno`;
CREATE TABLE `nota_aluno` (
  `id_nota` int(11) NOT NULL,
  `id_turma_aluno` int(11) NOT NULL,
  `id_atividades_turma` int(11) NOT NULL,
  `valor_nota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE `pagamento` (
  `id_pagamento` int(11) NOT NULL,
  `valor_pago` float NOT NULL,
  `situacao` tinyint(1) NOT NULL,
  `condicao` int(11) NOT NULL,
  `tipo_isencao_pendencia` int(11) DEFAULT NULL,
  `num_recibo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pagamento_alimentos`;
CREATE TABLE `pagamento_alimentos` (
  `id_pagamento` int(11) NOT NULL,
  `id_alimento` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `nome_periodo` varchar(45) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_termino` date DEFAULT NULL,
  `is_atual` tinyint(1) DEFAULT NULL,
  `valor_liberacao_periodo` float NOT NULL,
  `freq_min_aprov` int(11) NOT NULL,
  `total_pts_periodo` int(11) NOT NULL,
  `min_pts_aprov` int(11) NOT NULL,
  `quantidade_alimentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE `permissao` (
  `id_permissao` int(11) NOT NULL,
  `titulo_permissao` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `turma`;
CREATE TABLE `turma` (
  `id_turma` int(11) NOT NULL,
  `nome_turma` varchar(100) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `horario_inicio` time DEFAULT NULL,
  `horario_fim` time DEFAULT NULL,
  `status` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `sala` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `turma_alunos`;
CREATE TABLE `turma_alunos` (
  `id_turma_aluno` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_pagamento` int(11) NOT NULL,
  `aprovado` tinyint(1) DEFAULT NULL,
  `liberacao` tinyint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `turma_alunos_20191`;
CREATE TABLE `turma_alunos_20191` (
  `id_turma_aluno` int(11) NOT NULL DEFAULT 0,
  `id_turma` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_pagamento` int(11) NOT NULL,
  `aprovado` tinyint(1) DEFAULT NULL,
  `liberacao` tinyint(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `turma_atividades`;
CREATE TABLE `turma_atividades` (
  `id_atividades_turma` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_atividade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `login_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(100) NOT NULL,
  `id_voluntario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `usuario_permissoes`;
CREATE TABLE `usuario_permissoes` (
  `id_usuario` int(11) NOT NULL,
  `id_voluntario` int(11) NOT NULL,
  `id_usuario_permissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `voluntario`;
CREATE TABLE `voluntario` (
  `id_voluntario` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `formacao` varchar(45) DEFAULT NULL,
  `profissao` varchar(45) DEFAULT NULL,
  `telefone_fixo` varchar(45) DEFAULT NULL,
  `telefone_celular` varchar(45) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `funcao_informatica` varchar(100) DEFAULT NULL,
  `funcao_rh` varchar(100) DEFAULT NULL,
  `funcao_secretaria` varchar(100) DEFAULT NULL,
  `funcao_marketing` varchar(100) DEFAULT NULL,
  `carga_horaria` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_desligamento` date DEFAULT NULL,
  `motivo_desligamento` varchar(300) DEFAULT NULL,
  `disponibilidade` text DEFAULT NULL,
  `conhecimento` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `voluntario_disciplinas`;
CREATE TABLE `voluntario_disciplinas` (
  `id_voluntario` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `voluntario_turmas`;
CREATE TABLE `voluntario_turmas` (
  `id_voluntario` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin`);

ALTER TABLE `alimento`
  ADD PRIMARY KEY (`id_alimento`);

ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`);

ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id_atividade`),
  ADD KEY `fk_atividade_datas_funcionamento1_idx` (`data_funcionamento`);

ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

ALTER TABLE `datas_funcionamento`
  ADD PRIMARY KEY (`data_funcionamento`),
  ADD KEY `fk_datas_funcionamento_periodo1_idx` (`id_periodo`);

ALTER TABLE `datas_lancamentos_frequencias_turmas`
  ADD PRIMARY KEY (`id_data_lancamento`),
  ADD KEY `data_funcionamento` (`data_funcionamento`),
  ADD KEY `id_turma` (`id_turma`);

ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD KEY `fk_disciplina_modulo1_idx` (`id_curso`);

ALTER TABLE `disciplina_pre_requisitos`
  ADD PRIMARY KEY (`id_disciplina`,`id_disciplina_pre_requisito`),
  ADD KEY `fk_disciplina_has_disciplina_disciplina2_idx` (`id_disciplina_pre_requisito`),
  ADD KEY `fk_disciplina_has_disciplina_disciplina1_idx` (`id_disciplina`);

ALTER TABLE `django_migrations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `escala_frequencia_voluntario`
  ADD PRIMARY KEY (`id_frequencia`),
  ADD KEY `fk_frequencia_voluntario_voluntario1_idx` (`id_voluntario`),
  ADD KEY `fk_escala_frequencia_voluntario_datas_funcionamento1_idx` (`data_funcionamento`);

ALTER TABLE `falta`
  ADD PRIMARY KEY (`id_falta`,`id_turma_aluno`,`data_funcionamento`),
  ADD KEY `fk_falta_turma_aluno1_idx` (`id_turma_aluno`),
  ADD KEY `fk_falta_datas_funcionamento1_idx` (`data_funcionamento`);

ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

ALTER TABLE `nota_aluno`
  ADD PRIMARY KEY (`id_nota`,`id_turma_aluno`,`id_atividades_turma`),
  ADD KEY `fk_nota_turma_aluno1_idx` (`id_turma_aluno`),
  ADD KEY `fk_nota_turma_atividades1_idx` (`id_atividades_turma`);

ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id_pagamento`);

ALTER TABLE `pagamento_alimentos`
  ADD PRIMARY KEY (`id_pagamento`,`id_alimento`),
  ADD KEY `fk_pagamento_has_alimento_alimento1_idx` (`id_alimento`),
  ADD KEY `fk_pagamento_has_alimento_pagamento1_idx` (`id_pagamento`);

ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

ALTER TABLE `permissao`
  ADD PRIMARY KEY (`id_permissao`);

ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `fk_turma_periodo2_idx` (`id_periodo`),
  ADD KEY `fk_turma_disciplina1_idx` (`id_disciplina`);

ALTER TABLE `turma_alunos`
  ADD PRIMARY KEY (`id_turma_aluno`),
  ADD KEY `fk_turma_has_aluno_aluno1_idx` (`id_aluno`),
  ADD KEY `fk_turma_has_aluno_turma1_idx` (`id_turma`),
  ADD KEY `fk_turma_alunos_pagamento1_idx` (`id_pagamento`);

ALTER TABLE `turma_atividades`
  ADD PRIMARY KEY (`id_atividades_turma`),
  ADD KEY `fk_turma_has_Atividade_turma1_idx` (`id_turma`),
  ADD KEY `fk_turma_atividades_atividade1_idx` (`id_atividade`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`,`id_voluntario`),
  ADD KEY `fk_usuario_voluntario1_idx` (`id_voluntario`);

ALTER TABLE `usuario_permissoes`
  ADD PRIMARY KEY (`id_usuario`,`id_voluntario`,`id_usuario_permissao`),
  ADD KEY `fk_usuario_has_usuario_permissao_usuario_permissao1_idx` (`id_usuario_permissao`),
  ADD KEY `fk_usuario_has_usuario_permissao_usuario1_idx` (`id_usuario`,`id_voluntario`);

ALTER TABLE `voluntario`
  ADD PRIMARY KEY (`id_voluntario`);

ALTER TABLE `voluntario_disciplinas`
  ADD PRIMARY KEY (`id_voluntario`,`id_disciplina`),
  ADD KEY `fk_voluntario_has_disciplina_disciplina1_idx` (`id_disciplina`),
  ADD KEY `fk_voluntario_has_disciplina_voluntario1_idx` (`id_voluntario`);

ALTER TABLE `voluntario_turmas`
  ADD PRIMARY KEY (`id_voluntario`,`id_turma`),
  ADD KEY `fk_voluntario_has_turma_turma1_idx` (`id_turma`),
  ADD KEY `fk_voluntario_has_turma_voluntario1_idx` (`id_voluntario`);


ALTER TABLE `administrador`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `alimento`
  MODIFY `id_alimento` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código';

ALTER TABLE `atividade`
  MODIFY `id_atividade` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `datas_lancamentos_frequencias_turmas`
  MODIFY `id_data_lancamento` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `disciplina`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `django_migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `falta`
  MODIFY `id_falta` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nota_aluno`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pagamento`
  MODIFY `id_pagamento` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `permissao`
  MODIFY `id_permissao` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `turma`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `turma_alunos`
  MODIFY `id_turma_aluno` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `turma_atividades`
  MODIFY `id_atividades_turma` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `voluntario`
  MODIFY `id_voluntario` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `atividade`
  ADD CONSTRAINT `fk_atividade_datas_funcionamento1` FOREIGN KEY (`data_funcionamento`) REFERENCES `datas_funcionamento` (`data_funcionamento`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `datas_funcionamento`
  ADD CONSTRAINT `fk_datas_funcionamento_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `datas_lancamentos_frequencias_turmas`
  ADD CONSTRAINT `datas_lancamentos_frequencias_turmas_ibfk_1` FOREIGN KEY (`data_funcionamento`) REFERENCES `datas_funcionamento` (`data_funcionamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datas_lancamentos_frequencias_turmas_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_disciplina_modulo1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `disciplina_pre_requisitos`
  ADD CONSTRAINT `disciplina_pre_requisitos_ibfk_1` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disciplina_pre_requisitos_ibfk_2` FOREIGN KEY (`id_disciplina_pre_requisito`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `escala_frequencia_voluntario`
  ADD CONSTRAINT `fk_escala_frequencia_voluntario_datas_funcionamento1` FOREIGN KEY (`data_funcionamento`) REFERENCES `datas_funcionamento` (`data_funcionamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_frequencia_voluntario_voluntario1` FOREIGN KEY (`id_voluntario`) REFERENCES `voluntario` (`id_voluntario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `falta`
  ADD CONSTRAINT `fk_falta_datas_funcionamento1` FOREIGN KEY (`data_funcionamento`) REFERENCES `datas_funcionamento` (`data_funcionamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_falta_turma_aluno1` FOREIGN KEY (`id_turma_aluno`) REFERENCES `turma_alunos` (`id_turma_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `nota_aluno`
  ADD CONSTRAINT `fk_nota_turma_aluno1` FOREIGN KEY (`id_turma_aluno`) REFERENCES `turma_alunos` (`id_turma_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nota_turma_atividades1` FOREIGN KEY (`id_atividades_turma`) REFERENCES `turma_atividades` (`id_atividades_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `pagamento_alimentos`
  ADD CONSTRAINT `fk_pagamento_has_alimento_alimento1` FOREIGN KEY (`id_alimento`) REFERENCES `alimento` (`id_alimento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagamento_alimentos_ibfk_1` FOREIGN KEY (`id_pagamento`) REFERENCES `pagamento` (`id_pagamento`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_disciplina1` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_turma_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `turma_alunos`
  ADD CONSTRAINT `fk_turma_alunos_pagamento1` FOREIGN KEY (`id_pagamento`) REFERENCES `pagamento` (`id_pagamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_turma_has_aluno_aluno1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_turma_has_aluno_turma1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `turma_atividades`
  ADD CONSTRAINT `fk_turma_atividades_atividade1` FOREIGN KEY (`id_atividade`) REFERENCES `atividade` (`id_atividade`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_turma_has_Atividade_turma1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_voluntario1` FOREIGN KEY (`id_voluntario`) REFERENCES `voluntario` (`id_voluntario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `usuario_permissoes`
  ADD CONSTRAINT `fk_usuario_has_usuario_permissao_usuario1` FOREIGN KEY (`id_usuario`,`id_voluntario`) REFERENCES `usuario` (`id_usuario`, `id_voluntario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_has_usuario_permissao_usuario_permissao1` FOREIGN KEY (`id_usuario_permissao`) REFERENCES `permissao` (`id_permissao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `voluntario_disciplinas`
  ADD CONSTRAINT `fk_voluntario_has_disciplina_disciplina1` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_voluntario_has_disciplina_voluntario1` FOREIGN KEY (`id_voluntario`) REFERENCES `voluntario` (`id_voluntario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `voluntario_turmas`
  ADD CONSTRAINT `fk_voluntario_has_turma_turma1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_voluntario_has_turma_voluntario1` FOREIGN KEY (`id_voluntario`) REFERENCES `voluntario` (`id_voluntario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
