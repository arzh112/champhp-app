# Application

J'ai voulue réaliser une application de banque d'image de champignon qui permette à des utilisateurs
connectés de télécharger sur l'application des photos de champignon.
Chaque photo est reliée à un champignon spécifique présenté sur l'application.
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
    * Liste des images uploadées par les utilisateurs

* Page d'inscription

* Page de connexion

* Page de compte utilisateur
    * Bibliothèque personnel de l'utilisateurs avec toute les photos téléchargées

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

# Développement

## Les classes

J'ai définis cinq classes qui reprennent en propriété les colonnes de la base de donnée:
* les classes Admin et Client sont des classes enfants de la classe abstraite User, 
* la classe Mushroom 
* la classe Picture
J'ai aussi ajoûter les classes utilitaires vu en cours comme Utils et ErrorCode.

## Page d'inscription : register.php




