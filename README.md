# Takeya Skill Test – Post Routes (Laravel)

This repository contains the implementation of the Laravel Skill Test
for building RESTful routes for a Post model.

The project follows the instructions provided in the original skill test
repository and uses Laravel best practices.

---

## Specifications

- Laravel 12
- PHP 8.4
- SQLite database
- Session & cookie-based authentication
- Authorization using Laravel Policies
- View files are not required

---

## Post Visibility Rules

Posts are visible based on the following conditions:

- Draft posts (`is_draft = true`) are not publicly accessible
- Scheduled posts (`is_draft = false` and `published_at` in the future) are not visible
- Published posts (`is_draft = false` and `published_at` is null or in the past) are visible

No background jobs or cron tasks are used.

---

## Routes

| Route              | Method    | Description                                  |
|--------------------|-----------|----------------------------------------------|
| `/posts`           | GET       | List published posts (paginated)             |
| `/posts/create`    | GET       | Authenticated users only                     |
| `/posts`           | POST      | Create a new post                            |
| `/posts/{id}`      | GET       | Show a published post or return 404          |
| `/posts/{id}/edit` | GET       | Author only                                  |
| `/posts/{id}`      | PUT/PATCH | Update post (author only)                    |
| `/posts/{id}`      | DELETE    | Delete post (author only)                    |

---

## Authentication & Authorization

- Uses Laravel’s built-in session authentication
- Authorization is handled using a PostPolicy
- Only the post author may update or delete a post

---

## Database

- SQLite is used as the default database
- Sample users and posts are provided via seeders

```bash
php artisan migrate --seed
```
## Tests

Feature tests are included to validate:

Visibility rules for draft and scheduled posts

Authorization rules for updating and deleting posts

Access control for authenticated routes

Run tests with:
```bash
php artisan test
```
## Notes

View files are intentionally omitted

The project strictly follows the instructions from the skill test

## Author

Chandra Karim
Repository: https://github.com/chandrakarim/Takeya-skill-test.git