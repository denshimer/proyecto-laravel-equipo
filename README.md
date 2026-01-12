# Proyecto Web Laravel (Equipo de Desarrollo para la Hackaton)

Este proyecto utiliza **Laravel Sail** (Docker) para garantizar que todos los desarrolladores trabajen exactamente en el mismo entorno, sin importar si usan Windows, Mac o Linux.

---

## 📋 Requisitos Previos

Antes de empezar, asegúrate de tener instalado:

1. **Docker Desktop** (versión 20.10 o superior) - **Debe estar corriendo**
2. **Git** (para clonar el repositorio)
3. **WSL2** (Solo Windows - se instala automáticamente con Docker Desktop)
4. **Git Bash** (Recomendado para Windows - viene con Git)

> [!TIP]
> **Para usuarios de Windows**: Usa **Git Bash** para ejecutar todos los comandos de este README. Los comandos están optimizados para funcionar en Git Bash.

---

## � Instalación e Inicio (Setup Completo)

Sigue estos pasos **estrictamente** la primera vez que descargues el proyecto:

### 1. Clonar el repositorio

```bash
git clone https://github.com/TU_USUARIO/TU_REPO.git
cd nombre-de-la-carpeta
```

### 2. Configurar variables de entorno

Crea tu archivo de configuración local copiando el ejemplo:

```bash
cp .env.example .env
```

> [!NOTE]
> El archivo `.env` ya viene configurado para usar MySQL con Docker. No necesitas modificar nada a menos que quieras cambiar puertos o credenciales.

### 3. Instalar dependencias de PHP (Composer)

Como probablemente no tengas PHP/Composer instalado en tu máquina local, usaremos un contenedor temporal para descargar las librerías del proyecto:

**Para Git Bash (Windows) / Linux / Mac:**
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs
```

> [!IMPORTANT]
> Este paso es **crítico**. Si no lo ejecutas, el proyecto no funcionará.

### 4. Levantar los contenedores de Docker

Ahora que ya tenemos las librerías de PHP, iniciamos todos los servicios con Sail:

```bash
./vendor/bin/sail up -d
```

Esto iniciará:
- ✅ Laravel (Puerto 80)
- ✅ MySQL (Puerto 3306)
- ✅ Redis (Puerto 6379)
- ✅ Meilisearch (Puerto 7700)
- ✅ Mailpit (Puerto 8025)

### 5. Generar clave de aplicación

```bash
./vendor/bin/sail artisan key:generate
```

### 6. Ejecutar migraciones de base de datos

```bash
./vendor/bin/sail artisan migrate
```

### 7. Instalar dependencias de Node.js

```bash
./vendor/bin/sail npm install
```

### 8. Iniciar el servidor de desarrollo Vite

**Importante**: Vite es necesario para que los assets (CSS/JS) funcionen correctamente.

```bash
./vendor/bin/sail npm run dev
```

> [!TIP]
> Deja esta terminal abierta. Vite debe estar corriendo mientras desarrollas para que los cambios en CSS/JS se reflejen automáticamente.

---

## 🌐 Acceder a la Aplicación

Una vez completados todos los pasos:

- **Aplicación Principal**: [http://localhost](http://localhost)
- **Login**: [http://localhost/login](http://localhost/login)
- **Registro**: [http://localhost/register](http://localhost/register)
- **Dashboard**: [http://localhost/dashboard](http://localhost/dashboard) (requiere autenticación)
- **Mailpit** (emails de prueba): [http://localhost:8025](http://localhost:8025)

---

## 🔐 Autenticación (Laravel Breeze)

El proyecto incluye **Laravel Breeze** para autenticación. Rutas disponibles:

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/login` | Iniciar sesión | Público |
| `/register` | Registrar nuevo usuario | Público |
| `/dashboard` | Panel principal | Requiere login |
| `/profile` | Editar perfil | Requiere login |
| `/forgot-password` | Recuperar contraseña | Público |
| `/logout` | Cerrar sesión | Requiere login (POST) |

### Crear un usuario de prueba

Puedes registrarte manualmente en `/register` o usar Tinker:

```bash
./vendor/bin/sail artisan tinker
```

Luego ejecuta:
```php
User::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password')
]);
```

---

## 🎨 Desarrollo con Vite

### Modo Desarrollo (Hot Module Replacement)

Mientras desarrollas, **siempre** debes tener Vite corriendo:

```bash
./vendor/bin/sail npm run dev
```

Esto permite que los cambios en archivos CSS/JS se reflejen automáticamente en el navegador sin recargar la página.

### Compilar para Producción

Cuando estés listo para desplegar:

```bash
./vendor/bin/sail npm run build
```

---

## 🤝 Flujo de Trabajo (Git Workflow)

