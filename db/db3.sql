create database vendedor;

use vendedor;

create table vendedor (
codigo integer auto_increment primary key,
nomeDeUsuario varchar(12) unique not null,
senha varchar(18) not null,
nome varchar(45) not null,
email varchar(40),
telefone varchar(20) unique	
);

SELECT * FROM vendedor;

drop table vendedor;

insert into vendedor(nomeDeUsuario,senha,nome,email,telefone) values
('noobmaster69','imgaypls','Leo','leon@hotmail.com',9998326473),
('celebro',91857245,'Jôn','jon.lenon@yahuhuhu.com',12935445678),
('iorgute',12121212,'Linguini','lilin@hotmail.com',22566667873);

SELECT * FROM vendedor;
