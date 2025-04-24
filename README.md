# Laravel Authentication System 🔐

A complete authentication setup with Passport, Sanctum, JWT, Fortify, Starter Kit, and manual implementations for both API and Web — all in one place.

[GitHub Repository](https://github.com/Nima8FT/Laravel-Authentication-System)

Version: [1.0.0]
## Table of Contents

1. [🚀 Overview](#1-overview)
2. [✨ Features](#2-features)
3. [🛠️ Installation](#3-installation)
4. [⚙️ Configuration](#4-configuration)
5. [💻 Usage](#5-usage)
6. [🗂️ Project Structure](#6-project-structure)
7. [🧪 Running Tests](#7-running-tests)
8. [🤝 Contributing](#8-contributing)
9. [📝 License](#9-license)

---

### 1. Overview

This repository implements all major Laravel authentication packages for both API and web contexts. For API, it integrates Passport, Sanctum, and JWT; for web, it uses Fortify, the Laravel Starter Kit, and a manual implementation. The goal is to provide a one-stop reference so developers can immediately leverage a complete auth stack without extra wiring. 

---

### 2. Features

**🔐 API Authentication**
- **Laravel Passport** – OAuth2-based full-featured API authentication
- **Laravel Sanctum** – Lightweight SPA token authentication
- **JWT** – Using `tymondesigns/jwt-auth` for stateless APIs

**🧭 Web Authentication**
- **Fortify** – Backend auth logic (no UI)
- **Starter Kit** – Prebuilt Blade or Vue scaffolding
- **Manual** – Fully custom controllers & middleware

**💡 Common Features**
- User registration, login, logout, and deletion
- "Remember Me", email verification, password reset
- Social login (Google, Facebook)
- Two-Factor Authentication (2FA)
- Session management (“Logout Other Devices”)
- Profile management, CAPTCHA protection
    
---

### 3. Installation

```bash
git clone https://github.com/Nima8FT/Laravel-Authentication-System.git
cd Laravel-Authentication-System
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

---

### 4. Configuration

Update your `.env` file with the proper DB credentials and any third-party API keys for social login or CAPTCHA.

---

### 5. Usage

- Use Postman or your preferred client to interact with the API routes.
- Web routes are accessible via your browser.

---

### 6. Project Structure

- `app/Http/Controllers/Auth/` - Custom auth logic
- `routes/web.php` and `routes/api.php` - Separate route files for web and API
- `config/auth.php` - Auth guard configuration

---

### 7. Running Tests

```bash
npm run dev
php artisan serve
```

---

### 8. Contributing

1. Fork this repository.
2. Create a branch: `git checkout -b my-feature`.
3. Make your changes and commit them: `git commit -m 'Add some feature'`.
4. Push to the branch: `git push origin my-feature`.
5. Submit a pull request.

---

### 9. License

This project is open-sourced software

---
