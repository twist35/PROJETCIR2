/*
    Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant les commandes de base pour initier la base de données
*/
drop database if exists projetcir2;
CREATE DATABASE projetcir2 DEFAULT CHARACTER SET utf8 DEFAULT COLLATE
utf8_general_ci;
CREATE USER 'user1'@'localhost' IDENTIFIED BY 'isen29';
GRANT ALL PRIVILEGES ON projetcir2.* TO 'user1'@'localhost' WITH GRANT OPTION;
