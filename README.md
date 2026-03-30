-# Medical System Demo

This project is a simple Patient Management System developed using core PHP and MySQL. It follows a basic MVC structure and demonstrates how to build a structured web application without using a full framework.

The system allows users to manage patient records with essential operations such as creating, viewing, updating, and deleting data. It also includes proper validation and security practices.
<!-- 
Author
Antony Johnson Franklin -->

## Features

- Create new patient records  
- View a list of all patients  
- Update existing patient details  
- Delete patient records  
- Server-side validation for form inputs  
- CSRF protection for secure form submissions  
- Session-based error handling and form data persistence  

---

## Technologies Used

- PHP (Core PHP with MVC structure)  
- MySQL  
- Bootstrap 5  
- HTML and CSS  

---

## Project Structure
medical-system/
│
├── app/
│ ├── controllers/
│ ├── repositories/
│ ├── requests/
│ ├── views/
│ ├── helpers/
│ └── config/
│
├── public/
│ ├── index.php
│ └── assets/
│
└── README.md


---

## Setup Instructions

### 1. Clone the Repository
git clone https://github.com/ajfrankie/medical-system-demo


---

### 2. Move Project to Local Server

Place the project inside your server directory (for example, WAMP):
C:\wamp64\www\


---

### 3. Create Database

- Open phpMyAdmin  
- Create a database (e.g., `medical_system`)  
- Import your SQL file containing the `patients` table  

---

### 4. Configure Database Connection

Open: app/config/database.php


Update the database credentials:

```php
$host = "localhost";
$dbname = "medical_system";
$username = "root";
$password = "";

. Run the Application

Open your browser and go to:

http://localhost/medical-system/public

Validation Rules
Name is required
Age must be numeric
Age must be between 1 and 100
CSRF token is required and validated
Security

The application includes basic security practices such as:

CSRF token validation
Input validation on all forms
Session handling for error messages

Validation Rules
Name is required
Age must be numeric
Age must be between 1 and 100
CSRF token is required and validated
Security

The application includes basic security practices such as:

CSRF token validation
Input validation on all forms
Session handling for error messages