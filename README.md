# 📚 Book Loans API – Laravel

A REST API built in **Laravel** for managing book loans in a library. This project was implemented as part of a backend lab (TP), covering migrations, models, controllers, routes, validations, and API testing with Postman.

---

## ✨ Features

- 📝 **CRUD operations** for loans (Create, Read, Update, Delete)
- ✅ **Return management**: mark loans as returned
- 🌐 JSON responses with `message` and `data` fields
- ⚡ Input validation using Laravel's `$request->validate()`
- 🚫 Returns **404** for non-existent loans
- 🧪 Fully tested endpoints with Postman

---

## 🗃️ Data Model

### Loan Model / `loans` Table

| Field          | Type                   | Description                           |
| -------------- | ---------------------- | ------------------------------------- |
| id             | bigIncrements          | Auto-increment primary key            |
| borrower_name  | string                 | Borrower’s name (required)            |
| borrower_email | string                 | Borrower’s email (required)           |
| book_title     | string                 | Title of the borrowed book (required) |
| borrowed_at    | date                   | Loan date                             |
| due_date       | date                   | Due date                              |
| returned       | boolean, default false | Return status (returned or not)       |
| status         | enum, default `active` | active , returned , overdue           |
| timestamps     | created_at, updated_at | Managed automatically by Laravel      |

---

## 🚀 API Endpoints

### Standard CRUD (`Route::apiResource('loans', LoanController)`)

Method

URI

Description

Status Code

GET

/api/loans

List all loans

200 OK

POST

/api/loans

Create a new loan

201 Created

GET

/api/loans/{id}

Retrieve a specific loan

200 OK / 404

PUT

/api/loans/{id}

Update a loan

200 OK / 404

DELETE

/api/loans/{id}

Delete a loan

204 / 404

### Custom Route

Method

URI

Description

Status Code

PATCH

/api/loans/{id}/return

Mark a loan as returned

200 OK / 404

---

## 🏃 How to Run

1.  Clone the repository
2.  Install dependencies:

```bash
composer install
```

3.  Set up `.env` file and configure database
4.  Run migrations:

```bash
php artisan migrate
```

5.  Start the server:

```bash
php artisan serve
```

6.  Test endpoints with **Postman** 🧪

---

## 📝 Notes

- All responses return JSON with `message` and `data`
- Validation ensures all required fields are provided
- Non-existent loans return **404 Not Found**
- Fully tested with Postman, including all CRUD operations and return endpoint ✅

---

## 📸 Screenshots

You can find all Postman test in the postman_tests folder at the root of the project.
