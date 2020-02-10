CREATE DATABASE paises;

USE paises;

CREATE TABLE paises (
cod integer auto_increment primary key,
nome varchar(45) not null,
sigla varchar(5) not null unique,
continente varchar(20)
);

INSERT INTO paises(nome,sigla,continente) VALUES
('Brasil','BR','America'),
('Estados Unidos','EUA','America'),
('Africa do Sul','AFK','Africa'),
('Canada','CND','America'),
('França','FR','Europa'),
('Belgica','BEL','Europa'),
('Australia','AUST','Oceania'),
('Argentina','ARG','America');

SELECT * FROM paises;
