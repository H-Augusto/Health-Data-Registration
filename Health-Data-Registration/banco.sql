create database if not exists sistema_exames;
use sistema_exames;

drop table if exists dado_sensivel;
drop table if exists dados_saude;
drop table if exists dados_pessoais;
drop table if exists historico_medico;

CREATE TABLE `dado_sensivel` (
  `origem_racial` varchar(255) DEFAULT NULL,
  `religiao` varchar(255) DEFAULT NULL,
  `id_dado` int NOT NULL AUTO_INCREMENT,
  `cpf` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`id_dado`),
  UNIQUE KEY `uq_dado_sensivel_cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `dados_pessoais` (
  `nome` varchar(150) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('Masculino','Feminino','Outro') DEFAULT NULL,
  `estado_civil` enum('Casado(a)','Solteiro(a)','Viuvo(a)','Separado(a)','Divorciado(a)') DEFAULT NULL,
  `endereco` varchar(180) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(9) NOT NULL,
  `email` varchar(130) NOT NULL,
  `sistema_de_saude` enum('Convenio medico','Sus','Plano de saude','Particular') NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `rg` (`rg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `dados_saude` (
  `cpf` varchar(14) NOT NULL,
  `exames` text,
  `anamnese` text,
  `pressao_arterial` varchar(7) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `frequencia_cardiaca` smallint unsigned DEFAULT NULL,
  `relatorios_clinicos` text,
  `medicamentos_em_uso` text,
  `diagnosticos` text,
  KEY `cpf` (`cpf`),
  CONSTRAINT `dados_saude_ibfk_1` FOREIGN KEY (`cpf`) REFERENCES `dados_pessoais` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `historico_medico` (
  `doenca_cronica` text NOT NULL,
  `tratamentos` text NOT NULL,
  `hospitalizacao` text NOT NULL,
  `procedimentos_realizados` text,
  `id_historico` int NOT NULL AUTO_INCREMENT,
  `cpf` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`id_historico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;