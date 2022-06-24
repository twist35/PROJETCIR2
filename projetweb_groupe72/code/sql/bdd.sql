/*
    Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant la base de donnée de base
*/
#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

USE projetcir2;

#------------------------------------------------------------
# Table: ville
#------------------------------------------------------------

DROP TABLE IF EXISTS ville;

CREATE TABLE ville(
        id_ville Int  Auto_increment  NOT NULL ,
        nom      Varchar (255) NOT NULL ,
        cp       Int NOT NULL
	,CONSTRAINT ville_PK PRIMARY KEY (id_ville)
)ENGINE=InnoDB;

#------------------------------------------------------------
#-- Contenu de ville
#------------------------------------------------------------

INSERT INTO ville (nom,cp) VALUES
    ('Brest',29200),
    ('Quimper',29000),
    ('Rennes',35000),
    ('Lorient',56100),
    ('Vannes',56000),
    ('Saint-Brieuc',22000),
    ('Saint-Malo',35400),
    ('Guingamp',22200),
    ('Pontivy',56300),
    ('Lannion',22300);

#------------------------------------------------------------
# Table: condition_physique
#------------------------------------------------------------

DROP TABLE IF EXISTS condition_physique;

CREATE TABLE condition_physique(
        condition_p Varchar (255) NOT NULL
	,CONSTRAINT condition_physique_PK PRIMARY KEY (condition_p)
)ENGINE=InnoDB;

#------------------------------------------------------------
#-- Contenu de condition_physique
#------------------------------------------------------------

INSERT INTO condition_physique (condition_p) VALUES
('Grand sportif'),
('Sportif'),
('Normal'),
('Mou du genou'),
('Sédentaire');

#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

DROP TABLE IF EXISTS user;

CREATE TABLE user(
        email          Varchar (255) NOT NULL ,
        prenom         Varchar (255) NOT NULL ,
        nom            Varchar (255) NOT NULL ,
        photo          Varchar (255) ,
        mdp            Varchar (255) NOT NULL ,
        date_naissance Date NOT NULL ,
        nb_win         Int ,
        note_site      Int ,
        id_ville       Int NOT NULL ,
        condition_p    Varchar (255) NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (email)

	,CONSTRAINT user_ville_FK FOREIGN KEY (id_ville) REFERENCES ville(id_ville)
	,CONSTRAINT user_condition_physique_FK FOREIGN KEY (condition_p) REFERENCES condition_physique(condition_p)
)ENGINE=InnoDB;

#------------------------------------------------------------
#-- Contenu de user
#------------------------------------------------------------

INSERT INTO user (email, prenom, nom, mdp, date_naissance, id_ville, condition_p, photo) VALUES
('lulu@gmail.com','Lucas','Le Bihan','123','2002-04-17','1','Sédentaire', 'ressources/img/profil1.png'),
('louis@gmail.com','Louis','Le Grand','estht','2002-04-17','4','Grand sportif', 'ressources/img/profil3.png'),
('vin@gmail.com','Vincent','Valentin','123','2002-04-17','5','Mou du genou', 'ressources/img/profil4.png'),
('momo@gmail.com','Mohamed','Le Sang','123','2002-04-17','1','Sédentaire', 'ressources/img/profil5.png'),
('anto@gmail.com','Antonin','Sabiron','1234','2002-12-06','3','Sportif', 'ressources/img/profil2.png'),
('user1@gmail.com','user1','anonymous','123','2002-04-17','1','Sédentaire', 'ressources/img/image-vide.jpg'),
('user2@gmail.com','user2','anonymous','123','2002-04-17','1','Sédentaire', 'ressources/img/image-vide.jpg'),
('user3@gmail.com','user3','anonymous','123','2002-04-17','1','Sédentaire', 'ressources/img/image-vide.jpg'),
('user4@gmail.com','user4','anonymous','123','2002-04-17','1','Sédentaire', 'ressources/img/image-vide.jpg'),
('user5@gmail.com','user5','anonymous','123','2002-04-17','1','Sédentaire', 'ressources/img/image-vide.jpg'),
('user6@gmail.com','user6','anonymous','123','2002-04-17','1','Sédentaire', 'ressources/img/image-vide.jpg'),
('napo@gmail.com','Thibault','Napoléon','azerty','1980-07-06','1','Mou du genou', 'ressources/img/prof1.png'),
('vignaud@gmail.com','Christophe','Vignaud','ytreza','1914-05-15','1','Grand sportif', 'ressources/img/prof2.png');