Para mantener el orden y evitar romper el código, utilizamos la siguiente estrategia de ramas.

### Las Ramas Principales

- 🛡️ **main (Producción)**: Es la rama sagrada. El código aquí SIEMPRE funciona. Está protegida: No se puede hacer push directo. Solo recibe cambios mediante Pull Request aprobados desde `develop`.
- 🛠️ **develop (Desarrollo)**: Aquí integramos el trabajo de todos. Es nuestra rama base para trabajar.

### Cómo trabajar en una nueva tarea (Features)

Cada vez que vayas a arreglar un bug o crear una función nueva:

1. **Actualízate**: Baja siempre lo último de develop.
   ```bash
   git checkout develop
   git pull origin develop
   ```

2. **Crea tu rama**: Usa el prefijo `feature/`.
   ```bash
   git checkout -b feature/nombre-de-la-tarea
   ```

3. **Trabaja y Guarda**: Haz tus commits normales.
   ```bash
   git add .
   git commit -m "Descripción clara de los cambios"
   ```

4. **Publica**: Sube tu rama a GitHub.
   ```bash
   git push origin feature/nombre-de-la-tarea
   ```

5. **Solicita Fusión (Pull Request)**:
   - Ve a GitHub y abre un Pull Request de tu rama hacia `develop`.
   - Avisa al equipo para que revisen tu código.
   - Una vez aprobado, se fusionará.

---

## 🐳 Comandos de Docker (Sail) - Cheatsheet

Como usamos Sail, **no ejecutes** `php artisan`, `composer` o `npm` directamente en tu consola. Usa estos comandos:

### Comandos Básicos

| Acción | Comando |
|--------|---------|
| **Iniciar servidor** | `./vendor/bin/sail up -d` |
| **Detener servidor** | `./vendor/bin/sail stop` |
| **Reiniciar servidor** | `./vendor/bin/sail restart` |
| **Ver logs en tiempo real** | `./vendor/bin/sail logs -f` |
| **Entrar al contenedor** | `./vendor/bin/sail shell` |

### Comandos de Laravel

| Acción | Comando |
|--------|---------|
| **Ejecutar Artisan** | `./vendor/bin/sail artisan [comando]` |
| **Ejecutar migraciones** | `./vendor/bin/sail artisan migrate` |
| **Limpiar caché** | `./vendor/bin/sail artisan cache:clear` |
| **Ver rutas** | `./vendor/bin/sail artisan route:list` |
| **Crear controlador** | `./vendor/bin/sail artisan make:controller NombreController` |
| **Crear modelo** | `./vendor/bin/sail artisan make:model NombreModelo -m` |

### Comandos de Composer

| Acción | Comando |
|--------|---------|
| **Instalar paquete** | `./vendor/bin/sail composer require [paquete]` |
| **Actualizar dependencias** | `./vendor/bin/sail composer update` |

### Comandos de Node.js / NPM

| Acción | Comando |
|--------|---------|
| **Instalar dependencias** | `./vendor/bin/sail npm install` |
| **Iniciar Vite (dev)** | `./vendor/bin/sail npm run dev` |
| **Compilar assets** | `./vendor/bin/sail npm run build` |
| **Instalar paquete** | `./vendor/bin/sail npm install [paquete]` |

### Comandos de Base de Datos

| Acción | Comando |
|--------|---------|
| **Acceder a MySQL** | `./vendor/bin/sail mysql` |
| **Ejecutar migraciones** | `./vendor/bin/sail artisan migrate` |
| **Revertir migraciones** | `./vendor/bin/sail artisan migrate:rollback` |
| **Resetear BD** | `./vendor/bin/sail artisan migrate:fresh` |
| **Seeders** | `./vendor/bin/sail artisan db:seed` |

> [!TIP]
> **Tip Pro**: Para escribir menos, crea un alias en tu terminal:
> 
> **Git Bash (Windows):**
> ```bash
> echo "alias sail='./vendor/bin/sail'" >> ~/.bashrc
> source ~/.bashrc
> ```
> 
> **Linux/Mac:**
> ```bash
> echo "alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'" >> ~/.bashrc
> source ~/.bashrc
> ```
> 
> Así solo escribirás `sail up`, `sail artisan migrate`, etc.

---

## 📡 Puertos Utilizados

El proyecto usa los siguientes puertos en `localhost`:

| Servicio | Puerto | URL |
|----------|--------|-----|
| **Laravel** | 80 | http://localhost |
| **Vite Dev Server** | 5173 | http://localhost:5173 |
| **MySQL** | 3306 | localhost:3306 |
| **Redis** | 6379 | localhost:6379 |
| **Meilisearch** | 7700 | http://localhost:7700 |
| **Mailpit** | 8025 | http://localhost:8025 |

