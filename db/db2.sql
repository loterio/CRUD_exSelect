create database cliente;

use cliente;

create table cliente(
codigo integer auto_increment primary key,
nome varchar(45) not null,
email varchar(50) not null,
telefone varchar(11)
);

insert into cliente(nome, email, telefone) values
('Fabiana E','fabiana@gmail.com',47933333333),
('Antonio F','fabio@gmail.com',47922222222),
('Caio E','caio@gmail.com',47911111111),
('Fabio V','vitorloterio@gmail.com',47984698924);

select * from cliente;