#------------------------------------------------------------
# Table: sport
#------------------------------------------------------------

DROP TABLE IF EXISTS sport;

CREATE TABLE sport(
        nom_sport Varchar (255) NOT NULL
	,CONSTRAINT sport_PK PRIMARY KEY (nom_sport)
)ENGINE=InnoDB;

#------------------------------------------------------------
#-- Contenu de sport
#------------------------------------------------------------

INSERT INTO sport (nom_sport) VALUES
('Football'),
('Basketball'),
('Handball'),
('Volleyball'),
('Tennis');

#------------------------------------------------------------
# Table: partie
#------------------------------------------------------------

DROP TABLE IF EXISTS partie;

CREATE TABLE partie(
        id_partie   Int  Auto_increment  NOT NULL ,
        nom_partie  Varchar (255) NOT NULL ,
        nb_joueurs  Int ,
        joueurs_min Int NOT NULL ,
        joueurs_max Int NOT NULL ,
        date        TimeStamp NOT NULL ,
        prix        Decimal (32,2) ,
        duree       Time NOT NULL ,
        score_a     Int ,
        score_b     Int ,
        adresse     Varchar (255) NOT NULL ,
        email       Varchar (255) NOT NULL ,
        id_ville    Int NOT NULL ,
        nom_sport   Varchar (255) NOT NULL
	,CONSTRAINT partie_PK PRIMARY KEY (id_partie)

	,CONSTRAINT partie_user_FK FOREIGN KEY (email) REFERENCES user(email)
	,CONSTRAINT partie_ville0_FK FOREIGN KEY (id_ville) REFERENCES ville(id_ville)
	,CONSTRAINT partie_sport1_FK FOREIGN KEY (nom_sport) REFERENCES sport(nom_sport)
)ENGINE=InnoDB;

#------------------------------------------------------------
#-- Contenu de partie
#------------------------------------------------------------

INSERT INTO partie ( nom_partie, nb_joueurs,joueurs_min, joueurs_max, date, duree, adresse, email, id_ville, nom_sport, score_a, score_b) VALUES
('Retour dans le passé', 10,'2','10','2022-06-17 17:00:00','02:00:00','20 Cuirasse Bretagne','lulu@gmail.com','1','Football', 2, 1),
('Garro Roland', 5,'5','20','2022-12-06 15:30:00','01:30:00','32 blabla','anto@gmail.com','3','Tennis', 0, 0),
('Match3', 4,'4','8','2017-02-25 10:00:00','01:00:00','3 blablabla','lulu@gmail.com','2','Basketball', 42, 36),
('Les Brestois', 2,'4','8','2022-07-28 10:00:00','01:00:00','4 blablabla','lulu@gmail.com','1','Handball', 0, 0),
('Les Rennais', 8,'4','8','2023-02-25 10:00:00','01:00:00','5 blablabla','anto@gmail.com','4','Football', 0, 0),
('NBA rpz', 7,'4','8','2036-01-12 10:00:00','01:00:00','6 blablabla','lulu@gmail.com','5','Basketball', 0, 0),
('ISEN FC', 8,'4','8','2022-06-25 10:00:00','01:00:00','7 blablabla','napo@gmail.com','1','Football', 0, 0),
('La tantouze', 8,'4','8','2022-06-26 10:00:00','01:00:00','8 blablabla','vignaud@gmail.com','6','Basketball', 0, 0),
('Lapero', 8,'4','8','2022-06-27 10:00:00','01:00:00','9 blablabla','napo@gmail.com','3','Handball', 0 , 0),
('Raquelette', 8,'4','8','2022-06-28 10:00:00','01:00:00','10 blablabla','vignaud@gmail.com','2','Tennis', 0, 0),
('Retour dans le passé', 8,'4','8','2022-05-26 10:00:00','01:00:00','11 blablabla','vignaud@gmail.com','6','Basketball', 23, 46),
('Retour dans le passé', 8,'4','8','2022-05-27 10:00:00','01:00:00','12 blablabla','napo@gmail.com','3','Handball', 11, 13);

#------------------------------------------------------------
# Table: photo
#------------------------------------------------------------

CREATE TABLE photo(
        photo     Varchar (50) NOT NULL ,
        nom_photo Varchar (50) NOT NULL
	,CONSTRAINT photo_PK PRIMARY KEY (photo)
)ENGINE=InnoDB;

#------------------------------------------------------------
#-- Contenu de user_inscrits
#------------------------------------------------------------

