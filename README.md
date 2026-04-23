<p align="center">
  <h1 align="center">🏫 School Management System</h1>
  <p align="center">A full-featured, multi-role school management platform built with Laravel 12</p>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Redis-Cache-DC382D?style=for-the-badge&logo=redis&logoColor=white" />
</p>

---

## Table of Contents

- [Overview](#overview)
- [Tech Stack](#tech-stack)
- [Features](#features)
- [Architecture](#architecture)
- [Roles & Permissions](#roles--permissions)
- [API Endpoints](#api-endpoints)
- [Database Schema](#database-schema)
- [Getting Started](#getting-started)
- [Environment Variables](#environment-variables)

---

## Overview

A comprehensive school management system that handles the full academic lifecycle — from student enrollment and classroom management to exams, attendance, financial tracking, and online classes via Zoom integration. Supports **Arabic and English** with full RTL support.

---

## Tech Stack

### Backend
| Technology | Version | Purpose |
|---|---|---|
| **Laravel** | 12 | Core PHP framework |
| **PHP** | 8.2+ | Server-side language |
| **Laravel Sanctum** | 4.0 | API token authentication |
| **Livewire** | 4.2 | Real-time reactive UI components |
| **Spatie Permission** | 7.2 | Role-based access control (RBAC) |
| **Spatie Activity Log** | 4.12 | Audit trail & change history |
| **Spatie Translatable** | 6.13 | Multi-language model support |
| **mcamara/laravel-localization** | 2.3 | URL-based localization |
| **Predis** | 3.4 | Redis client for caching |

### Frontend
| Technology | Version | Purpose |
|---|---|---|
| **Tailwind CSS** | 4.0 | Utility-first styling |
| **Vite** | 7.0 | Asset bundling & hot reload |
| **Axios** | latest | HTTP client for API calls |
| **Livewire** | 4.2 | Component-based interactivity |

### Infrastructure & Services
| Service | Purpose |
|---|---|
| **MySQL** | Primary relational database |
| **Redis** | Caching layer & session storage |
| **Zoom API** | Online class video integration |
| **Mailtrap** | Email sandbox for development |
| **Laravel Sail** | Docker development environment |

---

## Features

### Admin
- Full dashboard with system-wide statistics
- Manage students, teachers, and parents
- Define academic structure: **grades → classrooms → sections → subjects**
- Create and manage exams with question banks
- Track student attendance per section
- Financial module: fees, invoices, payments, receipts, and student account ledger
- Student promotions and graduations between academic years
- Library resource management
- Activity log & audit trail for all model changes
- App settings management

### Teacher
- View assigned sections and student lists
- Create exams and question banks (MCQ support)
- Record daily attendance (present / absent / late / excused)
- Schedule online classes via **Zoom**
- Upload library resources for students

### Student
- Personal dashboard with academic overview
- View subjects, exams, and question banks
- Track own attendance records
- View fee invoices and payment history
- Join online classes

### Parent
- Monitor their child's academic progress
- View attendance and exam schedules
- Check fee invoices and payment status
- Access online class and library resources

---

## Architecture

The project follows a clean **layered architecture** separating concerns clearly:

```
app/
├── Actions/          # Single-responsibility business operations (CreateStudentAction, etc.)
├── Services/         # Orchestration layer (StudentService, ParentService, etc.)
├── Repositories/     # Data access abstraction (StudentRepository, etc.)
├── Http/
│   ├── Controllers/  # Thin controllers — delegate to services
│   ├── Requests/     # Form request validation
│   └── Resources/    # API response transformers (DTOs)
├── Livewire/         # Real-time UI components (AddParent, ParentForm, etc.)
├── Models/           # Eloquent models with scopes & translatable fields
├── Enums/            # Typed enums (Gender, ExamType, AttendanceStatus, FeeType)
└── Resolvers/        # Authorization scope resolvers (GradeScopeResolver)
```

**Design Patterns Used:**
- **Repository Pattern** — decoupled data access layer
- **Service Layer** — business logic isolated from controllers
- **Action Pattern** — single-use classes per CRUD operation
- **DTO / API Resources** — structured, consistent API responses
- **Scope Pattern** — `scopeAuthorizedForUser()` for role-based query filtering

---

## Roles & Permissions

Access is enforced via **Spatie Laravel Permission** with four roles:

```
admin   → Full system access
teacher → Section / exam / attendance / online class management
student → Read-only access to own academic data
parent  → Read-only access to child's data
```

Middleware enforcement example:
```php
Route::middleware(['auth', 'role:admin'])->group(...)
Route::middleware(['auth', 'role:teacher'])->group(...)
```

---

## API Endpoints

All API routes are protected with **Laravel Sanctum** token authentication.

### Authentication
```
POST   /api/login       → Returns API token
POST   /api/register    → Register new user
POST   /api/logout      → Revoke token
```

### Resources (RESTful CRUD)
```
/api/grades
/api/classrooms
/api/sections
/api/subjects
/api/teachers
/api/students
/api/parents
/api/exams
/api/questions
/api/attendances
```

Each resource supports standard HTTP verbs: `GET`, `POST`, `PUT/PATCH`, `DELETE`

---

## Database Schema

Key tables and their relationships:

```
users
  ├── students   (user_id, parent_id, grade_id, classroom_id, section_id)
  ├── teachers   (user_id, specialization_id)
  └── my_parents (father & mother info, translatable)

grades → classrooms → sections
subjects (grade_id, classroom_id, teacher_id)

exams (subject_id, type: quiz | midterm | final | assignment)
  └── questions (type: MCQ, options a–d, correct_answer)

attendances (student_id, section_id, date, status: present | absent | late | excused)

fees (grade_id, classroom_id, academic_year)
  ├── fee_invoices     (student_id, fee_id)
  ├── student_accounts (debit/credit ledger entries)
  ├── payment_students
  └── receipt_students

online_classes (zoom_meeting_id, join_url, start_url, subject_id)
libraries      (polymorphic file attachments)
attachments    (polymorphic: students, parents, settings)
activity_log   (full audit trail via Spatie)
```

---

## Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- MySQL
- Redis
- Node.js & npm

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/your-username/school-management-system.git
cd school-management-system

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Run database migrations and seeders
php artisan migrate --seed

# 7. Build frontend assets
npm run build

# 8. Start the development server
php artisan serve
```

---

## Environment Variables

```env
APP_NAME="School Management System"
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_management_system
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=redis

REDIS_HOST=127.0.0.1
REDIS_PORT=6379

# Zoom Integration
ZOOM_ACCOUNT_ID=your_account_id
ZOOM_CLIENT_ID=your_client_id
ZOOM_CLIENT_SECRET=your_client_secret

# Mail (Mailtrap)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

---

## Localization

The system fully supports **English** and **Arabic** (with RTL layout).

All model names, labels, and UI strings are translatable. Models using translatable fields:
`Grade`, `Classroom`, `Section`, `Subject`, `Exam`, `Question`, `OnlineClass`, `Library`, `MyParent`

Language is switched via URL prefix: `/en/dashboard` or `/ar/dashboard`

---

<p align="center">Built with Laravel 12 · PHP 8.2 · Tailwind CSS · Redis · MySQL · Zoom API</p>
