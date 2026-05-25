# JWT Authentication REST API

A secure REST API built using Core PHP with MVC architecture and JWT Authentication.
This project demonstrates user authentication, protected routes, middleware handling, and CRUD operations for patient management.

---

# Features

* MVC Architecture
* JWT Authentication & Authorization
* Secure Password Hashing
* Middleware-Based Route Protection
* JSON Request Validation
* Environment Variable Configuration (`.env`)
* CRUD Operations for Patients
* Centralized Routing System
* PDO Prepared Statements (SQL Injection Protection)

---

# Technologies Used

* Core PHP
* MySQL
* Apache (WAMP)
* JWT
* PDO
* Postman

---

# Project Structure

```
project/
│
├── app/
├── config/
├── public/
├── .env
├── .htaccess
└── README.md
```

---

# API Endpoints

| Method | Endpoint             | Description       |
| ------ | -------------------- | ----------------- |
| POST   | `/api/register`      | User Registration |
| POST   | `/api/login`         | User Login        |
| GET    | `/api/patients`      | Get All Patients  |
| POST   | `/api/patients`      | Create Patient    |
| PUT    | `/api/patients/{id}` | Update Patient    |
| DELETE | `/api/patients/{id}` | Delete Patient    |

---

# Authentication

Protected routes require JWT token in headers:

```text
Authorization: Bearer YOUR_TOKEN
```

---

# Setup Instructions

1. Move project to:

```text
C:/wamp64/www/project
```

2. Start Apache & MySQL in WAMP.

3. Create database and tables in phpMyAdmin.

4. Configure `.env` file.

5. Run APIs using Postman.

---

# Security Features

* Password Hashing using `password_hash()`
* Password Verification using `password_verify()`
* JWT Signature Validation
* Token Expiry Validation
* SQL Injection Protection using Prepared Statements
* Protected API Routes using Middleware

---

# Author

Developed by Mithra / Viknesh as a backend REST API practice project using Core PHP MVC architecture.