INSERT INTO photo (photo, nom_photo) VALUES
('ressources/img/profil1.png', 'Profil 1'),
('ressources/img/profil2.png', 'Profil 2'),
('ressources/img/profil3.png', 'Profil 3'),
('ressources/img/profil4.png', 'Profil 4'),
('ressources/img/profil5.png', 'Profil 5'),
('ressources/img/image-vide.jpg', 'Pas de photo');

#------------------------------------------------------------
# Table: user_inscrits
#------------------------------------------------------------

DROP TABLE IF EXISTS user_inscrits;

CREATE TABLE user_inscrits(
        id_user   Int  Auto_increment  NOT NULL ,
        valide    Bool ,
        mj        Bool ,
        id_partie Int NOT NULL ,
        email     Varchar (255) NOT NULL
	,CONSTRAINT user_inscrits_PK PRIMARY KEY (id_user)

	,CONSTRAINT user_inscrits_partie_FK FOREIGN KEY (id_partie) REFERENCES partie(id_partie)
	,CONSTRAINT user_inscrits_user0_FK FOREIGN KEY (email) REFERENCES user(email)
)ENGINE=InnoDB;

#------------------------------------------------------------
#-- Contenu de user_inscrits
#------------------------------------------------------------

INSERT INTO user_inscrits (valide, mj, email, id_partie) VALUES
(0,0,'lulu@gmail.com',1),
(1,0,'vin@gmail.com',1),
(1,0,'napo@gmail.com',1),
(0,0,'anto@gmail.com',1),
(1,0,'lulu@gmail.com',2),
(1,0,'napo@gmail.com',2),
(1,0,'vignaud@gmail.com',2),
(1,0,'anto@gmail.com',2),
(1,0,'louis@gmail.com',2),
(1,0,'vin@gmail.com',2),
(1,0,'momo@gmail.com',2),
(1,0,'momo@gmail.com',4),
(1,0,'louis@gmail.com',4),
(1,0,'vin@gmail.com',4),
(1,0,'anto@gmail.com',4),
(1,0,'lulu@gmail.com',5),
(1,0,'vin@gmail.com',5),
(1,0,'napo@gmail.com',5),
(1,0,'lulu@gmail.com',2),
(1,0,'lulu@gmail.com',8),
(1,0,'lulu@gmail.com',9),
(1,0,'lulu@gmail.com',7),
(0,0,'lulu@gmail.com',10),
(1,0,'momo@gmail.com',7),
(1,0,'napo@gmail.com',7),
(1,0,'louis@gmail.com',7),
(1,0,'anto@gmail.com',7),
(0,0,'vignaud@gmail.com',7),
(0,0,'vin@gmail.com',7),
(0,0,'user1@gmail.com',7),
(0,0,'user2@gmail.com',7),
(0,0,'user3@gmail.com',7),
(1,0,'momo@gmail.com',8),
(1,0,'napo@gmail.com',8),
(1,0,'louis@gmail.com',8),
(1,0,'anto@gmail.com',8),
(0,0,'vignaud@gmail.com',8),
(0,0,'vin@gmail.com',8),
(0,0,'user1@gmail.com',8),
(0,0,'user2@gmail.com',8),
(0,0,'user3@gmail.com',8),
(0,0,'momo@gmail.com',9),
(1,0,'louis@gmail.com',9),
(1,0,'anto@gmail.com',9),
(1,0,'vignaud@gmail.com',9),
(1,0,'user4@gmail.com',9),
(1,0,'user5@gmail.com',9),
(1,0,'user6@gmail.com',9),
(0,0,'momo@gmail.com',10),
(1,0,'louis@gmail.com',10),
(1,0,'anto@gmail.com',10),
(1,0,'vignaud@gmail.com',10),
(0,0,'vin@gmail.com',10),
(1,0,'user4@gmail.com',10),
(1,0,'user5@gmail.com',10),
(1,0,'user6@gmail.com',10),
(0,0,'user1@gmail.com',4),
(0,0,'user2@gmail.com',4),
(0,0,'user3@gmail.com',4),
(0,0,'user4@gmail.com',4),
(0,0,'user5@gmail.com',6),
(0,0,'user6@gmail.com',6),
(0,0,'user1@gmail.com',2),
(0,0,'user2@gmail.com',2),
(0,0,'user3@gmail.com',2),
(0,0,'user4@gmail.com',2),
(0,0,'user5@gmail.com',5),
(0,0,'user6@gmail.com',5);
