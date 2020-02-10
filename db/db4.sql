create database escola;

use escola;

create table escola (
cod integer auto_increment primary key,
nomeEscola varchar(45) not null,
cidade varchar(50) not null,
numAlunos integer,
nomeDiretora varchar(45)
);

insert into escola(nomeEscola,cidade,numAlunos,nomeDiretora) values
('João Alberto Schmit','Vidal Ramos',63,'Jucineia'),
('IFC Campus Rio do Sul','Rio do Sul',600,'Veiga'),
('COC','Rio do Sul','450','James Bond'),
('Dom Bosco','Rio do Sul',760,'Papa Fr.'),
('Roberto Moritz','Ituporanga',500,'Dega'),
('Cacilda Guimaraes','Vidal Ramos','1000','Betcha');

select * from escola;
