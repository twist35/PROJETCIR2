# Projet CIR2

## Lucas Le Bihan et Antonin Sabiron

Ça match! est un site web permettant à des utilisateurs d'organiser ou de participer à des matchs de sport.

## Pré-requis

- serveur Apache2
- PHP 7.4
- MySQL 5.7

- connexion à Internet (utilisation de ressources externes)

## Installation

- envoyer et décompresser les fichiers sur le serveur
- Copier ces fichiers dans le bon répertoire :

```bash
sudo -r cp ~nomfichier_dezip/* /var/www/html
```

- se déplacer au serveur Apache

```bash

sudo cd /var/www/html/

```

- ouvrir mysql

```bash
sudo mysql
```

- copier le contenu de bdd/adduser.sql dans le terminal sql et valider

- sortir de sql

```bash

exit

```

- executer le script sql fourni

```bash
mysql -u user1 -p projetcir2 < sql/bdd.sql
```

## Informations

### Connexions

La base de données contient des utilisateur et des matchs.

Voici quelques identifiants d'utilisateur :

< login / mdp >

napo@gmail.com / azerty

vignaud@gmail.com / ytreza

anto@gmail.com / 1234

### Villes

Les villes doivent être rentrées dans la base de données.
Il existe par défaut 5 Villes :

- Brest
- Quimper
- Rennes
- Lorient
- Lannion
- Vannes
- Saint-Brieuc
- Saint-Malo
- Guingamp
- Pontivy

### Recherche

La page de recherche (index.html) permet d'effectuer un tri des matchs.

Il faut rentrer une date futur afin d'avoir un intervalle entre aujourd'hui et cette date.

## Fonctionnalités bonus

Des fonctionnalités supplémentaires ont été ajoutées :

- Authentification grâce aux sessions HTTP
- Ajout d'un nom de match pour une meilleur identification
- Bouton déconnexion
- Redirection de page si on est connecté ou pas (sécurité)
- .htaccess pour gérer les erreurs (404, 500, 300)
- Ajout meta "description" pour le référencement naturel
- Ajout icone sur les pages html

## Organisation

Tout au long du projet, chaque personne à toucher plus ou moins à toutes les technologies.
Voici un résumé du partage des principales tâches,

### Antonin Sabiron

- Web statique

### Lucas Le Bihan

- Création et insertion données BDD
- Préparation des requêtes SQL

### Commun

- Maquette MCD / MPD
- Maquette Figma
- Web dynamique

La collaboration s'est faire grâce à Git.

[Lien du github](https://github.com/twist35/PROJETCIR2)
