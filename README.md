
> _This folder holds Princess's part of the project (Frontend → Hero Pages)._
> Owned/authored here: `css/style.css`, `includes/header.php`, `includes/footer.php`,
> `js/validation.js`, `index.php`, `hero.php`.
> `config/db.php` and `includes/auth.php` are present only as **required dependencies**
> (Sadia's work) so `index.php`/`hero.php` can actually run — not authored in this folder.
> Sadia's and Tooshar's other files (login/register/logout, add/edit/delete hero,
> database.sql) were moved to `_not-my-scope/` for local reference only — delete that
> folder before the final merge, it should not be part of this repo's history.

---

# Xavier's Roster — X-Men Hero CRUD App

A PHP + MySQL CRUD web application for managing hero records, built for
Professor Xavier's team management scenario.

## Features

- **Public**: view the full list of heroes, view individual hero detail pages.
- **Authenticated**: add, edit, and delete heroes.
- Login, logout, and registration with hashed passwords (`password_hash` / `password_verify`).
- Session-based authentication (`$_SESSION`).
- Client-side validation (JavaScript) + server-side validation (PHP) on all forms.
- All database queries use PDO prepared statements to prevent SQL injection.
- All output is escaped with `htmlspecialchars()` to prevent XSS.

## Tech Stack

- HTML5 / CSS3
- Vanilla JavaScript (form validation)
- PHP 8+ (PDO for MySQL access)
- MySQL / MariaDB

## Folder Structure

```
xmen-crud/
├── config/
│   └── db.php          # Database connection (PDO)
├── includes/
│   ├── auth.php         # isLoggedIn() / requireLogin() helpers
│   ├── header.php       # Shared header + nav
│   └── footer.php       # Shared footer
├── css/
│   └── style.css
├── js/
│   └── validation.js
├── index.php            # Public: list all heroes
├── hero.php             # Public: hero detail page
├── login.php            # Login form + handling
├── register.php         # Registration form + handling
├── logout.php           # Destroys session
├── add_hero.php         # Auth only: create hero
├── edit_hero.php        # Auth only: update hero
├── delete_hero.php      # Auth only: delete hero (POST only)
├── database.sql         # Schema + sample X-Men data
└── README.md
```

## Setup Instructions (Local Environment, e.g. XAMPP / MAMP)

1. **Install a local server stack** such as XAMPP, MAMP, or WampServer
   (Apache + PHP + MySQL).

2. **Copy the project folder** (`xmen-crud/`) into your server's web root:
   - XAMPP (Windows): `C:\xampp\htdocs\xmen-crud`
   - XAMPP (Mac): `/Applications/XAMPP/htdocs/xmen-crud`
   - MAMP: `/Applications/MAMP/htdocs/xmen-crud`

3. **Start Apache and MySQL** from your control panel.

4. **Create the database**:
   - Open phpMyAdmin (usually `http://localhost/phpmyadmin`).
   - Click **Import**, select `database.sql`, and run it.
   - This creates the `xmen_db` database with the `heroes` and `users`
     tables, plus sample X-Men records and one sample login.

5. **Configure the database connection** in `config/db.php` if your
   MySQL username/password differ from the defaults (`root` / empty
   password is typical for XAMPP/MAMP).

6. **Open the app** in your browser:
   ```
   http://localhost/xmen-crud/
   ```

7. **Log in** with the demo account to test the authenticated features:
   - Username: `professorx`
   - Password: `xavier123`

   Or click **Register** to create your own account.

## Notes

- Anyone can view the hero list and hero details without logging in.
- Only logged-in users see the **Add Hero** link and the **Edit /
  Delete** buttons on hero detail pages.
- `edit_hero.php`, `add_hero.php`, and `delete_hero.php` all call
  `requireLogin()`, which redirects to `login.php` if there is no
  active session — so these pages are protected even if someone
  navigates to the URL directly.

