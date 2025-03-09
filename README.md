# Sinistre Auto - Gestion des Sinistres Automobiles

![Sinistre Auto Logo](public/img/logo.jpg)

Sinistre Auto est une plateforme web moderne de gestion des sinistres automobiles, conçue pour simplifier et accélérer le processus de déclaration et de suivi des sinistres auto.

## 🚀 Fonctionnalités

- **Déclaration de Sinistre en Ligne**
  - Interface intuitive pour la déclaration des sinistres
  - Support pour différents types de sinistres (collision, vol, vandalisme, etc.)
  - Upload de photos et documents

- **Tableau de Bord Client**
  - Suivi en temps réel de l'état des sinistres
  - Historique complet des déclarations
  - Gestion du profil utilisateur

- **Types de Sinistres Supportés**
  - Collision de la Route
  - Bris de glaces
  - Incendie et explosion
  - Vandalisme et dégradations volontaires
  - Vol et tentative de vol

## 🛠️ Technologies Utilisées

- **Backend**
  - Laravel (Framework PHP)
  - MySQL

- **Frontend**
  - Blade Templates
  - TailwindCSS
  - Alpine.js
  - JavaScript

## 📋 Prérequis

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

## ⚙️ Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/youssefgrou/sinistre.git
   cd sinistre
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances JavaScript**
   ```bash
   npm install
   ```

4. **Configuration de l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurer la base de données**
   - Créer une base de données MySQL
   - Mettre à jour les informations de connexion dans le fichier `.env`

6. **Exécuter les migrations**
   ```bash
   php artisan migrate
   ```

7. **Compiler les assets**
   ```bash
   npm run dev
   ```

8. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

## 🔒 Sécurité

- Authentification sécurisée des utilisateurs
- Protection CSRF
- Validation des données
- Chiffrement des informations sensibles

## 🌐 Environnement de Production

Pour déployer en production :

1. Configurer les variables d'environnement
2. Optimiser l'autoloader
   ```bash
   composer install --optimize-autoloader --no-dev
   ```
3. Compiler les assets pour la production
   ```bash
   npm run build
   ```

## 📝 License

Ce projet est sous licence [MIT](LICENSE.md)

## 👥 Support

Pour toute assistance :
- Github : youssefgrou
- Téléphone : 06 78 42 04 19
- Horaires : Lundi au vendredi, 9h00 - 18h00

---

Développé avec ❤️ par l'équipe Sinistre Auto
