# Bankly V2

Bankly V2 est une application interne moderne pour simplifier les opérations quotidiennes d'une banque. Elle permet aux employés de gérer les clients, les comptes bancaires et les transactions tout en offrant un système d'authentification sécurisé et un tableau de bord informatif.

---

## Table des matières

- [Aperçu du projet](#aperçu-du-projet)  
- [Fonctionnalités](#fonctionnalités)  
- [ERD & Base de données](#erd--base-de-données)  
- [Installation](#installation)  
- [Utilisation](#utilisation)  
- [Structure du projet](#structure-du-projet)  
- [User Stories](#user-stories)  
- [Technologies](#technologies)  
- [Fonctionnalités bonus](#fonctionnalités-bonus)  
- [Auteur](#auteur)  

---

## Aperçu du projet

Bankly V2 est un outil bancaire interne permettant de :  

- Gérer les clients  
- Créer et gérer les comptes bancaires  
- Enregistrer les dépôts et retraits  
- Consulter l’historique des transactions  
- Accéder au système de manière sécurisée via l’authentification  

Le projet privilégie une interface fonctionnelle et claire, avec de bonnes pratiques en conception de base de données, PHP et validation des données.

---

## Fonctionnalités

### Fonctionnalités principales

- **Authentification** : Système sécurisé de login/logout avec accès protégé  
- **Gestion des clients** : Ajouter, consulter, modifier et supprimer des clients  
- **Gestion des comptes** : Créer, consulter, modifier et supprimer des comptes bancaires  
- **Transactions** : Dépôts et retraits avec enregistrement automatique  
- **Tableau de bord** : Statistiques rapides sur les clients, comptes et transactions quotidiennes  

### Fonctionnalités bonus

- Rôles utilisateurs (Admin / Agent)  
- Journal des connexions  
- Recherche et filtres  
- Pagination des tables  
- Valeurs dynamiques dans le tableau de bord  
- Export des données en PDF / CSV  

---

## ERD & Base de données

**Entités principales :**

- **Utilisateur** : id, nom, email, mot de passe, rôle  
- **Client** : id, nom, email, CIN  
- **Compte** : id, client_id, type, solde, statut  
- **Transaction** : id, account_id, montant, type (dépôt/retrait), date  

**Relations :**

- Un **Client** peut avoir plusieurs **Comptes** (1:N)  
- Un **Compte** peut avoir plusieurs **Transactions** (1:N)  

Toutes les tables incluent les contraintes **PRIMARY KEY, FOREIGN KEY, UNIQUE, NOT NULL** pour garantir l’intégrité des données.

---

## Installation

1. Cloner le dépôt :  
```bash
git clone git@github.com:MOEUAED/Bankly-full-project.git
```

2. Configurer la connexion à la base dans config.php :
```
$host = "localhost";
$db = "bankly_v2";
$user = "root";
$pass = "";
```

3. Lancer le projet sur un serveur PHP local .

4. Importer la base de données :  
   - Ouvrez phpMyAdmin  
   - Créez une base de données nommée `bankly_v2`  
   - Importez le fichier `bankly_v2.sql` fourni dans le projet  

---

## Utilisation


- Une fois connecté, vous serez redirigé vers le **dashboard** :  
`dashboard.php`

- Gestion des clients :  
- Liste : `clients/list_clients.php`  
- Ajouter : `clients/add_client.php`  
- Modifier : `clients/edit_client.php`  

- Gestion des comptes :  
- Liste : `accounts/list_accounts.php`  
- Ajouter : `accounts/add_account.php`  
- Modifier : `accounts/edit_account.php`  
- Supprimer : `accounts/delete_account.php`

- Transactions :  
- Effectuer un dépôt/retrait : `transactions/make_transaction.php`  
- Historique : `transactions/list_transactions.php`

---

## Structure du projet

```
Bankly-full-project/
│
├── assets/ # CSS, JS, images
├── config.php # Connexion à la base de données
├── login.php # Authentification
├── logout.php # Déconnexion
├── dashboard.php # Statistiques
│
├── clients/
│ ├── list_clients.php
│ ├── add_client.php
│ ├── edit_client.php
│
├── accounts/
│ ├── list_accounts.php
│ ├── add_account.php
│ ├── edit_account.php
│ ├── delete_account.php
│
├── transactions/
│ ├── make_transaction.php
│ ├── list_transactions.php
│
└── README.md

```

---

## User Stories

- En tant qu’utilisateur, je peux me connecter et me déconnecter.
- En tant qu’agent, je peux gérer les clients (CRUD).
- En tant qu’agent, je peux gérer les comptes bancaires (CRUD).
- En tant qu’agent, je peux effectuer des dépôts et retraits.
- En tant qu’agent, je peux visualiser l’historique des transactions.
- En tant qu’utilisateur, je vois un tableau de bord avec les statistiques principales.

---

## Technologies

- **PHP**  
- **MySQL**  
- **HTML / CSS / JS**  
- **Tailwind**  

---

## Auteur

**Mouad Ziyani**  
Projet : *Bankly V2*  
