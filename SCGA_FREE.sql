-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jun 02, 2014 as 06:41 PM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `scga-free`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `id` varchar(13) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `pai` varchar(150) NOT NULL,
  `mae` varchar(150) NOT NULL,
  `cx` varchar(5) NOT NULL,
  `rm` varchar(9) NOT NULL,
  `ra` varchar(30) NOT NULL,
  `dg` varchar(3) NOT NULL,
  `nasc` date NOT NULL,
  `matricula` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_doc`
--

CREATE TABLE IF NOT EXISTS `aluno_doc` (
  `aluno` varchar(13) NOT NULL,
  `doc` varchar(17) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `tipo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno_doc`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_doc_p`
--

CREATE TABLE IF NOT EXISTS `aluno_doc_p` (
  `aluno` varchar(13) NOT NULL,
  `doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno_doc_p`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_foto`
--

CREATE TABLE IF NOT EXISTS `aluno_foto` (
  `aluno` varchar(13) NOT NULL,
  `foto` varchar(17) NOT NULL,
  PRIMARY KEY (`aluno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno_foto`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `s_ano`
--

CREATE TABLE IF NOT EXISTS `s_ano` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ano` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `s_ano`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `s_conf`
--

CREATE TABLE IF NOT EXISTS `s_conf` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cadastro` varchar(25) NOT NULL,
  `cor` varchar(6) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `s_conf`
--

INSERT INTO `s_conf` (`id`, `cadastro`, `cor`, `tipo`) VALUES
(0, 'Matriculado', '075901', 'r'),
(1, 'Manhã', 'FF0000', 'p'),
(2, 'Tarde', '036E0A', 'p'),
(4, 'Médio - Regular', '000000', 'e'),
(5, 'Fundamental - Regular', '000000', 'e'),
(6, 'Transferido', 'FF0000', 'r'),
(7, 'Retiro', 'FF0000', 'r'),
(8, 'Promovido', '0000FF', 'r'),
(9, 'Promovido CCS', '0000FF', 'r'),
(10, 'Prog. Parcial', '0000FF', 'r'),
(11, 'Abandono', 'FF0000', 'r');

-- --------------------------------------------------------

--
-- Estrutura da tabela `s_doc`
--

CREATE TABLE IF NOT EXISTS `s_doc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `doc` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `s_doc`
--

INSERT INTO `s_doc` (`id`, `doc`) VALUES
(1, 'CÓPIA DA CERTIDÃO DE NASICMENTO'),
(2, '2 FOTOS 3X4 RECENTES'),
(3, 'CÓPIA DO COMPROVANTE DE RESIDÊNCIA'),
(4, 'CÓPIA DO CPF'),
(5, 'CÓPIA DO HISTÓRICO DO ENSINO FUNDAMENTAL'),
(6, 'CÓPIA DO RG'),
(7, 'HISTÓRICO DE TRANSFERÊNCIA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `s_favorito`
--

CREATE TABLE IF NOT EXISTS `s_favorito` (
  `id` varchar(13) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `endereco` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `s_favorito`
--

INSERT INTO `s_favorito` (`id`, `nome`, `endereco`) VALUES
('uc2014', 'Usuário - Cadastro', 'usuario_cad.php'),
('ano2014', 'Configuração - Ano Letivo', 'conf_ano.php'),
('cdoc2014', 'Configuração - Documentação', 'conf_documento.php'),
('csis2014', 'Configuração - Sistema', 'conf_sistema.php'),
('tc2014', 'Turma - Cadastro', 'turma_cada.php'),
('tv2014', 'Turma - Visualizar', 'turma_view.php'),
('pan2014', 'Aluno - Procurar por Nome', 'aluno_proc.php?tipo=1'),
('panm2014', 'Aluno - Procurar pelo Nome da Mãe', 'aluno_proc.php?tipo=2'),
('para2014', 'Aluno - Procurar por R.A.', 'aluno_proc.php?tipo=3'),
('parm2014', 'Aluno - Procurar por RM', 'aluno_proc.php?tipo=4'),
('ac2014', 'Aluno - Cadastro', 'aluno_cad.php'),
('p2014', 'Meus Dados', 'profile.php'),
('ps2014', 'Meus Dados - Alterar Senha', 'profile_senha.php');

-- --------------------------------------------------------

--
-- Estrutura da tabela `s_ftp`
--

CREATE TABLE IF NOT EXISTS `s_ftp` (
  `id` int(11) NOT NULL,
  `ftp_server` varchar(50) NOT NULL,
  `ftp_user` varchar(50) NOT NULL,
  `ftp_pass` varchar(50) NOT NULL,
  `ftp_aluno` varchar(20) NOT NULL,
  `ftp_doc` varchar(20) NOT NULL,
  `ftp_qrcode` varchar(20) NOT NULL,
  `ftp_logo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `s_ftp`
--

INSERT INTO `s_ftp` (`id`, `ftp_server`, `ftp_user`, `ftp_pass`, `ftp_aluno`, `ftp_doc`, `ftp_qrcode`, `ftp_logo`) VALUES
(1, 'TzpiunMmjrPqkgQlmSdVMQ==', 'pjOmjvdOCeW2D9GckoBbyQ==', 'FCP3fiHKcvY=', 'xpAmNcojtRU=', 'GW5VnFbDr/Y=', 'IYsa3RRFkVY=', 'mx2VY/SIscc=');

-- --------------------------------------------------------

--
-- Estrutura da tabela `s_ue`
--

CREATE TABLE IF NOT EXISTS `s_ue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `rua` varchar(40) NOT NULL,
  `num` varchar(4) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `cidade` varchar(40) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `logo` varchar(20) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `site` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `s_ue`
--

INSERT INTO `s_ue` (`id`, `nome`, `rua`, `num`, `bairro`, `cidade`, `uf`, `cep`, `logo`, `tel`, `email`, `site`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `s_usuario`
--

CREATE TABLE IF NOT EXISTS `s_usuario` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `tipo` smallint(6) NOT NULL DEFAULT '3',
  `foto` varchar(20) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `s_usuario`
--

INSERT INTO `s_usuario` (`id`, `nome`, `mail`, `senha`, `tipo`, `foto`) VALUES
(1, 'RAFAEL DE FREITAS VINAGRE', 'iUMyGkBu0B94lPtKpQ5Bh3ltPeeLAGcO', 's2KC0xCy3KU=', 1, 'default.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `s_usuario_favorito`
--

CREATE TABLE IF NOT EXISTS `s_usuario_favorito` (
  `id_user` varchar(40) NOT NULL,
  `id_fav` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `s_usuario_favorito`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `s_usuario_logado`
--

CREATE TABLE IF NOT EXISTS `s_usuario_logado` (
  `f_usuario_id` char(40) NOT NULL,
  `usuario_token` char(40) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `s_usuario_logado`
--

INSERT INTO `s_usuario_logado` (`f_usuario_id`, `usuario_token`, `data`) VALUES
('PSYY0y2NHlhQe3K9MzBtuDqdxXEyTAHK', '9/e7wvXGzq18JIo6d7S90A==', '2014-06-02 15:41:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `s_usuario_tipo`
--

CREATE TABLE IF NOT EXISTS `s_usuario_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `pasta` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `s_usuario_tipo`
--

INSERT INTO `s_usuario_tipo` (`id`, `tipo`, `pasta`) VALUES
(1, 'ADMINISTRAÇÃO', 'adm'),
(2, 'SECRETARIA', 'adm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `id` varchar(13) NOT NULL,
  `serie` varchar(2) NOT NULL,
  `turma` varchar(2) NOT NULL,
  `periodo` int(11) unsigned NOT NULL,
  `tipo_ensino` int(11) unsigned NOT NULL,
  `prodesp` varchar(9) NOT NULL,
  `ano` int(11) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_aluno`
--

CREATE TABLE IF NOT EXISTS `turma_aluno` (
  `id` varchar(13) NOT NULL,
  `turma` varchar(13) NOT NULL,
  `num` varchar(2) NOT NULL,
  `aluno` varchar(13) NOT NULL,
  `dataini` date NOT NULL,
  `situacao` varchar(2) NOT NULL,
  `datafim` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma_aluno`
--

