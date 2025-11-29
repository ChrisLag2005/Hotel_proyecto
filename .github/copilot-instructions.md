<!-- .github/copilot-instructions.md - guidance for AI coding agents in this repository -->
# Copilot instructions for Hotel_proyecto (Laravel)

Keep suggestions focused, minimal, and compatible with the project's current Laravel 12 structure.

- Purpose: this is a small hotel reservation Laravel app following a conventional MVC + Eloquent pattern. Key models live in `app/Models` (e.g. `Habitacion`, `Reservacion`, `Cliente`, `Servicio`, `User`). Controllers are in `app/Http/Controllers` and policies in `app/Policies`.

- Architecture notes:
  - Standard Laravel MVC. Eloquent model relationships and pivot tables are used (see `database/migrations` and `database/seeders/HabitacionServicioSeeder.php`).
  - Authorization uses Policies (`app/Policies/*Policy.php`) — prefer policy methods for permission checks.
  - Background processing / queues may be exercised by dev scripts (`composer run dev` runs `php artisan queue:listen`).

- Developer workflows (explicit commands):
  - Full setup (recommended): `composer run setup` (runs composer install, copies `.env`, generates key, runs migrations, and builds frontend assets). On Windows with PowerShell you can run: `composer run setup`.
  - Dev (concurrent services): `composer run dev` — runs `php artisan serve`, queue listener, logs watcher, and frontend dev tooling.
  - Run tests: `composer run test` or `php artisan test` (the `test` script clears config and runs the test suite). Use `vendor\bin\phpunit` if you need raw PHPUnit on Windows.
  - Run migrations + seeds: `php artisan migrate --seed` or targeted seeder: `php artisan db:seed --class=ReservacionSeeder`.
  - Storage link (images): run `php artisan storage:link` when working with uploaded images.

- Project-specific patterns & conventions to follow when changing code:
  - Use existing Eloquent relationships and update both the model (`app/Models/*.php`) and corresponding migration when adding fields.
  - When adding controller actions, maintain RESTful routes (see `routes/web.php` and `routes/auth.php`) and use route-model binding where appropriate.
  - Authorization should use policies (see `app/Policies/HabitacionPolicy.php`, `ReservacionPolicy.php`). Add policy checks in controllers via `$this->authorize()` or `authorizeResource`.
  - Factories and seeders are present for test data (`database/factories`, `database/seeders`) — prefer using factories in tests.

- Files and locations worth checking for context:
  - Models: `app/Models/*.php`
  - Controllers: `app/Http/Controllers/*.php` (e.g., `ReservacionController.php`)
  - Policies: `app/Policies/*.php`
  - Migrations: `database/migrations/` (note pivot table `create_habitacion_servicio_table.php`)
  - Seeders & Factories: `database/seeders/` and `database/factories/`
  - Routes: `routes/web.php`, `routes/auth.php`
  - Frontend assets: `package.json`, `vite.config.js`, `resources/js`, `resources/css`

- Integration points / external dependencies:
  - PHP >= 8.2, Laravel 12 (see `composer.json`).
  - Frontend tooling: Node / npm for building assets; `npm run build` or `npm run dev` available.
  - Database: configured via `.env` — the Composer `post-create-project-cmd` touches `database/database.sqlite` for convenience, but developers may use MySQL (Laragon) or sqlite locally.

- Tips for edits & PRs from AI agents:
  - Keep changes minimal and focused to a single logical intent (model change, migration, controller update). When adding a model field also add a migration and update factory/seeders if applicable.
  - Do not modify framework-level or unrelated files (composer.lock, vendor/*).
  - When suggesting CLI instructions include exact commands and note Windows/PowerShell differences (use backslash paths or composer scripts rather than POSIX-only commands).

- If anything here is unclear or you want me to expand sections (e.g., specific controller patterns or test examples), tell me which area to iterate on.
