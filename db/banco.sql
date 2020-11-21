CREATE DATABASE projetoTimes;
USE projetoTimes;

CREATE TABLE atleta (
	id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(60) NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    idade INT(11) NOT NULL,
    altura DECIMAL(3,2) NOT NULL,
    peso DECIMAL(4,1) NOT NULL,
    
    PRIMARY KEY(id)
);

CREATE TABLE treinador (
	id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(60) NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    qntVitoria INT(11) NOT NULL,
    bonusSalario DECIMAL(10,2),
    PRIMARY KEY(id)    
);

CREATE TABLE time (
	id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(60) NOT NULL,
    cidade VARCHAR(60) NOT NULL,
    qntVitoria INT(11) NOT NULL,
    anoFundacao INT(11) NOT NULL,
    idTreinador INT(11) NOT NULL,
    
    PRIMARY KEY(id),
    CONSTRAINT fk_time_treinador FOREIGN KEY(idTreinador) REFERENCES treinador (id)
);

CREATE TABLE atletaTime (
	idTime INT(11) NOT NULL,
    idAtleta INT(11) NOT NULL,
    
    CONSTRAINT fk_atletaTime_time FOREIGN KEY(idTime) REFERENCES time(id),
    CONSTRAINT fk_atletaTime_atleta FOREIGN KEY(idAtleta) REFERENCES atleta(id)
);


INSERT INTO treinador VALUES (1,'José',1000.00,10,500.00),(2,'Dunga',2500.50,15,800.20),(3,'Fulano',1500.00,15,1200.25),(4,'Siclando',1600.00,12,1300.25),(5,'Torvalds',2600.00,11,2300.25),(6,'Bill',1800.00,22,1500.15);

INSERT INTO atleta VALUES (1,'Marcos',2000.00,20,1.73,75.0),(3,'Josefino',3000.00,23,1.80,80.0),(4,'Nunes',250.00,28,1.79,85.0),(5,'João',1880.00,22,1.67,77.0),(6,'Bruno',1500.00,18,1.69,75.0),(7,'Carlos',2205.00,22,1.70,78.0),(8,'Pelé',3000.00,35,1.80,80.0),(9,'Felipe',2550.00,33,1.82,82.0),(10,'Gabriel',1850.00,21,1.85,82.0),(11,'Paulo',2850.00,31,1.87,84.0),(12,'Steve',3850.00,35,1.77,84.0);

INSERT INTO time VALUES (1,'Goiás','Goiânia',5,1950,1),(2,'São Paulo','São Paulo',8,1960,2),(3,'Santos','São Paulo',13,1970,3),(4,'Grêmio','Itapaci',8,1940,4);

INSERT INTO atletaTime VALUES (2,4),(1,1),(1,3),(3,7),(3,6),(3,8),(4,9),(4,10);