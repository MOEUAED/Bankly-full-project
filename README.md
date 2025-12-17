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

Le projet privilégie une interface fonctionnelle et claire, en respectant les bonnes pratiques de conception de bases de données, PHP et validation des données.

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

### Entités principales

- **Utilisateur** : id, nom, email, mot de passe, rôle  
- **Client** : id, nom, email, CIN  
- **Compte** : id, client_id, type, solde, statut  
- **Transaction** : id, account_id, montant, type (dépôt/retrait), date  

### Relations

- Un **Client** peut avoir plusieurs **Comptes** (1:N)  
- Un **Compte** peut avoir plusieurs **Transactions** (1:N)  

Toutes les tables incluent les contraintes **PRIMARY KEY, FOREIGN KEY, UNIQUE, NOT NULL** afin de garantir l’intégrité des données.

---

## Installation

1. Cloner le dépôt :  
```bash
git clone git@github.com:MOEUAED/Bankly-full-project.git
```

2. Configurer la connexion à la base dans config.php :

3. Lancer le projet sur un serveur PHP local .

4. Importer la base de données :  
   - Ouvrez phpMyAdmin  
   - Créez une base de données nommée `bankly_v2`  
   - Importez le fichier `bankly_v2.sql` fourni dans le projet  

---

## Utilisation

Après une authentification réussie, l’utilisateur est redirigé vers le **Dashboard** :  
`dashboard/dashboard.php`

Le dashboard affiche un résumé global (nombre de clients, comptes bancaires et transactions).

### Gestion des clients
- Consulter la liste des clients :  
  `clients/list_clients.php`
- Ajouter un nouveau client :  
  `clients/add_client.php`
- Modifier les informations d’un client :  
  `clients/edit_client.php`
- Supprimer un client :  
  `clients/delete_client.php`

### Gestion des comptes bancaires
- Consulter la liste des comptes :  
  `accounts/list_accounts.php`
- Créer un compte bancaire pour un client :  
  `accounts/add_account.php`
- Modifier un compte bancaire :  
  `accounts/edit_account.php`
- Supprimer un compte bancaire :  
  `accounts/delete_account.php`

### Gestion des transactions
- Effectuer une transaction (dépôt ou retrait) :  
  `transactions/make_transaction.php`
- Consulter l’historique des transactions (filtré par compte) :  
  `transactions/list_transactions.php`


---

## Structure du projet

```
Bankly-full-project/
│
├── 📁 config/
│   └── database.php          # Connexion à la base de donnees (mysqli)
│
├── 📁 auth/
│   ├── login.php             # Traitement du login
│   ├── signup.php            # Formulaire de enregistration
│   ├── signup_process.php    # Traitement du signup
│   └── logout.php            # Deconnexion (destroy session)
│
├── 📁 dashboard/
│   └── dashboard.php         # Dashboard avec statistiques
│
├── 📁 clients/
│   ├── list_clients.php      # Liste des clients
│   ├── add_client.php        # Ajouter un client
│   ├── edit_client.php       # Modifier un client
│   └── delete_client.php     # Supprimer un client
│
├── 📁 accounts/
│   ├── list_accounts.php     # Liste des comptes
│   ├── add_account.php       # Creer un compte
│   ├── edit_account.php      # Modifier un compte
│   └── delete_account.php    # Supprimer un compte
│
├── 📁 transactions/
│   ├── make_transaction.php  # Depot / Retrait
│   └── list_transactions.php # Historique des transactions
│
├── 📁 assets/
│   ├── 📁 css/
│   │   ├── input.css         # Fichier source Tailwind
│   │   ├── output.css        # CSS compile (Tailwind)
│   │   └── style.css         # Styles CSS personnalisés
│   ├── 📁 img/               # Icones et images du site
│   └── 📁 js/
│       └── script.js         # JavaScript 
│
├── 📁 sql/
│   └── bankly_v2.sql         # Base de donnees SQL finale
│
├── package.json              # Configuration npm / Tailwind
├── package-lock.json
├── README.md                 # Documentation du projet
└── index.php                 # Page de connexion

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
Projet académique : *Bankly V2*