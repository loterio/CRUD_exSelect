CREATE DATABASE alunos;

USE alunos;

CREATE TABLE alunos (
codigo integer auto_increment primary key,
nome varchar(45) not null,
dataNasc date not null,
curso varchar(60)
);

insert into alunos(nome,dataNasc,curso) values
('Jenifernando','1997/05/09','Mecatronica'),
('Bertoldo','1962/01/19','Cacheta'),
('Claldio','2000/11/10','Eletroeletrônica'),
('Angelino','1959/07/03','Domino'),
('Pierre','1989/04/29','Música'),
('Lebdowsky','1993/07/03','Teatro'),
('Algusto','1999/09/12','Técnico em Mineração'); 

select * from alunos;

drop table alunos;
