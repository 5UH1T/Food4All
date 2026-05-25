# 🍽️ Food4All

A Laravel-based food donation and distribution platform.

---

## 📦 Clone the Repository

```bash
git clone https://github.com/5UH1T/Food4All.git
cd Food4all
```

---

## ⚙️ Install Dependencies

### Install PHP Dependencies

```bash
composer install
```

### Install Node.js Dependencies

```bash
npm install
```

---

## 🔐 Environment Configuration

Copy the environment file:

```bash
cp .env.example .env
```

---

## 🗄️ Database Setup

### 1️⃣ Open XAMPP

Start the following services:

- Apache
- MySQL

### 2️⃣ Create Database

Open your browser and visit:

```text
http://localhost/phpmyadmin
```

Create a new database named:

```text
db_food4all
```

---

## 🚀 Laravel Setup

Generate the application key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Start the Laravel development server:

```bash
php artisan serve
```

---

## 🎨 Run Frontend Assets

Open another terminal and run:

```bash
npm run dev
```

---

## 🌐 Application URL

Visit the application at:

```text
http://127.0.0.1:8000
```

---

# 🤝 Contribution Workflow

After making changes, follow these Git commands:

## 🌱 Create a New Branch

```bash
git checkout -b branch_name
```

## ➕ Stage Changes

```bash
git add .
```

## 💾 Commit Changes

```bash
git commit -m "Your Message"
```

## 🚀 Push Branch

```bash
git push -u origin branch_name
```

---

# 🛠️ Tech Stack

- Laravel
- MySQL
- Vite
- NPM
- XAMPP

---

# 📄 License

This project is licensed under the MIT License.