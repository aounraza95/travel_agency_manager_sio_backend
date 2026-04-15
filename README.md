# Installation Guide

Follow these steps to set up the Travel Agency API project on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed:
- **PHP 8.2 or higher**
- **Composer** (PHP dependency manager)
- **Node.js & npm** (for frontend assets)
- **MySQL** (Database server)
- **API Docs** https://app.swaggerhub.com/apis/aounraza95organizati/TravelAgencyManager/1.1

## Setup Steps

### 1. Clone the Repository
Clone the project to your local machine:
```bash
git clone https://github.com/aounraza95/travel_agency_manager_sio_backend.git
cd travel_agency_manager_sio_backend
```

### 2. Automated Setup (Recommended)

#### Option A: Using Makefile
If you have `make` installed, this is the quickest way to set up the project:
```bash
make setup
```

#### Option B: Using Composer
If you don't have `make`, you can use the composer command:
```bash
composer run setup
```

Both options will:
- Install PHP dependencies (`composer install`)
- Create a `.env` file from `.env.example`
- Generate the encryption key (`php artisan key:generate`)
- Run database migrations and seeders (`php artisan migrate --seed`)
- Install Node dependencies (`npm install`)
- Build the frontend assets (`npm run build`)

---

### 3. Manual Setup (Alternative)
If you prefer to perform each step manually:

#### A. Install Dependencies
```bash
composer install
npm install
```

#### B. Environment Configuration
Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```
Open `.env` and configure your database settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_agency_db
DB_USERNAME=root
DB_PASSWORD=
```

#### C. Generate Application Key
```bash
php artisan key:generate
```

#### D. Database Migrations & Seeding
Run the migrations and seed the database with sample data (Travel Plans, Cities, etc.):
```bash
php artisan migrate --seed
```

## Running the Application

### Start the Development Server

Laravel server:
```bash
make serve
# or
php artisan serve
```

The API will be available at `http://localhost:8000/api/v1`.

### Makefile Commands

| Command | Description |
| --- | --- |
| `make setup` | Full project setup (deps, env, migrate, build) |
| `make serve` | Start only the Laravel development server |
| `make migrate` | Run database migrations |
| `make seed` | Seed the database with sample data |
| `make test` | Run PHPUnit tests |
| `make clean` | Clear caches and remove logs |

## API Authentication
The project uses **Laravel Sanctum** for authentication. You can find authentication routes under `/api/v1/login` and `/api/v1/register`.

## Troubleshooting

- **Database Connection**: Ensure your database server is running and the credentials in `.env` match.
- **Node Permissions**: If `npm install` fails, you may need to run it with sudo (on Linux/macOS) or as administrator (on Windows).
- **Migration Errors**: If migrations fail, ensure the database defined in `DB_DATABASE` actually exists.
