# Guía de examen — proyecto_horarios

**Entrega:** PR abierto antes de las **9:45**

Repo: https://github.com/backend-01-2026/proyecto_horarios  
Issues: https://github.com/backend-01-2026/proyecto_horarios/issues?q=label%3AFINAL

---

## Qué hacer

### 1. Autoasígnate una issue

- Abre las issues con label **`FINAL`**.
- Elige una **sin asignar**.
- Asígnate en GitHub y comenta: `Tomo esta tarea — [Tu nombre]`.
- Una issue por estudiante.

### 2. Crea tu rama

Nombre según el tipo de tu issue:

| Tipo issue | Rama |
|------------|------|
| `fix` | `fix/descripcion-corta` |
| `feat` | `feature/descripcion-corta` |
| `test` | `feature/descripcion-corta` |

Ejemplos: `fix/navegacion-rota` · `feature/crud-docentes` · `fix/export-excel`

Base: **`main`**.

### 3. Trabaja solo lo que pide la issue

- Lee **Tarea** y **Criterios de aceptación** en la issue.
- No agregues nada fuera de alcance.
- `composer run test` debe pasar.

### 4. Abre tu PR

- Rama → **`main`**
- **Antes de las 9:45**
- Título: `[EXAMEN] #N - titulo de la issue`
- En la descripción: número de issue, tu nombre, y marca los criterios de aceptación.

---

## Checklist

- [ ] Issue autoasignada
- [ ] Rama `fix/...` o `feature/...`
- [ ] Solo lo pedido en la issue
- [ ] PR a `main` antes de las **9:45**

---

## Calificación

| Criterio | Peso |
|----------|------|
| Criterios de aceptación de la issue | 80% |
| Convenciones del proyecto + tests OK | 20% |