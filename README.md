# Symfony 4.2 code sample

PHP 7.2, SQLite, Bootstrap 4 and jQuery

### Run: php bin/console server:run
maasil
===============

Projet de test technique en Symfony

Introduction
------------

Ce projet est un webapp "Blog", utilisant Symfony. 

Installation
------------

1. installer composer (au cas où il n'est pas encore installé) sur le site : 
" https://getcomposer.org/ "

2. installer symfony (au cas où il n'est pas encore installé) sur le site : 
" https://symfony.com/download "

3. installer xampp ou autre serveur sql puis lancer le.

4. Installer les dépendances
```bash ou cmd
$ composer install
```


5. Generer les bases de données (Important !!!!!!)
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:create

6. ouvrir " cmd " ou autre console:
- aller dans le repertoire de maasil, taper:
	"cd" + le chemin/repertoire de maasil
exemple : " cd D:\nos"

- lancer le serveur de symfony avec le code suivant:
	" symfony server:start -d "

- creer la base de données :
	" symfony console doctrine:database:create "

- faire une migration pour creer les différentes tables :
	" symfony console doctrine:migration:migrate "

7. ouvrir un navigateur, taper :
	" https://127.0.0.1:8000/ "
Au cas : où le navigateur met trop de temps à repondre, actualiser seulement

8. s'inscrire :
	- cliquer le bouton : " s'incrire "

9. se logger :
	- taper votre email
	- taper votre mot de passe

