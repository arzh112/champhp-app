# Application

J'ai voulu réaliser une application de banque d'image de champignon qui permette à des utilisateurs
connectés de télécharger sur l'application des photos de champignon.
Chaque photo est liée à un champignon spécifique présenté sur l'application.
## Fonctionnalités

* Liste des champignons sous forme de carte
    * Photo
    * Nom
    * Nom Latin
    * Toxicité ou comestibilité

* Page détaillée du champignon
    * Photo
    * Nom
    * Nom Latin
    * Genre
    * Toxicité ou comestibilité
    * Habitat
    * Description
    * Formulaire d'upload de photo
    * Cartes des images uploadées par les utilisateurs

* Page d'inscription

* Page de connexion

* Page de compte utilisateur
    * Bibliothèque personnel de l'utilisateurs avec toutes les photos téléchargées.
    * L'utilisateur peu supprimer les photos qu'il a posté.

* Page photo de l'administrateur

* Page d'ajout d'un nouveau champignon par l'administrateur

## MCD

La base de données se compose de trois tables:

1. mushrooms : champignons présentés dans l'application.
Liste des colonnes :
* id
* name
* latin_name
* genus (genre)
* habitat
* category : type ENUM(Comestible, Indigeste, Toxique, Mortel)
* description
* main_picture (image principale)

2. pictures : images téléchargés par les utilisateurs sur l'application.
Liste des colonnes :
* id
* title
* picture_path
* type
* size
* upload_date (de type timestamp et une valeur par défaut CURRENT_TIMESTAMP et extra en DEFAULT_GENERATED)
* musrooms_id (clé étrangère)
* users_id (clé étrangère)

3. users
Liste des colonnes:
* id
* email
* username
* password_hash
* admin_status: de type TINYINT/BOOL 0 si c'est un utilisateur non admin et 1 si il est admin.

# Configuration

Importer la base de donnée à partir du fichier champhp-db.sql.

Créer un fichier db.ini avec ce modèle (disponible dans db.ini.template) :
```
DB_HOST="localhost"
DB_PORT=3306
DB_NAME="dbname"
DB_CHARSET="utf8mb4"
DB_USER="user"
DB_PASSWORD="password"
```

Il y a deux utilisateurs déjà créés:
Utilisateur admin: admin, email: admin@admin.com, password: admin.
Utilisateur non admin: user, email: user@user.com, password: user.

# Développement

## Les classes

J'ai défini cinq classes qui reprennent en propriétés les colonnes de la base de donnée:
* les classes Admin et Client sont des classes enfants de la classe abstraite User, 
* la classe Mushroom 
* la classe Picture
J'ai aussi ajoûter les classes utilitaires vu en cours comme Utils et ErrorCode.
J'ai aussi ajouté les interfaces IgetData et IgetDataById.

## Les fonctions

Au départ toute mes fonctionnalités de requêtes à la base de donnée étaient des fonctions que j'avais implémenté dans le fichier functions/db.php. Pour des raisons de clareté j'ai préféré implémenter les requêtes à la base de donnée dans des méthodes de classe statique ou non statique.
Il ne reste plus que la fonction getDBConnection() pour la liaison à la base de donnée qui renvoi une instance de PDO.

## Header : layout/header.php

J'ai pu expérimenter le polymorphisme de la méthode getUsername() en créant un tableau contenant des instances d'Admin ainsi que des instances de Client. Le but est de pouvoir afficher le nom d'utilisateur lorsqu'il est connecté.

```
$pdo = getDbConnection();
$admins = Admin::getData($pdo);    
$clients = Client::getData($pdo);    
$users = [...$admins, ...$clients];
```

```
<?php foreach ($users as $u) { ?>
    <?php if ($u->getEmail() === $_SESSION['login']) { ?>
        <?php $username = $u->getUsername(); ?>
    <?php } ?>
<?php } ?>
```

## Register : register.php

J'ai utilisé la méthode statique addToDB() de la classe Client. Le plus gros problème rencontré venait de la colonne password de la table users de la base de donnée que j'avais typé en VARCHAR 45 ce qui était trop peu pour des mots de passe hasher et qui renvoyait donc false lorsque j'utilisais la fonction password_verify() sur la page auth.php.

## Upload d'image

Depuis la page mushrooms-details.php les utilisateurs connectés peuvent envoyer des photos d'un champignon. Au départ le formulaire redirigeait vers une page upload.php qui éffectuait l'ajout à la base de donnée et au dossier upload dans les assets. La page upload redirigeait avec des messages d'erreur en cas d'échec ou un messages de succès. J'ai ensuite préférer gérer l'upload directement sur la page mushrooms-details.php et gérer les cas d'erreurs avec des exceptions.

# Pistes d'amélioration

## Factorisation
La factorisation en fonction ou en méthode de la fonctionnalité d'upload pourrait être intéressante car elle est utilisée à plusieurs endroits: la page mushrooms-details.php et la page admin-mushroom.php.

## Exception
Ajouter plus d'exceptions personnalisées (une seule pour le moment: InvalidEmailException).

## Modification
Ajouter une fonctionnalité permettant la modification par un admin des données de la table mushrooms.
Ajouter une fonctionnalité de gestion des utilisateurs par un admin.

# Avis sur le projet
La possibilité de réaliser un projet concret permet d'être confronté à toutes les problématiques d'organisation des fichiers, d'implémentation des fonctionnalités et de factorisation.
Ce projet à été vraiment formateur et j'ai vraiment beaucoup apprécié le réaliser.






