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

### Example JSON Responses
- GET /posts
~~~
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "title": "First Post",
      "content": "This is the first post",
      "is_draft": false,
      "published_at": "2026-01-19T10:00:00.000000Z",
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.com"
      }
    },
    {
      "id": 2,
      "title": "Second Post",
      "content": "Another published post",
      "is_draft": false,
      "published_at": null,
      "user": {
        "id": 2,
        "name": "John Doe",
        "email": "john@example.com"
      }
    }
  ],
  "per_page": 20,
  "total": 2
}
~~~
- GET /posts/{id}
~~~
{
    "id": 118,
    "user_id": 1,
    "title": "First Post",
    "content": "Content here",
    "is_draft": false,
    "published_at": null,
    "created_at": "2026-01-19T12:02:32.000000Z",
    "updated_at": "2026-01-19T12:02:32.000000Z",
    "user": {
        "id": 1,
        "name": "Test User",
        "email": "test@example.com",
        "email_verified_at": "2025-11-27T05:22:51.000000Z",
        "created_at": "2025-11-27T05:22:52.000000Z",
        "updated_at": "2025-11-27T05:22:52.000000Z"
    }
~~~
- POST /store
~~~
{
    "title": "First Post",
    "content": "Content here",
    "is_draft": false,
    "published_at": null,
    "user_id": 1,
    "updated_at": "2026-01-19T12:02:32.000000Z",
    "created_at": "2026-01-19T12:02:32.000000Z",
    "id": 118
}
~~~
- PUT /update
~~~
{
    "id": 116,
    "user_id": 1,
    "title": "Hallo Januari Hari Senin 19/01/2026",
    "content": "Updated content",
    "is_draft": false,
    "published_at": null,
    "created_at": "2026-01-19T08:53:23.000000Z",
    "updated_at": "2026-01-19T09:02:24.000000Z"
}
~~~
- DELETE /destroy
~~~
{
    "message": "Post deleted"
}
~~~
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
