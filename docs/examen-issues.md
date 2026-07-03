# 20 Issues de examen — proyecto_horarios

Banco de issues para examen práctico (~60 min cada una).  
Proyecto colaborativo Laravel 13 — gestor de horarios académicos.

## Enfoque

Cada issue tiene **2–3 tareas concretas** y criterios de aceptación claros.

| Bloque | Issues | Tipo |
|--------|--------|------|
| Fixes y cierre | #01–#10 | `fix` |
| CRUDs e integración | #11–#17 | `feat` |
| Validación y tests | #18–#20 | `feat` / `test` |

**Convención de títulos:** `[EXAMEN] <tipo>: <descripción>`

**Label en GitHub:** solo `FINAL` (todas las issues comparten el mismo label).

**Plantilla CRUD:** `app/Http/Controllers/SubjectController.php` + vistas en `resources/views/subjects/`.

## Formato de cada issue en GitHub

Así se ve una issue creada por el script (ejemplo #06):

---

**Título:** `[EXAMEN] fix: Botones exportar PDF y Excel`

**Labels:** `FINAL`

**Cuerpo (Markdown):**

```markdown
**Tipo:** `fix` | **Modulo:** UI | **Tiempo:** ~60 min

### Contexto
Issue de examen practico sobre **proyecto_horarios** (Laravel 13). Base: rama `main`.

### Tarea
1. Botones en saved_schedules/show.blade.php junto a Imprimir

### Criterios de aceptacion
- [ ] Descarga PDF del horario mostrado
- [ ] Descarga Excel del horario mostrado

### Referencia
- Documentacion: `docs/examen-issues.md`
- Patron CRUD: `app/Http/Controllers/SubjectController.php`
```

---

En la UI de GitHub el estudiante verá:
- **Título** con prefijo `[EXAMEN]` y el tipo (`fix`, `feat`, `test`) en el nombre
- **Label** rojo `FINAL` en la lista de issues
- **Checkboxes** interactivos en "Criterios de aceptacion" (puede marcarlos al entregar)
- **Secciones** Contexto → Tarea (numerada) → Criterios → Referencia

## Criterios de evaluación

| Criterio | Peso |
|----------|------|
| Cumple criterios de aceptación | 80% |
| Convenciones del proyecto + tests existentes pasan | 20% |

**Setup del estudiante:** rama `examen/<apellido>`, base `main`, entregar PR o capturas.

---

## FIXES — Terminar lo roto (#01–#10)

### #01 `fix` — Navegación rota

**Módulo:** nav | **Tiempo:** ~50 min

**Tareas:**
1. Corregir "Mis Horarios" → `route('saved-schedules.index')`
2. Añadir "Horario general" → `route('schedule.grid')`
3. Estado activo correcto en `resources/views/layouts/partials/nav.blade.php`

**Aceptación:**
- [ ] Sin 404 en el menú de navegación
- [ ] Ambos enlaces funcionan
- [ ] `composer run test` sin regresiones

**Archivos:** `resources/views/layouts/partials/nav.blade.php`

---

### #02 `fix` — Rutas duplicadas

**Módulo:** rutas | **Tiempo:** ~45 min

**Tareas:**
1. Quitar closure `GET /subjects` en `routes/web.php`
2. Quitar ruta Excel duplicada en `routes/api.php`

**Aceptación:**
- [ ] Una sola ruta `subjects.index`
- [ ] Una sola ruta `export/excel`
- [ ] `GET /subjects` lista desde `SubjectController@index`

**Archivos:** `routes/web.php`, `routes/api.php`

---

### #03 `fix` — API de aulas rota

**Módulo:** API | **Tiempo:** ~40 min

**Tareas:**
1. Añadir `use Illuminate\Validation\Rule;` en `app/Http/Controllers/ClassroomController.php`

**Aceptación:**
- [ ] `PUT /api/classrooms/{id}` con `codigo` duplicado devuelve 422
- [ ] No error 500 en update

**Archivos:** `app/Http/Controllers/ClassroomController.php`

---

### #04 `fix` — Auth en horarios guardados

**Módulo:** auth | **Tiempo:** ~50 min

**Tareas:**
1. Middleware `auth` en rutas `saved-schedules.*`
2. `currentUserId()` solo `Auth::id()` (quitar fallback demo)

**Aceptación:**
- [ ] Sin login redirige a `/login`
- [ ] Horario creado se asocia al usuario autenticado

**Archivos:** `routes/web.php`, `app/Http/Controllers/SavedScheduleController.php`

---

### #05 `fix` — Export Excel con especialidad null

**Módulo:** export | **Tiempo:** ~50 min

**Tareas:**
1. Null-safe en export: `$class->specialty?->nombre ?? 'N/A'`
2. Revisar plantilla PDF si aplica el mismo caso

**Aceptación:**
- [ ] Export no falla con clases sin `specialty_id`
- [ ] Columna especialidad muestra "N/A" cuando corresponde

**Archivos:** `app/Exports/ScheduleExport.php`, `resources/views/pdf/schedule.blade.php`

---

### #06 `fix` — Botones exportar PDF y Excel

**Módulo:** UI / export | **Tiempo:** ~45 min

**Tareas:**
1. Añadir botones en `resources/views/saved_schedules/show.blade.php` junto a "Imprimir"

**Aceptación:**
- [ ] Descarga PDF del horario mostrado
- [ ] Descarga Excel del horario mostrado

**Archivos:** `resources/views/saved_schedules/show.blade.php`

---

### #07 `fix` — Flashes duplicados y N+1 en auditoría

**Módulo:** UI | **Tiempo:** ~50 min

**Tareas:**
1. Quitar `session('success')` repetido en 4 vistas index (subjects, groups, semesters, saved_schedules)
2. `Audit::with('user')` en `AuditController@index`

**Aceptación:**
- [ ] Un solo mensaje flash tras crear/editar
- [ ] `/audits` carga sin N+1 en usuarios

**Archivos:** `app/Http/Controllers/AuditController.php`, vistas `*/index.blade.php`

---

### #08 `fix` — Perfil con Tailwind roto

**Módulo:** UI | **Tiempo:** ~45 min

**Tareas:**
1. Corregir clases inválidas en `profile/index.blade.php` y `profile/edit.blade.php`

**Aceptación:**
- [ ] Perfil se ve correctamente en navegador
- [ ] Sin clases inventadas (`olivw`, `bg-linear-to-r`, etc.)

**Archivos:** `resources/views/profile/`

---

### #09 `fix` — Login y logout en el header

**Módulo:** UI / auth | **Tiempo:** ~45 min

**Tareas:**
1. `@auth`: mostrar nombre y botón cerrar sesión (Fortify)
2. `@guest`: enlaces a login y registro

**Aceptación:**
- [ ] Logout funcional
- [ ] Invitado ve login y registro

**Archivos:** `resources/views/layouts/partials/header.blade.php`

---

### #10 `fix` — Rutas de desarrollo

**Módulo:** rutas | **Tiempo:** ~40 min

**Tareas:**
1. Eliminar `/hola` y `/home_layout` de `routes/web.php` (o condicionar a `APP_ENV=local`)

**Aceptación:**
- [ ] `php artisan route:list` sin rutas basura

**Archivos:** `routes/web.php`

---

## FEAT — CRUDs e integración (#11–#17)

### #11 `feat` — CRUD web de Docentes (básico)

**Módulo:** teachers | **Tiempo:** ~60 min

**Tareas:**
1. `TeacherController`: index, create, store, destroy
2. `StoreTeacherRequest` + vistas `teachers/index` y `teachers/create`
3. `Route::resource('teachers', ...)` + enlace en dashboard

**Aceptación:**
- [ ] Listar, crear y eliminar docentes
- [ ] Enlace "Ver detalles" del dashboard funciona

**Archivos:** `app/Http/Controllers/TeacherController.php`, `resources/views/teachers/`

---

### #12 `feat` — CRUD web de Aulas (listado y alta)

**Módulo:** classrooms | **Tiempo:** ~60 min

**Tareas:**
1. `ClassroomWebController` + vistas `classrooms/index` y `classrooms/create`
2. Validación `codigo` unique

**Aceptación:**
- [ ] Listar y crear aulas en `/classrooms`
- [ ] API `/api/classrooms` sigue operativa

**Archivos:** `app/Http/Controllers/`, `resources/views/classrooms/`

---

### #13 `feat` — Editar horario guardado

**Módulo:** saved-schedules | **Tiempo:** ~60 min

**Tareas:**
1. Quitar `->except(['edit','update'])` en rutas
2. Métodos `edit`/`update` + `UpdateSavedScheduleRequest` + vista `edit.blade.php`
3. Botón "Editar" en show

**Aceptación:**
- [ ] Se puede cambiar nombre y clases de un horario
- [ ] Checkboxes precargados con clases actuales

**Archivos:** `app/Http/Controllers/SavedScheduleController.php`, `resources/views/saved_schedules/`

---

### #14 `feat` — Prerrequisitos visibles en materia

**Módulo:** subjects | **Tiempo:** ~60 min

**Tareas:**
1. Tabla de prerrequisitos en `subjects/show`
2. Formulario para agregar (select + POST)
3. Botón eliminar por fila

**Aceptación:**
- [ ] Ver, agregar y quitar prerrequisitos desde la web
- [ ] Error visible si materia = prerrequisito de sí misma

**Archivos:** `app/Http/Controllers/SubjectController.php`, `resources/views/subjects/show.blade.php`

---

### #15 `feat` — Mejorar formulario "Armar horario"

**Módulo:** saved-schedules | **Tiempo:** ~55 min

**Tareas:**
1. Filtro por semestre (usar `$semesters` ya cargado en el controller)
2. Contador JS "X clases seleccionadas"
3. `required` en nombre y gestión

**Aceptación:**
- [ ] Filtro por semestre funciona
- [ ] Contador se actualiza al marcar checkboxes

**Archivos:** `resources/views/saved_schedules/create.blade.php`

---

### #16 `feat` — Días legibles en bloques horarios

**Módulo:** time-slots | **Tiempo:** ~50 min

**Tareas:**
1. Accessor `getDiaNombreAttribute()` en `app/Models/TimeSlot.php`
2. Usarlo en `time-slots/index.blade.php`

**Aceptación:**
- [ ] Tabla muestra Lunes…Domingo (con acentos)
- [ ] Ya no muestra números 1–7

**Archivos:** `app/Models/TimeSlot.php`, `resources/views/time-slots/index.blade.php`

---

### #17 `feat` — Solo el dueño accede a su horario

**Módulo:** auth | **Tiempo:** ~55 min

**Tareas:**
1. Comprobar `user_id` en `show`, `destroy` y `print`
2. Respuesta 403 si el horario pertenece a otro usuario

**Aceptación:**
- [ ] Usuario A no ve ni borra horario de usuario B
- [ ] Dueño accede con normalidad

**Archivos:** `app/Http/Controllers/SavedScheduleController.php`

---

## Validación y tests (#18–#20)

### #18 `feat` — Validar formato de gestión

**Módulo:** validación | **Tiempo:** ~45 min

**Tareas:**
1. Regex `^\d{4}-[12]$` en `StoreSavedScheduleRequest`
2. Placeholder `2026-1` en formulario create

**Aceptación:**
- [ ] `2026-1` y `2026-2` aceptados
- [ ] Texto libre rechazado con mensaje claro

**Archivos:** `app/Http/Requests/StoreSavedScheduleRequest.php`, `resources/views/saved_schedules/create.blade.php`

---

### #19 `feat` — Rechazar clases duplicadas al armar horario

**Módulo:** validación | **Tiempo:** ~40 min

**Tareas:**
1. Regla `distinct` en `available_class_ids.*`

**Aceptación:**
- [ ] Mismo ID dos veces produce error de validación
- [ ] Selección válida sigue guardándose

**Archivos:** `app/Http/Requests/StoreSavedScheduleRequest.php`

---

### #20 `test` — Test de solapamiento en horario guardado

**Módulo:** tests | **Tiempo:** ~60 min

**Tareas:**
1. Crear `tests/Feature/SavedScheduleOverlapTest.php`
2. Caso 1: dos clases mismo `time_slot_id` + `semester_id` → falla
3. Caso 2: clases en bloques distintos → pasa

**Aceptación:**
- [ ] `php artisan test --compact --filter=SavedScheduleOverlap` pasa
- [ ] Suite previa sin regresiones

**Archivos:** `tests/Feature/SavedScheduleOverlapTest.php`

---

## Resumen por tipo

| Tipo | Cantidad | Issues |
|------|----------|--------|
| `fix` | 10 | #01–#10 |
| `feat` | 9 | #11–#19 |
| `test` | 1 | #20 |

## Asignación sugerida

| Nivel | Issues |
|-------|--------|
| Entrada | #01–#04, #08, #09, #16, #18, #19 |
| Intermedio | #05–#07, #10, #13, #15, #17, #20 |
| CRUD | #11, #12, #14 |

**Evitar asignar juntas al mismo estudiante:** #04 + #17, #05 + #06, #11 + #12.

## Crear issues en GitHub

```powershell
cd C:\laragon\www\proyecto_horarios
gh auth login
.\scripts\create-exam-issues.ps1 -DryRun    # vista previa en consola
.\scripts\create-exam-issues.ps1            # crea las 20 con label FINAL
```

Filtrar en GitHub: `label:FINAL` o `is:issue label:FINAL`
