# SYSQube Blog (Laravel- Vue JS application)

This repository contains a web application built with Vue.js v3 for the front-end and Laravel v10 for the back-end. This README file provides instructions on how to set up and run the application locally.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- Node.js (v20.x or higher)
- npm (v9.8.x or higher) 
- PHP (v8.1 or higher)
- Composer (v2.6.x)

## Getting Started

For Setting the project locally:

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/JObV9n/SysQubeBlog.git
cd SysQubeBlog
```

### 2. Set Up Laravel Backend
Install PHP Dependencies
Navigate to the Laravel backend directory and install PHP dependencies:
```bash
cd backend
composer install
```

### 3. Set Up Environment Variables
Copy the .env.example file to .env and update the database connection and any other necessary configuration:

```bash
Copy code
cp .env.example .env
Generate Application Key
Generate the Laravel application key:
```
```bash

php artisan key:generate
Run Database Migrations
Run database migrations to create the necessary tables:
```
```bash

php artisan migrate
Start Laravel Server
Start the Laravel development server:

```bash

php artisan serve --port=8000
```

### 4. Set Up Vue.js Frontend
Install Node.js Dependencies

```bash
npm install   # or `yarn install`
Configure Environment Variables
Ensure your Vue.js application points to the correct API endpoint (e.g., http://localhost:8000 for Laravel).
```
## Start Vue.js Development Server
```bash
npm run dev
```
`
4. Access the Application

Open your web browser and visit http://localhost:8080 to view the Vue.js application.

