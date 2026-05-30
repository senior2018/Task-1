# Task 1 — Three Beginner PHP Exercises

Three small exercises, each in its own folder. Open them with the PHP
built-in server. **Use a different port from your other project**
(your main Student Management System might be on 8000):

```bash
cd "/Users/senior/Dev/PHP/Task 1"
php -S localhost:8080
```

Then open the URLs below in your browser.

---

## Exercise 1 — Simple Webpage (HTML + CSS)

**Folder:** `exercise1_webpage/`

A static page with a heading, a paragraph about the course, and CSS styling.

**Open:** <http://localhost:8080/exercise1_webpage/index.html>

Files:
- `index.html` — the page structure
- `style.css` — colours, fonts, layout

---

## Exercise 2 — Greeting Script (PHP input)

**Folder:** `exercise2_greeting/`

Asks for your name, then displays `Hello, [name]!`.

**Open:** <http://localhost:8080/exercise2_greeting/index.php>

Files:
- `index.php` — form + PHP that builds the greeting

---

## Exercise 3 — Login System (PHP + MySQL)

**Folder:** `exercise3_login/`

A registration + login system. Users register with a username and
password; the password is hashed (never stored as plain text) and saved
in MySQL. Logging in starts a session and unlocks a private welcome page.

### Setup (do this ONCE)

1. Open `exercise3_login/db.php` in VS Code and change the `$DB_PASS`
   line to your real MySQL password.
2. Open `exercise3_login/setup.php` and change the same `$DB_PASS` line
   in there too (they must match).
3. Start the PHP server (if it isn't running):
   ```bash
   cd "/Users/senior/Dev/PHP/Task 1"
   php -S localhost:8080
   ```
4. Visit <http://localhost:8080/exercise3_login/setup.php> in your
   browser. You should see "Setup complete!" — this creates the `task1`
   database and the `users` table.
5. **Delete** `setup.php` after it succeeds.

### Use it

- Register: <http://localhost:8080/exercise3_login/register.php>
- Login:    <http://localhost:8080/exercise3_login/login.php>
- Welcome:  <http://localhost:8080/exercise3_login/welcome.php> (only after login)
- Logout:   <http://localhost:8080/exercise3_login/logout.php>

### Files

- `db.php` — connects to MySQL using PDO
- `setup.php` — one-time script: creates the database and `users` table
- `register.php` — form + PHP to create a new account
- `login.php` — form + PHP to log in and start a session
- `welcome.php` — private page (redirects to login if you're not logged in)
- `logout.php` — destroys the session
- `style.css` — shared styling for all the login pages

### Security points covered

- **Password hashing** with `password_hash()` / `password_verify()` —
  passwords are never stored as plain text.
- **Prepared statements** with PDO — prevents SQL injection.
- **Output escaping** with `htmlspecialchars()` — prevents XSS attacks.
- **Sessions** — `welcome.php` is only accessible when logged in.
