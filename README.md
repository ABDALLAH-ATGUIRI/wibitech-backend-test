# Wibitech Backend Test

A Laravel 10 RESTful API built for the Wibitech technical assignment. This project demonstrates user authentication, role-based authorization (admin/user), and basic task management using Laravel best practices.

---

## 📋 Assignment Overview

**Objective:**  
Build a Laravel 10 RESTful API that includes:

- Authentication system (Login/Register/Logout)
- Role-based access control (Admin/User)
- Users and Tasks management
- Middleware for access restriction
- Clean structure and code practices

---

## 🚀 Features

- ✅ User authentication with access token stored in cookie
- ✅ Role-based middleware (`admin` and `user`)
- ✅ Policies for fine-grained authorization
- ✅ CRUD operations for `Users` and `Tasks`
- ✅ Task ownership protection via custom middleware
- ✅ API versioning (`/api/v1`)
- ✅ Enum usage for user roles and task statuses
- ✅ Seeder for default users and tasks

---

## 🛠 Tech Stack

- **Backend:** Laravel 10
- **Authentication:** Laravel Sanctum / Passport (depending on setup)
- **Authorization:** Laravel Gates & Policies
- **Database:** MySQL / PostgreSQL
- **Testing:** Postman (with Cookie-based token testing)
- **Extras:** Spatie (if used), Enum support

---

## 🧱 Database Schema

### Users

| Column     | Type     | Notes                      |
|------------|----------|----------------------------|
| id         | bigint   | Primary key                |
| username   | string   | Unique                     |
| first_name | string   |                            |
| last_name  | string   |                            |
| password   | string   | Hashed                     |
| role       | enum     | `admin` or `user`          |
| timestamps | datetime | Created_at, updated_at     |

### Tasks

| Column     | Type     | Notes                                |
|------------|----------|--------------------------------------|
| id         | bigint   | Primary key                          |
| title      | string   |                                      |
| description| text     |                                      |
| status     | enum     | `in_progress`, `done`                |
| user_id    | bigint   | Foreign key → `users.id`             |
| timestamps | datetime | Created_at, updated_at               |

---

## 📂 Folder Structure Highlights

app/
├── Http/
│ ├── Controllers/
│ ├── Middleware/
│ └── Requests/
├── Models/
├── Policies/
├── Enums/
routes/
└── api.php

---

## ⚙️ Installation

```bash
# Clone the repository
[git clone [https://github.com/your-username/wibitech-backend-test.git](https://github.com/ABDALLAH-ATGUIRI/wibitech-backend-test.git)]
cd wibitech-backend-test

# Install dependencies
composer install

# Copy .env and set DB credentials
cp .env.example .env
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Serve the app
php artisan serve
