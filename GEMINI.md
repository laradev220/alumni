# AlumniConnect - Project Overview

AlumniConnect is a web-based platform built with **Laravel 12** and **Livewire 4**, designed to facilitate networking, event management, and fundraising for university alumni communities. It features role-based access control, real-time updates via **Laravel Reverb**, and a transparent donation system.

## Core Technologies
- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Livewire 4, Alpine.js, Tailwind CSS 4 (Vite)
- **Database:** PostgreSQL/MySQL (Eloquent ORM)
- **Authentication/Roles:** Laravel Breeze, Spatie Laravel Permission
- **Real-time:** Laravel Reverb

## Architecture & Conventions
- **Models:** Primary models include `User`, `AlumniProfile`, `Event`, `Campaign`, `Donation`, and `JobPost`.
- **Profiles:** `User` and `AlumniProfile` have a 1:1 relationship.
- **Roles:** Defined in `RoleSeeder` (`admin`, `alumni`, `student`).
- **Reactivity:** Heavily utilizes Livewire components for dynamic UI (e.g., `Alumni/Directory`, `Alumni/ProfileEdit`).
- **Coding Style:** Follows standard Laravel PSR-12/PER conventions. Uses **Laravel Pint** for linting.

## Building and Running

### Development Environment
- **Server:** `php artisan serve`
- **Frontend/Vite:** `npm run dev`
- **Queue/Background Jobs:** `php artisan queue:listen`
- **Real-time/Reverb:** `php artisan reverb:start`

### Unified Dev Command
A custom `composer dev` command is available that runs the server, queue, logs, and vite concurrently:
```bash
composer dev
```

### Initial Setup
To set up a fresh installation:
```bash
composer setup
```
This command installs PHP/JS dependencies, generates keys, runs migrations, and builds assets.

### Testing
```bash
php artisan test
# or
composer test
```

## Key Files & Directories
- `app/Models/`: Core domain logic and relationships.
- `app/Livewire/`: Interactive UI components.
- `routes/web.php`: Primary web routes and role-based middleware groups.
- `database/migrations/`: Schema definitions for profiles, events, campaigns, and donations.
- `PRD.md`: Detailed Product Requirements Document (MVP specification).

## Development Guidelines
- **Roles:** Always use `HasRoles` trait on the `User` model and check roles via `$user->hasRole('alumni')` or middleware.
- **Profiles:** Ensure `AlumniProfile` is created or retrieved via `$user->alumniProfile`.
- **Formatting:** Run `./vendor/bin/pint` before committing code.
