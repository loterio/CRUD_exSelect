CREATE DATABASE estados;

USE estados;

CREATE TABLE estados (
codigo INTEGER AUTO_INCREMENT PRIMARY KEY,
nome varchar(30),
sigla varchar(2) unique
);

insert into estados(nome, sigla) values
('Santa Catarina', 'SC'),
('Paraná','PR'),
('Rio Grande do Sul','RS'),
('São Paulo','SP'),
('Rio de Janeiro','RJ'),
('Bahia','BH'),
('Mato Grosso do Sul','MS');

select * from estados;