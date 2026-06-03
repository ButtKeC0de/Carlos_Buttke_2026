CREATE DATABASE sistema_simples;

USE sistema_simples;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

INSERT INTO usuario (usuario, senha) VALUE ('admin','123');