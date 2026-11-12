# Digital Bookstore

[![CI](https://github.com/Willian-Yudy-F/bookstore/actions/workflows/ci.yml/badge.svg)](https://github.com/Willian-Yudy-F/bookstore/actions/workflows/ci.yml)

An academic PHP and MySQL bookstore created by **Willian Yudy Futema and Luiza Miranda Gomes** for INT1059 Advanced Web at AIT Sydney.

The application demonstrates a traditional server-rendered web stack: visitors can browse and search a 20-book catalogue, while registered users can save favourites, write reviews and manage their account.

> The previous InfinityFree demo is no longer available. The old domain currently returns a DNS error, so local setup is the supported way to run the project.

## What the project demonstrates

- PHP sessions, registration and password hashing;
- MySQL relationships for users, books, reviews and favourites;
- prepared statements for user-controlled data;
- CSRF protection for every state-changing form;
- catalogue search and genre filtering;
- a responsive, server-rendered interface without a framework.

This is a learning project, not a production shop. It has no checkout, payment processing, email verification, automated browser tests or production deployment.

## Requirements

- PHP 8.2 or newer with the `mysqli` extension;
- MySQL 8 or MariaDB 10.4+;
- a web browser.

## Local setup

1. Clone the repository and enter the project directory.
2. Create an empty database named `advanced_web`.
3. Import `advanced_web.sql`. The dump includes the catalogue and empty user tables; it contains no personal accounts or password hashes.
4. Set the database environment variables. The defaults work with many local XAMPP installations:

```bash
export DB_HOST=127.0.0.1
export DB_USER=root
export DB_PASSWORD=''
export DB_NAME=advanced_web
```

5. Start the built-in PHP server:

```bash
php -S 127.0.0.1:8000
```

6. Open `http://127.0.0.1:8000/` and create a new local account.

For Apache or XAMPP, configure the same four variables in the server environment. Copying `.env.example` to `.env` alone does not load it automatically.

## Main files

```text
index.php             catalogue and genre filter
book.php              book details and reviews
search.php            title, author and description search
register.php          account creation
login.php             authentication
account.php           profile, password and review management
favorites.php         saved-book list
toggle_favorite.php   favourite mutation endpoint
security.php          CSRF helpers
db.php                environment-based database connection
advanced_web.sql      schema and 20-book sample catalogue
style.css             shared presentation
tests/                 repository security and structure checks
```

## Security choices

- Passwords use PHP's `password_hash()` and `password_verify()` APIs.
- Login regenerates the session ID.
- Database credentials are read from environment variables and `.env` is ignored.
- State-changing requests require a session-bound CSRF token.
- Registration and account updates use prepared statements and server-side validation.
- The public SQL dump excludes users, reviews, favourites, emails and password hashes.

Earlier Git history contained development account data. The current branch is sanitised, but repository history was not rewritten. Any password that was reused elsewhere should be changed.

## Checks

```bash
find . -name '*.php' -print0 | xargs -0 -n1 php -l
python3 -m unittest discover -s tests -v
```

CI runs the PHP syntax check and the repository tests on every push and pull request.

## Next improvements

- add integration tests against a temporary MySQL database;
- add rate limiting and email verification;
- move repeated page styles into the shared stylesheet;
- replace third-party book-cover files with licensed or original artwork;
- deploy a fresh demo only after secrets and production settings are configured.
