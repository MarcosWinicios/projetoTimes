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