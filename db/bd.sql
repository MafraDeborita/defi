CREATE DATABASE smartcash;

USE smartcash;

CREATE TABLE usuarios(
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    foto_usuario LONGBLOB
);

CREATE TABLE categorias(
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nome_categoria VARCHAR(255) NOT NULL,
    origem ENUM('Receita', 'Despesa')
);

CREATE TABLE saidas(
    id_saida INT PRIMARY KEY AUTO_INCREMENT,
    valor_saida DECIMAL(8,2) NOT NULL,
    data_saida DATE NOT NULL,
    pago BOOLEAN DEFAULT 0,
    descricao TEXT,
    id_categoria INT,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria) ON DELETE SET NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario) ON DELETE CASCADE
);

CREATE TABLE entradas(
    id_entrada INT PRIMARY KEY AUTO_INCREMENT,
    valor_entrada DECIMAL(8,2) NOT NULL,
    data_entrada DATE NOT NULL,
    descricao TEXT,
    id_categoria INT,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria) ON DELETE SET NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario) ON DELETE CASCADE
);

-- seeds de categoria
INSERT INTO categorias (nome_categoria, origem) VALUES 
('Alimentação', 'Despesa'),
('Moradia', 'Despesa'),
('Luz', 'Despesa'),
('Água', 'Despesa'),
('Salário', 'Receita'),
('Freelance', 'Receita'),
('Transporte', 'Despesa'),
('Educação', 'Despesa'),
('Saúde', 'Despesa'),
('Entretenimento', 'Despesa'),
('Roupas', 'Despesa'),
('Viagem', 'Despesa'),
('Impostos', 'Despesa'),
('Poupança', 'Receita'),
('Investimentos', 'Receita'),
('Presentes', 'Despesa'),
('Assinaturas', 'Despesa'),
('Seguros', 'Despesa'),
('Manutenção do carro', 'Despesa'),
('Telefone/Internet', 'Despesa'),
('Animais de estimação', 'Despesa'),
('Doações', 'Despesa'),
('Imprevistos', 'Despesa'),
('Outras Despesas', 'Despesa'),
('Outras Receitas', 'Receita');