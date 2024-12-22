# 🛠️ Système de Gestion de Projets

## 📖 Aperçu

Ce projet est un **système de gestion de projets**, conçu pour gérer les clients, projets, tâches, livrables, catégories et témoignages. L'application supporte trois rôles :

1. **Admin** : Accès complet pour gérer les utilisateurs, projets et tâches.
2. **Utilisateur** : Accès aux projets et tâches assignés.
3. **Banni** : Accès restreint avec une notification indiquant la suspension.

---

## 🚀 Démarrage

Suivez ces étapes pour configurer et lancer le projet localement :

### 1. Installer les dépendances
```bash
composer install
npm install
npm run build:css
```

### 2. Lancer les conteneurs Docker
```bash
docker-compose up -d --build
```

### 3. Accéder au conteneur PHP
```bash
docker-compose exec php bash
```

### 4. Migrer la base de données
```bash
php bin/console doctrine:migrations:migrate
```

### 5. Charger les Fixtures
- **Étape 1 :** Charger les fixtures Alice :
  ```bash
  php bin/console hautelook:fixtures:load
  ```
- **Étape 2 :** Charger les fixtures Doctrine (sans purger) :
  ```bash
  php bin/console doctrine:fixtures:load --append
  ```

---

## 🗃️ Structure de la Base de Données

### 📄 Entités Principales

1. **Client** : Représente les clients qui possèdent des projets et peuvent laisser des témoignages.
    - Un client peut avoir plusieurs projets et témoignages.

2. **Projet** : Représente un projet géré par un client.
    - Les projets peuvent avoir plusieurs tâches, livrables, catégories et témoignages.

3. **Tâche** : Représente une tâche spécifique dans un projet.
    - Les tâches appartiennent à un projet, un livrable, et peuvent être assignées à plusieurs utilisateurs.

4. **Livrable** : Représente les livrables d’un projet avec des échéances.

5. **Catégorie** : Permet de catégoriser les projets (par exemple : Développement, Marketing).

6. **Utilisateur** : Représente les utilisateurs du système avec des rôles (`ROLE_USER`, `ROLE_ADMIN`, `ROLE_BANNED`).

7. **Témoignage** : Feedback laissé par les clients sur un projet.

### 🔗 Tables Intermédiaires

- **`User_Project`** : Lie les utilisateurs aux projets qu’ils gèrent.
- **`User_Task`** : Lie les utilisateurs aux tâches qui leur sont assignées.
- **`Project_Category`** : Lie les projets à leurs catégories.

---

## 🔑 Comptes de Test pour l’Authentification

Utilisez les comptes suivants pour tester le système :

### Comptes Administrateurs
| Email                 | Mot de passe |
|-----------------------|--------------|
| `admin1@example.com`  | `admin123`   |
| `admin2@example.com`  | `admin123`   |

### Comptes Utilisateurs
| Email                 | Mot de passe   |
|-----------------------|----------------|
| `user1@example.com`   | `password123`  |
| `user2@example.com`   | `password123`  |
| `user3@example.com`   | `password123`  |

### Comptes Bannés
| Email                 | Mot de passe   |
|-----------------------|----------------|
| `banned1@example.com` | `banned123`    |
| `banned2@example.com` | `banned123`    |

> **Remarque :** Les utilisateurs bannis peuvent se connecter mais verront un message indiquant que leur compte est suspendu et n'auront pas accès aux autres pages.

---

## 💡 Se connecter à la base de données

Avec docker, vous pouvez vous connecter à la base de données via `Adminer` avec les informations suivantes :

- **Système** : `PostgreSQL`
- **Serveur** : `database`
- **Utilisateur** : `app`
- **Mot de passe** : `!ChangeMe!`
- **Base de données** : `app`

---

## 📧 Mailer 

Pour reset le mot de passe, le mail de reset est envoyé sur le mailcatcher `MailHog`. Pour accéder à la boite mail, il suffit d'aller sur `http://localhost:8025/`

---

## 🎯 Fonctionnalités

- **Système login/logout** :
    - Login
    - Logout
    - Mot de passe oublié
    - Réinitialisation du mot de passe
    - 3 roles : `ROLE_USER`, `ROLE_ADMIN`, `ROLE_BANNED`

- **Contrôle d’accès basé sur les rôles** :
    - Les admins ont un contrôle total sur les utilisateurs, projets et tâches.
    - Les utilisateurs accèdent uniquement à leurs projets et tâches.
    - Les utilisateurs bannis sont restreints et notifiés de leur suspension.

- **Page d’accueil dynamique** :
    - Contenu personnalisé en fonction du rôle de l’utilisateur connecté.

- **Gestion complète** des entités telles que les projets, tâches et catégories.

- **Fixtures** prêtes à l’emploi pour charger des données de test.

---

## 🧪 Tests

Après avoir chargé les fixtures, vous pouvez tester :
- Connexion avec les comptes ci-dessus.
- Accès basé sur les rôles aux pages comme `/admin`, `/project`, `/task`.
- Contenu dynamique de la page d’accueil selon les rôles des utilisateurs.

---
