# 🎨 Documentación del Frontend (SICI-ISI)

Este documento detalla la estructura, componentes y decisiones de diseño implementadas en la interfaz de usuario. El frontend ha sido construido sobre **Blade** y **Tailwind CSS**, respetando la arquitectura base de Laravel Breeze.

## 🛠 Stack Tecnológico
- **Motor de Plantillas:** Blade (Laravel)
- **Framework CSS:** Tailwind CSS (v3.x)
- **Assets Bundler:** Vite
- **Iconos:** Heroicons (SVG inline)
- **Fuentes:** Barlow, Inter, JetBrains Mono (Google Fonts)

---

## 📂 Estructura de Carpetas Clave

### 1. Componentes Reutilizables (`resources/views/components/`)
Hemos refactorizado el código monolítico en componentes modulares para facilitar el mantenimiento:

- `layout.blade.php`: **Master Layout**. Contiene el `<head>`, scripts de Vite, Navbar y Footer. Envuelve a todas las páginas públicas.
- `guest-layout.blade.php`: **Auth Layout**. Diseño limpio sin navegación, exclusivo para Login y Registro.
- `navbar.blade.php`: Barra de navegación con lógica de estado activo (`request()->routeIs(...)`).
- `footer.blade.php`: Pie de página estándar.

### 2. Páginas Públicas (`resources/views/`)
- `welcome.blade.php`: Landing Page principal.
- `about.blade.php`: Página "Sobre SICI-ISI".
- `publications.blade.php`: Listado de noticias (Grid Layout 2/3).
- `events.blade.php`: Listado de eventos con tarjetas uniformes.

### 3. Assets Estáticos (`public/images/`)
Todas las imágenes (logos, fondos, placeholders) se encuentran aquí para ser accesibles vía `asset()`.

---

## 🔐 Autenticación y Compatibilidad Backend

Se han modificado las vistas generadas por **Laravel Breeze** (`auth/login.blade.php` y `auth/register.blade.php`) para adaptarse al tema oscuro "SICI-Dark", pero **se ha mantenido estrictamente la compatibilidad funcional**.

### Cambios Importantes para el Backend:
1.  **Nombres de Inputs Intactos:** Se conservaron los atributos `name="email"`, `name="password"`, `name="name"`, etc. Los controladores de Breeze funcionarán sin cambios.
2.  **Manejo de Roles (Spatie):**
    - ⚠️ **Se eliminó el selector de "Rol"** del formulario de registro siguiendo las indicaciones de arquitectura.
    - **Razón:** La asignación de roles se manejará internamente en el Backend (Spatie Permission) o por defecto al crear el usuario, evitando errores por campos no esperados en el request.
3.  **Visualización de Errores:** Se implementaron los componentes `<x-input-error />` debajo de cada campo para reflejar las validaciones del servidor (ej. "Email ya registrado").

---

## 🎨 Sistema de Diseño (Tailwind Config)

Se extendió la configuración en `tailwind.config.js` con la paleta oficial del proyecto:

| Variable | Color Hex | Uso |
| :--- | :--- | :--- |
| `bg-sici-dark` | `#0B0E14` | Fondo Principal |
| `bg-sici-card` | `#1B2230` | Tarjetas / Paneles |
| `text-sici-red` | `#EF4444` | Acentos / Botones |
| `text-sici-light` | `#F3F4F6` | Texto Principal |

---

## 🚀 Cómo correr el Frontend

Para trabajar en los estilos y ver cambios en tiempo real (HMR), es **obligatorio** tener la terminal de Node corriendo:

```bash
# Usando Sail (Recomendado)
./vendor/bin/sail npm run dev