# proyecto_horarios — Academic Schedule Manager

Laravel 13 + Blade + Tailwind CSS 4 + SQLite. Pest 4 for tests.

## Domain

- **AvailableClass** is the central pivot linking `subject`, `teacher`, `classroom`, `time_slot`, `semester`, `group`, and optional `specialty`.
- **SavedSchedule** = a user's personal schedule (many-to-many with `AvailableClass` via `class_selections` pivot).
- **User** has `name`, `lastname`, `email`, `password`, `rol` (enum: `admin`|`estudiante`).

## Key architecture

- **Schedule conflict detection** lives in `app/Http/Requests/StoreAvailableClassRequest.php` and `UpdateAvailableClassRequest.php` — in the `after()` validation hook, not in controllers.
- Unique DB constraints on `available_classes`: `(teacher_id, time_slot_id, semester_id)`, `(classroom_id, ...)`, `(group_id, ...)`.
- Grid display pattern: both `ScheduleController` and `SavedScheduleController` build `[$day][$hour]` grids from `timeSlot->dia_semana` / `timeSlot->hora_inicio`.
- `SavedScheduleController@currentUserId` has a demo fallback: `Auth::id() ?? User::query()->value('id')`.

## Auth (Fortify)

- Registration only. No password reset, no email verification, no 2FA.
- Email-based login, rate-limited to 5/min.

## Dev commands

| Action | Command |
|---|---|
| Dev server + queue + Vite | `composer run dev` |
| Run tests | `composer run test` |
| Run single test | `php artisan test --compact --filter=testName` |
| Full project setup | `composer run setup` |
| Format PHP | `vendor/bin/pint --format agent` |
| Vite build | `npm run build` |

Always run `vendor/bin/pint --format agent` before finalizing PHP changes.

## Routes

- **Web**: resources for `available-classes`, `semesters`, `specialties`, `time-slots` + auth group for profile.
- **API**: `apiResource` for `users` and `classrooms`.

## Testing notes

- Tests use `uses(Tests\TestCase::class, RefreshDatabase::class)` in feature files.
- SQLite `:memory:` in tests (see `phpunit.xml`).
- Main test suite: `tests/Feature/AvailableClassConflictTest.php`.

## MCP

Laravel Boost MCP server runs via `php artisan boost:mcp`. Prefer `search-docs`, `database-schema`, `database-query` over raw alternatives.

## Skills (activate when relevant)

- `fortify-development` — auth work
- `laravel-best-practices` — PHP / Eloquent / architecture
- `pest-testing` — writing or fixing tests
