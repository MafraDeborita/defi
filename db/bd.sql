CREATE DATABASE defi;

USE defi;

CREATE TABLE usuarios(
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    foto_usuario LONGBLOB
);

CREATE TABLE categorias(
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nome_categoria VARCHAR(255) NOT NULL
);

CREATE TABLE saidas(
    id_saida INT PRIMARY KEY AUTO_INCREMENT,
    valor_saida DECIMAL(8,2) NOT NULL,
    data_saida DATE NOT NULL,
    pago BOOLEAN DEFAULT 0,
    descricao TEXT,
    id_categoria INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
);

CREATE TABLE entradas(
    id_entrada INT PRIMARY KEY AUTO_INCREMENT,
    valor_entrada DECIMAL(8,2) NOT NULL,
    data_entrada DATE NOT NULL,
    descricao TEXT,
    id_categoria INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
);

-- seeds de categoria
INSERT INTO categorias (nome_categoria) VALUES 
('Alimentação'),
('Moradia'),
('Luz'),
('Agua');