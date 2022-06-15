#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: ville
#------------------------------------------------------------

CREATE TABLE ville(
        id_ville Int  Auto_increment  NOT NULL ,
        nom      Varchar (255) NOT NULL ,
        cp       Int NOT NULL
	,CONSTRAINT ville_PK PRIMARY KEY (id_ville)
)ENGINE=InnoDB;

------------------------------------------------------------
--Contenu de ville
------------------------------------------------------------

INSERT INTO ville (nom,cp) VALUES
    ('Brest',29200),
    ('Quimper',29000),
    ('Rennes',35000),
    ('Lorient',56100),
    ('Lannion',22300);

#------------------------------------------------------------
# Table: condition_physique
#------------------------------------------------------------

CREATE TABLE condition_physique(
        condition_p Varchar (255) NOT NULL
	,CONSTRAINT condition_physique_PK PRIMARY KEY (condition_p)
)ENGINE=InnoDB;

------------------------------------------------------------
--Contenu de condition_physique
------------------------------------------------------------

INSERT INTO condition_physique (condition_p) VALUES
('Sportif'),
('Sédentaire');

#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        email          Varchar (255) NOT NULL ,
        prenom         Varchar (255) NOT NULL ,
        nom            Varchar (255) NOT NULL ,
        photo          Varchar (255) ,
        mdp            Varchar (255) NOT NULL ,
        date_naissance Date NOT NULL ,
        nb_win         Int ,
        id_ville       Int NOT NULL ,
        condition_p    Varchar (255) NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (email)

	,CONSTRAINT user_ville_FK FOREIGN KEY (id_ville) REFERENCES ville(id_ville)
	,CONSTRAINT user_condition_physique0_FK FOREIGN KEY (condition_p) REFERENCES condition_physique(condition_p)
)ENGINE=InnoDB;

------------------------------------------------------------
--Contenu de user
------------------------------------------------------------

INSERT INTO user (email, prenom, nom, mdp, date_naissance, id_ville, condition_p) VALUES
('lulu@gmail.com','Lucas','LeBihan','123','2002-04-17','0','Sédentaire'),
('anto@gmail.com','Antonin','Sabiron','1234','2002-12-06','2','Sportif');

#------------------------------------------------------------
# Table: sport
#------------------------------------------------------------

CREATE TABLE sport(
        nom_sport Varchar (255) NOT NULL
	,CONSTRAINT sport_PK PRIMARY KEY (nom_sport)
)ENGINE=InnoDB;

------------------------------------------------------------
-- Contenu de sport
------------------------------------------------------------

INSERT INTO sport (nom_sport) VALUES
('Footbal'),
('Basketball'),
('Handball'),
('Volleyball'),
('Tennis');

#------------------------------------------------------------
# Table: partie
#------------------------------------------------------------

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
        num_rue     Int NOT NULL ,
        nom_rue     Varchar (255) NOT NULL ,
        email       Varchar (255) NOT NULL ,
        id_ville    Int NOT NULL ,
        nom_sport   Varchar (255) NOT NULL
	,CONSTRAINT partie_PK PRIMARY KEY (id_partie)

	,CONSTRAINT partie_user_FK FOREIGN KEY (email) REFERENCES user(email)
	,CONSTRAINT partie_ville0_FK FOREIGN KEY (id_ville) REFERENCES ville(id_ville)
	,CONSTRAINT partie_sport1_FK FOREIGN KEY (nom_sport) REFERENCES sport(nom_sport)
)ENGINE=InnoDB;

------------------------------------------------------------
-- Contenu de partie
------------------------------------------------------------

INSERT INTO partie ( nom_partie, joueurs_min, joueurs_max, date, duree, num_rue, nom_rue) VALUES
('Match1','2','10','2022-06-17 17:00:00','02:00:00','20','Cuirasse Bretagne'),
('Match2','5','20','2022-12-06 15:30:00','01:30:00','32','blabla'),
('Match3','4','8','2017-02-25 10:00:00','01:00:00','5','blablabla');

#------------------------------------------------------------
# Table: user_inscrits
#------------------------------------------------------------

CREATE TABLE user_inscrits(
        email     Varchar (255) NOT NULL ,
        valide    Bool ,
        mj        Bool ,
        id_partie Int NOT NULL
	,CONSTRAINT user_inscrits_PK PRIMARY KEY (email)

	,CONSTRAINT user_inscrits_user_FK FOREIGN KEY (email) REFERENCES user(email)
	,CONSTRAINT user_inscrits_partie0_FK FOREIGN KEY (id_partie) REFERENCES partie(id_partie)
)ENGINE=InnoDB;

------------------------------------------------------------
-- Contenu de user_inscrits
------------------------------------------------------------

INSERT INTO user_inscrits (email) VALUES
('lulu@gmail.com'),
('anto@gmail.com'),
('lulu@gmail.com'),
('anto@gmail.com'),