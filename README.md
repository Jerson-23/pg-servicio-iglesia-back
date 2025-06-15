# 🧩 Backend — Sysbase (Laravel 12)

Bienvenido al backend de **Sysbase**, una aplicación base moderna desarrollada con **Laravel 12**.  
Este backend proporciona una API robusta, segura y escalable para conectar con aplicaciones frontend como Nuxt 3.

> ⚠️ Esta aplicación está pensada para ejecutarse en el **mismo dominio o subdominio** que el frontend para un correcto manejo de sesiones, cookies y CORS.

---

## ⚡ Requisitos

- PHP >= 8.2
- Composer >= 2
- MySQL / MariaDB
- Extensiones PHP requeridas (`pdo`, `mbstring`, `openssl`, etc.)
- Laravel CLI (opcional)

---

## 📥 Clonar el repositorio

```bash
git clone https://github.com/WilianMarroquin/sysbase-laravel-12.git
cd sysbase-laravel-12
```
## 📦 Instalar dependencias
    
```bash
composer install
```

## ⚙️ Configurar el entorno
Copia el archivo `.env.example` a `.env` y configura las variables de entorno necesarias, como la conexión a la base de datos, claves API, etc.

```bash
cp .env.example .env
```
Editá tu .env con tus datos reales:
    
```bash
APP_NAME=Sysbase
APP_URL=http://back.tuDominio.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sysbase
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=tuDominio.test,back.tuDominio.test
SESSION_DOMAIN=.tuDominio.test
FRONTEND_URL=http://tuDominio.test:3000

```
## 🔑 Generar la clave de aplicación

```bash
php artisan key:generate
```
## 🗄️ Migrar la base de datos

```bash
php artisan migrate --seed
```

## 📁 Estructura básica
📦 sysbase-laravel-12/  
┣ 📁 app/             → Lógica de la aplicación (Models, Controllers, etc.)   
┣ 📁 database/        → Migraciones, seeders y factories  
┣ 📁 routes/          → Rutas de la API y web (API: routes/api.php)  
┣ 📁 config/          → Configuraciones de Laravel  
┣ 📄 .env             → Variables de entorno  
┣ 📄 artisan          → CLI de Laravel  
┗ 📄 README.md        → Este archivo

---

## ✨ Autor

Desarrollado con 💚 por (https://github.com/WilianMarroquin)  
Si te resulta útil, ¡dejá una ⭐ en GitHub!

---
