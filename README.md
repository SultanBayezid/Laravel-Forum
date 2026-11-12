# Laravel Forum

A clean, minimalist **discussion forum** built with **Laravel 10** — posts, comments, email notifications, full-text search, email verification and automated old-post cleanup, all in a lightweight Blade + Bootstrap interface.

**Author & Maintainer:** [Sultan Bayezid](https://github.com/SultanBayezid) — Senior Full Stack Software Engineer, Bangladesh.

---

## Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [How It Works](#how-it-works)
- [Project Structure](#project-structure)
- [Scheduled Cleanup](#scheduled-cleanup)
- [Security Notes](#security-notes)
- [Contributing](#contributing)
- [License](#license)
- [Author](#author)

---

## Features

- **Post creation** — authenticated users create posts with a title (required) and optional text; posts are listed newest first.
- **Comments** — users comment on any post; comments are listed newest first on the post page.
- **Comment management** — authors can edit and delete their own comments.
- **Post management** — authors can edit or delete their own posts, but only while the post has no comments (keeps discussions immutable once started).
- **Email notifications** — the post owner receives an automatic email (`CommentNotification`) whenever someone comments on their post.
- **Search** — full-text search across post titles, post bodies and comment text.
- **Email verification** — only verified users can create posts or comments (`auth` + `verified` middleware).
- **Automated cleanup** — a scheduled command soft-deletes posts older than one year that received no recent comments.
- **Queued notifications** — notifications are queued by default; works out of the box with `QUEUE_CONNECTION=sync` and ready for `database` queue workers.
- **Authentication** — full Laravel UI scaffolding: login, registration, password reset, email verification.

## Technology Stack

| Layer | Technology |
| --- | --- |
| Back-end | PHP 8.1+, Laravel 10 |
| Front-end | Blade templates, Bootstrap 4/5, jQuery 3.6, Feather icons |
| Database | MySQL (configurable — Laravel supports SQLite / PostgreSQL / SQL Server) |
| Mail | Laravel Notifications (queued `CommentNotification`) |
| Auth | Laravel UI with email verification |

## Requirements

- PHP >= 8.1 with the usual Laravel extensions (`mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`)
- Composer
- MySQL (or another supported database)
- A mail server (or Mailpit / Mailtrap / Log driver) for notifications and verification emails

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/SultanBayezid/Laravel-Forum.git
cd Laravel-Forum

# 2. Install PHP dependencies
composer install

# 3. Prepare the environment file
cp .env.example .env
php artisan key:generate

# 4. Create the database and configure .env
#    (set DB_DATABASE, DB_USERNAME, DB_PASSWORD and MAIL_* settings)

# 5. Run migrations
php artisan migrate

# 6. Start the development server
php artisan serve
```

Register an account at `http://127.0.0.1:8000/register`, verify the email address, and start posting.

## Configuration

| What | Where |
| --- | --- |
| Database and mail settings | `.env` (see `.env.example`) |
| Email verification requirement | `routes/web.php` — the `auth` + `verified` middleware group |
| Queue driver | `.env` — `QUEUE_CONNECTION=sync` (immediate) or `database` (run `php artisan queue:work`) |
| Cleanup schedule | `app/Console/Kernel.php` — `posts:delete-old` runs daily |

## How It Works

1. **Public browsing** — anyone can read the post list (`/`) and any post page (`/posts/{id}`); posts are ordered by creation date, newest first.
2. **Participation gate** — creating posts, editing or commenting requires an authenticated **and email-verified** account.
3. **Commenting** — a comment is stored and `sendNotificationToPostOwner()` fires a queued `CommentNotification` mail to the post owner.
4. **Ownership rules** — edit/delete buttons only appear for the author; post editing and deletion are refused by the controller once a post has comments.
5. **Search** — `GET /search?search=...` matches the term against post titles, post text and comment text.
6. **Cleanup** — the `posts:delete-old` Artisan command (scheduled daily) soft-deletes posts created more than a year ago that have no comments from the last year. The `Post` model uses Laravel's `SoftDeletes` trait.

## Project Structure

```
app/
├── Console/Commands/DeleteOldPosts.php   # Scheduled soft-delete command
├── Http/Controllers/
│   ├── PostController.php                # List, show, create, edit, delete, search
│   ├── CommentController.php             # Store, update, destroy comments
│   └── Auth/                             # Laravel UI auth controllers
├── Models/
│   ├── Post.php                          # SoftDeletes, user/comments relations
│   ├── Comment.php                       # post/user relations + notification trigger
│   └── User.php                          # posts relation, verification
└── Notifications/CommentNotification.php # Queued mail to the post owner

database/migrations/                      # users, posts, comments, jobs tables
public/design/                            # Bootstrap, Feather icons, custom CSS/JS
resources/views/
├── layouts/app.blade.php                 # Navbar, search bar, auth menu
├── posts/                                # index, show, edit, search views
└── auth/                                 # login, register, verify, password views
routes/web.php                            # Public + auth+verified route groups
```

## Scheduled Cleanup

`app/Console/Kernel.php` registers:

```php
$schedule->command('posts:delete-old')->daily();
```

For production, make sure a single cron entry runs the scheduler:

```
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

## Security Notes

- Only verified users can write content; unverified users keep read-only access.
- Set `APP_DEBUG=false` and a real `APP_URL` in production.
- Configure real mail credentials so verification and notification emails deliver.
- Ownership checks are enforced server-side in `PostController` and `CommentController`, not just in the UI.

## Contributing

Contributions are welcome — please read [CONTRIBUTING.md](CONTRIBUTING.md).

## License

This project is open-sourced software licensed under the **MIT License** — see the [LICENSE](LICENSE) file for details. Copyright (c) 2026 Sultan Bayezid.

## Author

**Sultan Bayezid** — Senior Full Stack Software Engineer, Bangladesh

- Email: [sultanbayezidai@gmail.com](mailto:sultanbayezidai@gmail.com)
- Website: [https://lastlineweb.com](https://lastlineweb.com)
- GitHub: [https://github.com/SultanBayezid](https://github.com/SultanBayezid)
