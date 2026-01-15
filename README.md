## Example Responses Login
![cp_login](https://raw.githubusercontent.com/chandrakarim/Takeya-skill-test/main/cp_login.png)

## Example Responses index
![cp_index_post](https://raw.githubusercontent.com/chandrakarim/Takeya-skill-test/main/cp_index_post.png)

## Example Responses create scheduled post
![cp_create_scheduled_post](https://raw.githubusercontent.com/chandrakarim/Takeya-skill-test/main/cp_create_scheduled_post.png)

## Database Snapshot
![cp_sqilite](https://raw.githubusercontent.com/chandrakarim/Takeya-skill-test/main/cp_sqilite.png)

# Takeya-skill-test– Post RESTful API

## Overview

This repository contains a **Takeya-skill-test** implementation focusing on:

* RESTful Post API
* Draft, Scheduled, and Published posts
* Session & cookie-based authentication
* Authorization (only post authors can update/delete)
* JSON responses suitable for views

The implementation follows **Laravel 12 best practices** and the official documentation.

---

## Requirements Summary

### Post Status

Posts are classified as:

* **Draft** → not visible publicly
* **Scheduled** → visible only after `published_at`
* **Published** → visible immediately

No cron job is required. Scheduled posts become active automatically based on time comparison.

---

## Authentication

* Uses **Laravel built-in session & cookie authentication**
* Token-based authentication (Sanctum / Passport) is **not used**

---

## API Routes

| Route              | Method    | Description                                               |
| ------------------ | --------- | --------------------------------------------------------- |
| `/posts`           | GET       | Paginated list (20/page) of active posts with author data |
| `/posts/create`    | GET       | Auth-only, returns `posts.create`                         |
| `/posts`           | POST      | Auth-only, create new post                                |
| `/posts/{id}`      | GET       | Show active post, 404 if draft/scheduled                  |
| `/posts/{id}/edit` | GET       | Author-only, returns `posts.edit`                         |
| `/posts/{id}`      | PUT/PATCH | Author-only, update post                                  |
| `/posts/{id}`      | DELETE    | Author-only, delete post                                  |

All responses are returned in **JSON format**, except `create` and `edit` routes which return plain strings as required.

---

## Database

* Default database: **SQLite**
* Sample users and posts are provided via seeder

```bash
php artisan migrate --seed
```

---

## Setup Instructions

```bash
git clone https://github.com/chandrakarim/Takeya-skill-test.git
cd Takeya-skill-test
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## Feature Tests

Feature tests are included to verify:

* Index shows only active posts
* Draft & scheduled posts return 404 on show
* Authenticated users can create posts
* Only post authors can update or delete posts

Run tests using:

```bash
php artisan test
```

---

## Notes for Reviewer

* View files are intentionally omitted (API-focused)
* `.env`, `vendor/`, and `node_modules/` are excluded from repository
* Commit history is preserved and uses meaningful messages

---

## Author

**Chandra Karim**
Repository: [https://github.com/chandrakarim/Takeya-skill-test.git](https://github.com/chandrakarim/Takeya-skill-test.git)
