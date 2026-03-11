# 📚 Book Loans API – Laravel

A RESTful API built in **Laravel** for managing book loans in a library. This project was implemented as part of a backend lab (TP), covering migrations, models, controllers, routes, validations, factories, seeders, and API testing with Postman.

---

## ✨ Features

- 📝 **CRUD operations** for loans (Create, Read, Update, Delete)
- ✅ **Return management**: mark loans as returned
- 🌐 JSON responses with `message` and `data` fields
- ⚡ Input validation using **Form Requests**
- 🏭 **Factories** to generate fake loan data
- 🌱 **Seeders** to populate the database with sample records
- 🚫 Returns **404** for non-existent loans
- 🧪 Fully tested endpoints with Postman

---

# 🗃️ Data Model

## Loan Model / `loans` Table

| Field          | Type                   | Description                           |
| -------------- | ---------------------- | ------------------------------------- |
| id             | bigIncrements          | Auto-increment primary key            |
| borrower_name  | string                 | Borrower’s name (required)            |
| borrower_email | string                 | Borrower’s email (required)           |
| book_title     | string                 | Title of the borrowed book (required) |
| borrowed_at    | date                   | Loan date                             |
| due_date       | date                   | Due date                              |
| returned       | boolean, default false | Return status (returned or not)       |
| status         | enum, default `active` | active, returned, overdue             |
| timestamps     | created_at, updated_at | Managed automatically by Laravel      |

---

# 🚀 API Endpoints

## Standard CRUD (`Route::apiResource('loans', LoanController)`)

| Method | URI               | Description              | Status Code                    |
| ------ | ----------------- | ------------------------ | ------------------------------ |
| GET    | `/api/loans`      | List all loans           | 200 OK                         |
| POST   | `/api/loans`      | Create a new loan        | 201 Created                    |
| GET    | `/api/loans/{id}` | Retrieve a specific loan | 200 OK / 404 Not Found         |
| PUT    | `/api/loans/{id}` | Update a loan            | 200 OK / 404 Not Found         |
| DELETE | `/api/loans/{id}` | Delete a loan            | 204 No Content / 404 Not Found |

## Custom Route

| Method | URI                      | Description             | Status Code            |
| ------ | ------------------------ | ----------------------- | ---------------------- |
| PATCH  | `/api/loans/{id}/return` | Mark a loan as returned | 200 OK / 404 Not Found |

---

# 🏭 Factories

Factories are used to generate **fake loan data** for testing and development.

Example:

```php
Loan::factory()->count(5)->create();
```

This will generate **5 fake loan records** with realistic data using Laravel's Faker library.

---

# 🌱 Seeders

Seeders populate the database with **initial or test data**.

Example command:

```bash
php artisan db:seed
```

Or run migrations with seeders:

```bash
php artisan migrate --seed
```

Seeders use the **LoanFactory** to automatically create sample records.

---

# ✅ Form Requests (Validation)

The API uses **Laravel Form Request classes** to validate incoming data before it reaches the controller.
This keeps controllers clean and centralizes validation logic.

Two request classes are used:

- `StoreLoanRequest`
- `UpdateLoanRequest`

---

## 📥 StoreLoanRequest

Used when **creating a new loan** (`POST /api/loans`).

### Validation Rules

| Field          | Rules                                      |
| -------------- | ------------------------------------------ |
| borrower_name  | required, string, max:255                  |
| borrower_email | required, email, max:255                   |
| book_title     | required, string, max:255                  |
| borrowed_at    | required, date                             |
| due_date       | required, date, after_or_equal:borrowed_at |

### Custom Validation Messages

| Rule                    | Message                                                     |
| ----------------------- | ----------------------------------------------------------- |
| borrower_name.required  | The borrower name is required                               |
| borrower_email.required | The borrower email is required                              |
| borrower_email.email    | The borrower email must be a valid email address            |
| book_title.required     | The book title is required                                  |
| borrowed_at.required    | The borrowed at date is required                            |
| borrowed_at.date        | The borrowed at date must be a valid date                   |
| due_date.required       | The due date is required                                    |
| due_date.date           | The due date must be a valid date                           |
| due_date.after_or_equal | The due date must be after or equal to the borrowed at date |

---

## 📤 UpdateLoanRequest

Used when **updating a loan** (`PUT /api/loans/{id}`).

All fields are optional but validated if present using `sometimes`.

### Validation Rules

| Field          | Rules                                                 |
| -------------- | ----------------------------------------------------- |
| borrower_name  | sometimes, required, string, max:255                  |
| borrower_email | sometimes, required, email, max:255                   |
| book_title     | sometimes, required, string, max:255                  |
| borrowed_at    | sometimes, required, date                             |
| due_date       | sometimes, required, date, after_or_equal:borrowed_at |
| returned       | sometimes, required, boolean                          |
| status         | sometimes, required, in:active,returned,overdue       |

---

💡 **Why use Form Requests?**

- Keeps controllers **clean and readable**
- Centralizes **validation logic**
- Allows **custom error messages**
- Makes the API easier to maintain

---

# 🏃 How to Run

1. Clone the repository

2. Install dependencies:

```bash
composer install
```

3. Set up `.env` file and configure database

4. Run migrations:

```bash
php artisan migrate
```

5. (Optional) Seed the database with sample data:

```bash
php artisan db:seed
```

6. Start the server:

```bash
php artisan serve
```

7. Test endpoints with **Postman** 🧪

---

# 📝 Notes

- All responses return JSON with `message` and `data`
- Validation is handled using **Form Requests**
- Seeders and factories make testing easier
- Non-existent loans return **404 Not Found**
- Fully tested with Postman, including CRUD operations and return endpoint ✅

---

# 📸 Screenshots

You can find all Postman tests in the **postman_tests** folder at the root of the project.