> [!WARNING]
> Si alguno de estos puertos ya está en uso en tu máquina, Docker no podrá iniciar. Cierra las aplicaciones que estén usando estos puertos o modifica los puertos en el archivo `.env`.

---

## ⚠️ Solución de Problemas Comunes

### 1. Error: "Failed opening required vendor/autoload.php"

**Causa**: No se instalaron las dependencias de PHP.

**Solución**:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs

./vendor/bin/sail restart
```

### 2. La página se ve sin estilos (CSS no carga)

**Causa**: Vite no está corriendo.

**Solución**:
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

> [!NOTE]
> Vite **debe estar corriendo** mientras desarrollas. Deja la terminal abierta.

### 3. Error: "Route [login] not defined"

**Causa**: Las rutas de autenticación no están registradas.

**Solución**: Verifica que el archivo `routes/auth.php` existe y que `routes/web.php` contiene:
```php
require __DIR__.'/auth.php';
```

### 4. Error: "Permission denied" en storage/

**Causa**: Problemas de permisos en carpetas de caché.

**Solución**:
```bash
./vendor/bin/sail exec laravel.test chmod -R 777 storage bootstrap/cache
```

### 5. Error: Base de datos vacía / Tabla no existe

**Causa**: No se ejecutaron las migraciones.

**Solución**:
```bash
./vendor/bin/sail artisan migrate
```

### 6. Docker no inicia / Puerto ya en uso

**Causa**: Otro servicio está usando el puerto 80, 3306, etc.

**Solución**:
1. Detén otros servicios (XAMPP, WAMP, MySQL local, etc.)
2. O modifica los puertos en `.env`:
   ```env
   APP_PORT=8000
   FORWARD_DB_PORT=3307
   ```

### 7. Los cambios en CSS/JS no se reflejan

**Causa**: Vite no está corriendo o el navegador tiene caché.

**Solución**:
1. Verifica que Vite esté corriendo: `./vendor/bin/sail npm run dev`
2. Limpia el caché del navegador (Ctrl + Shift + R)
3. Reinicia Vite si es necesario

### 8. Error: "SQLSTATE[HY000] [2002] Connection refused"

**Causa**: MySQL no está corriendo o no está listo.

**Solución**:
```bash
./vendor/bin/sail up -d
# Espera 10-15 segundos para que MySQL inicie completamente
./vendor/bin/sail artisan migrate
```

---

## 🧪 Ejecutar Tests

```bash
./vendor/bin/sail artisan test
```

O con Pest:
```bash
./vendor/bin/sail pest
```

---

## 📦 Estructura del Proyecto

```
.
├── app/                    # Lógica de la aplicación (Modelos, Controladores)
├── bootstrap/              # Archivos de arranque de Laravel
├── config/                 # Archivos de configuración
├── database/               # Migraciones, seeders, factories
├── public/                 # Archivos públicos (index.php, assets compilados)
├── resources/              # Vistas, CSS, JS sin compilar
│   ├── css/               # Archivos CSS (Tailwind)
│   ├── js/                # Archivos JavaScript
│   └── views/             # Plantillas Blade
├── routes/                 # Definición de rutas
│   ├── web.php            # Rutas web
│   └── auth.php           # Rutas de autenticación (Breeze)
├── storage/                # Archivos generados (logs, cache, uploads)
├── tests/                  # Tests automatizados
├── vendor/                 # Dependencias de Composer (no subir a Git)
├── node_modules/           # Dependencias de NPM (no subir a Git)
├── .env                    # Variables de entorno (no subir a Git)
├── compose.yaml            # Configuración de Docker
├── package.json            # Dependencias de Node.js
├── composer.json           # Dependencias de PHP
├── vite.config.js          # Configuración de Vite
└── tailwind.config.js      # Configuración de Tailwind CSS
```

---

## 🛑 Detener el Proyecto

Cuando termines de trabajar:

```bash
./vendor/bin/sail stop
```

Para eliminar completamente los contenedores (mantiene la base de datos):
```bash
./vendor/bin/sail down
```

Para eliminar TODO (incluyendo volúmenes de base de datos):
```bash
./vendor/bin/sail down -v
```

---

## 📚 Recursos Adicionales

- [Documentación de Laravel](https://laravel.com/docs)
- [Documentación de Laravel Sail](https://laravel.com/docs/sail)
- [Documentación de Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)
- [Documentación de Vite](https://vitejs.dev/)
- [Documentación de Tailwind CSS](https://tailwindcss.com/docs)

---

## 👥 Equipo

Si tienes problemas o preguntas, contacta al equipo en el canal de Discord/Slack del proyecto.

---

**¡Feliz Coding! 🚀**
