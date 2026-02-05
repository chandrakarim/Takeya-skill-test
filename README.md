# Takeya Skill Test – Post Routes (Laravel)

This repository contains the implementation of **Skill Test 1** for the Laravel Developer position.

The task is to implement RESTful routes for a **Post** model using Laravel 12 while following all requirements and best practices described in the original skill test repository.

The implementation strictly follows Laravel’s official documentation and the instructions listed in the skill test README.

---

## Specifications

- Laravel 12
- PHP 8.4
- SQLite database
- Session & cookie-based authentication (Laravel built-in)
- Authorization using Laravel Policies
- View files are not required

---

## Post Status & Visibility Rules

Posts are visible based on the following conditions:

- **Draft posts** (`is_draft = true`) are not publicly accessible
- **Scheduled posts** (`is_draft = false` and `published_at` in the future) are not visible
- **Published posts** (`is_draft = false` and `published_at` is null or in the past) are visible

Scheduled posts are automatically available when their publish date is reached.

No background jobs, cron tasks, or queues are used.

---

## Routes & Behavior

| Route | Method | Description |
|-------|---------|-------------|
| `/posts` | GET | Retrieve published posts as **JSON**, paginated **20 per page**, including author (user) data |
| `/posts/create` | GET | Authenticated users only, returns the string `"posts.create"` |
| `/posts` | POST | Authenticated users only, validate input and create a new post, returns appropriate JSON response |
| `/posts/{id}` | GET | Retrieve a single published post as **JSON**, return **404** if draft or scheduled |
| `/posts/{id}/edit` | GET | Author only, returns the string `"posts.edit"` |
| `/posts/{id}` | PUT/PATCH | Author only, validate input and update post, returns appropriate JSON response |
| `/posts/{id}` | DELETE | Author only, delete post, returns appropriate JSON response |

---

## Response Format

All **GET routes return JSON responses structured for passing to views**:

- `posts.index` → paginated JSON (20 per page) including author data
- `posts.show` → single post JSON or 404 if not accessible
- `posts.create` → returns string `"posts.create"`
- `posts.edit` → returns string `"posts.edit"`

POST, PUT/PATCH, and DELETE routes return appropriate JSON responses with proper HTTP status codes.

---

## Authentication & Authorization

- Uses Laravel’s built-in **session & cookie-based authentication**
- Token-based authentication systems (Sanctum, Passport, etc.) are not used
- Authorization is implemented using **PostPolicy**
- Only the post author may update or delete a post

---

## Database Setup

SQLite is used as the default database.

Sample users and posts are provided via seeders.

Run:

```bash
php artisan migrate --seed
```

---

## Testing

Feature tests are included to validate:

- Visibility rules for draft and scheduled posts
- Authorization rules for updating and deleting posts
- Access control for authenticated routes

Run tests:

```bash
php artisan test
```

---

## Notes

- View files are intentionally omitted as required by the skill test
- Implementation strictly follows all requirements listed in the original skill test README
- Routes are defined in `web.php` using session-based authentication

---

## Author

Chandra Karim  
Repository: https://github.com/chandrakarim/Takeya-skill-test.git
