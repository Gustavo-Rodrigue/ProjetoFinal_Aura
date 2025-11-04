CREATE DATABASE muralvagas;
USE muralvagas;

CREATE TABLE vagas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  empresa VARCHAR(255),
  email VARCHAR(255),
  telefone VARCHAR(20),
  responsavel VARCHAR(255),
  titulo VARCHAR(255),
  tipo VARCHAR(12),
  requisitos VARCHAR(255),
  atividades VARCHAR(255),
  init_expediente TIME,
  fim_expediente TIME,
  beneficios VARCHAR(255),
  publicacao DATE,
  visibilidade BOOLEAN
);


CREATE TABLE users(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    cpf BIGINT,
    senha VARCHAR(255),
    conta VARCHAR(50)
);

CREATE TABLE inscritos(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(255),
    email VARCHAR(255),
    telefone VARCHAR(20),
    atuacao VARCHAR(255),
    curriculo LONGBLOB,
    id_aluno INT,
    id_vaga INT,
    FOREIGN KEY(id_aluno) REFERENCES users(id),
    FOREIGN KEY(id_vaga) REFERENCES vagas(id)
);


INSERT INTO vagas(empresa, email, telefone, responsavel, titulo, tipo, requisitos, atividades, init_expediente, fim_expediente, beneficios, publicacao, visibilidade)
VALUES
('TechCorp', 'contato@techcorp.com', '11987654321', 'João Silva', 'Desenvolvedor Backend', 'EMPREGO', 'PHP, MySQL, API', 'Desenvolver APIs e manutenção de sistemas', '09:00:00', '17:00:00', 'Vale refeição, plano de saúde', '2025-10-27', true),
('WebSolutions', 'rh@websolutions.com', '11912345678', 'Maria Oliveira', 'Analista de Sistemas', 'ESTAGIO', 'Java, Spring, SQL', 'Analisar e desenvolver sistemas web', '08:30:00', '16:30:00', 'Home office, bônus por performance', '2025-10-28', true),
('FinTech Pro', 'contato@fintechpro.com.br', '1187654321', 'Carlos Almeida', 'Gerente de TI', 'EMPREGO', 'Gestão de equipe, infraestrutura', 'Gerenciar a infraestrutura de TI e liderar a equipe', '10:00:00', '18:00:00', 'Plano de saúde, participação nos lucros', '2025-10-25', true),
('EducaTech', 'vagas@educatech.com', '11965478900', 'Ana Costa', 'Designer Instrucional', 'APRENDIZAGEM', 'Design gráfico, ferramentas de EAD', 'Desenvolver materiais e cursos online', '13:00:00', '21:00:00', 'Vale transporte, jornada flexível', '2025-10-29', true),
('HealthPlus', 'rh@healthplus.com.br', '1134567890', 'Roberta Souza', 'Analista de Marketing Digital', 'EMPREGO', 'SEO, Google Ads, Analytics', 'Desenvolver campanhas de marketing e análise de resultados', '14:00:00', '22:00:00', 'Plano de saúde, vale alimentação', '2025-10-30', true);

INSERT INTO users(nome, cpf, senha, conta)
VALUES
('grupo3', '12312312355', '15de21c670ae7c3f6f3f1f37029303c9', 'admin')
 