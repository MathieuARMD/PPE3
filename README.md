# PPE3
FREDI
Voici notre PPE FREDI de 2nd année SIO

Mathieu ARMAND / Téo AUGRY / Clément BLUZAT

[GitHub](https://github.com/MathieuARMD/PPE3.git)

## Description
Il s'agit de la création d'un site fonctionnel et de sa base de données SQL.
 
Le site nous permet d'accéder à plusieurs onglets disponibles sur celui-ci et de se connecter en tant que membre inscrit d'une ligue de la M2L. 

Ce site doit permettre de faciliter l'établissement du document officiel permettant la remise d'impôts et remplir en ligne les frais des adhérents de clubs.


## Installation
 * Telecharger le dossier depuis github 
 * Placer le dossier dans le serveur web
 * Utiliser le script de création de base de données contenu dans le dossier /db ([m2l.sql](./db/m2l.sql))

## Documentation
La documentation est contenu dans le dossier [/doc](./doc)

## Finalités
* connexion/déconnexion
* questions/réponses
* enregistrement dans la base de données de toutes les étapes précédentes


## Comptes

#### Utilisateur : 
* ID :jeff  mdp : jeff1
* accès à la FAQ, peut poser des questions 

#### Admin Ligue de Foot :
* ID : dylan  mdp : dylan1
* peut modifier / supprimer les questions de la ligue de football, et y répondre

#### Admin du site (toutes les ligues) :
* ID : georges  mdp : georges1
* peut modifier / supprimer les questions de toutes les ligues, et y répondre
* a accès au back office
