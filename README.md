# Takeya-skill-test– Post RESTful API
* Example Responses Login

![cp_login](https://raw.githubusercontent.com/chandrakarim/Takeya-skill-test/main/cp_login.png)

* Example Responses index

![cp_index_post](https://raw.githubusercontent.com/chandrakarim/Takeya-skill-test/main/cp_index_post.png)

* Example Responses create scheduled post

![cp_create_scheduled_post](https://raw.githubusercontent.com/chandrakarim/Takeya-skill-test/main/cp_create_scheduled_post.png)

* Database Snapshot

![cp_sqilite](https://raw.githubusercontent.com/chandrakarim/Takeya-skill-test/main/cp_sqilite.png)

## Takeya Skill Test – Post RESTful API (Laravel 12)

## Overview

This repository contains an implementation of the **Laravel Skill Test** for building
RESTful routes for a **Post** model.

The implementation focuses on:

- RESTful API design
- Draft, Scheduled, and Published post handling
- Session & cookie-based authentication
- Authorization using Laravel Policies
- JSON responses suitable for passing to views

All features are implemented following **Laravel 12 best practices** and the official
Laravel documentation.

---

## Specifications

### Framework & Environment

- Laravel 12
- PHP 8.4
- Database: SQLite
- Authentication: Laravel built-in session & cookies
- Token-based authentication (Sanctum / Passport) is not used
- View files are not required and intentionally omitted

---

## Post Status Logic

Post visibility is determined based on existing table structure and business rules:

- **Draft**
  - `is_draft = true`
  - Not publicly accessible

- **Scheduled**
  - `is_draft = false`
  - `published_at` is in the future
  - Automatically becomes visible when the publish date is reached
  - No cron job is required

- **Published (Active)**
  - `is_draft = false`
  - `published_at` is null or in the past

---

## Routes

| Route              | Method    | Description                                               |
| ------------------ | --------- | --------------------------------------------------------- |
| `/posts`           | GET       | Paginated list (20/page) of active posts with author data |
| `/posts/create`    | GET       | Auth-only, returns string `posts.create`                  |
| `/posts`           | POST      | Auth-only, create a new post                              |
| `/posts/{id}`      | GET       | Show active post, returns 404 if draft or scheduled       |
| `/posts/{id}/edit` | GET       | Author-only, returns string `posts.edit`                  |
| `/posts/{id}`      | PUT/PATCH | Author-only, update post                                  |
| `/posts/{id}`      | DELETE    | Author-only, delete post                                  |

### Response Format

- All endpoints return **JSON responses**, except:
  - `/posts/create`
  - `/posts/{id}/edit`

These two routes return plain strings as required by the specification.

---

## Authentication & Authorization

- Uses Laravel’s built-in **session & cookie-based authentication**
- Authorization is implemented using **PostPolicy**
- Only the post author is allowed to:
  - Edit a post
  - Update a post
  - Delete a post

---

## Database & Seeding

- Default database: **SQLite**
- Sample users and posts are provided via seeders

```bash
php artisan migrate --seed
```

- Setup Instructions
```bash
git clone https://github.com/chandrakarim/Takeya-skill-test.git
cd Takeya-skill-test
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
## Feature Tests

Feature tests are included to validate all required behaviors:

- Index returns only active posts

- Draft and scheduled posts return 404 on show

- Authenticated users can create posts

- Only post authors can update posts

- Only post authors can delete posts

Run all tests using:
```bash
php artisan test
```
All tests pass successfully.

## Notes for Reviewer

This project is API-focused; view files are intentionally omitted

Authorization rules are handled using Laravel Policies

Commit history is preserved with clear and meaningful messages

.env, vendor/, and node_modules/ are excluded from the repository

## Author

Chandra Karim
Repository: https://github.com/chandrakarim/Takeya-skill-test.git
