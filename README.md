# Travel Agency Manager API

## Things I considered while building this project API:
- Services Layerd architecture (Separation of concerns)
- Requests and response handling using Form Requests and API Resources
- User roles using Auth (Admin, User) 
- Decoupled frontend and backend for better scalability 
- API Documentation using Swagger 

## Further improvements:
- Add global API Logger for better system logs visibility
- Add roles and policies for better Auth management.
- Add caching for better performance.
- Add rate limiting for better security.
- UI improvements


Follow these steps to set up the Travel Agency API project on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed:
- **PHP 8.2 or higher**
- **Composer** (PHP dependency manager)
- **Node.js & npm** (for frontend assets)
- **MySQL** (Database server)
- **API Docs** https://app.swaggerhub.com/apis/aounraza95organizati/TravelAgencyManager/1.1



## Setup Options

You can set up the project using **Docker**.

---

## Option A: Docker Quick Start (Recommended)

The easiest way to get both the backend and frontend running is using Docker.

### Requirements
Ensure you have [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/) installed.

### Clone frontend Repository
Clone the project to your local machine:
```bash
git clone https://github.com/aounraza95/travel_agency_manager_sio_frontend.git
```

### Clone backend Repository
Clone the project to your local machine:
```bash
git clone https://github.com/aounraza95/travel_agency_manager_sio_backend.git
cd travel_agency_manager_sio_backend
```

### Copy configuration file
```bash
cp .env.example .env
```

### Configure Environment
Set `DB_HOST=db` and `DB_PASSWORD=root` in your `.env` file to match the Docker setup.

### Setup the containers
From the **backend** directory, run:
```bash
docker-compose up -d --build
```
This will:
- Initialize the **MySQL** database.
- Start the **Laravel API** at [http://localhost:8000/api/v1](http://localhost:8000/api/v1).
- Start the **Frontend** at [http://localhost:5173](http://localhost:5173).
- Automatically run migrations and seeds (`migrate:fresh`).

### Useful Docker Commands
```bash
# Stop containers
docker-compose down

# View logs
docker-compose logs -f backend

# Run artisan commands inside container
docker-compose exec backend php artisan tinker
```

---


### Option B: Manual Setup (Alternative)
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

## API Authentication
The project uses **Laravel Sanctum** for authentication. You can find authentication routes under `/api/v1/login` and `/api/v1/register`.

## Troubleshooting

- **Database Connection**: Ensure your database server is running and the credentials in `.env` match.
- **Node Permissions**: If `npm install` fails, you may need to run it with sudo (on Linux/macOS) or as administrator (on Windows).
- **Migration Errors**: If migrations fail, ensure the database defined in `DB_DATABASE` actually exists.
