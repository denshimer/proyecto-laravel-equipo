# Proyecto Web Laravel (Equipo de Desarrollo para la Hackaton)

Este proyecto utiliza **Laravel Sail** (Docker) para garantizar que todos los desarrolladores trabajen exactamente en el mismo entorno, sin importar si usan Windows, Mac o Linux.

---

## 📋 Requisitos Previos

Antes de empezar, asegúrate de tener instalado:
1.  **Docker Desktop** (Debe estar corriendo).
2.  **Git**.
3.  **WSL2** (Si usas Windows, es obligatorio para evitar problemas de rendimiento y rutas).

---

## 🛠️ Instalación e Inicio (Setup)

Sigue estos pasos estrictamente la primera vez que descargues el proyecto:

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
(Aquí puedes ajustar las credenciales de DB si fuera necesario, pero por defecto Sail ya las configura).

### 3. Instalar dependencias (El paso mágico)
Como probablemente no tengas PHP/Composer instalado en tu máquina local, usaremos un contenedor temporal para descargar las librerías del proyecto (vendor/). Ejecuta este bloque completo en tu terminal:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Levantar el servidor
Ahora que ya tenemos las librerías, iniciamos Sail:
```bash
./vendor/bin/sail up -d
```

### 5. Configuración final
Generamos la clave de encriptación y corremos las migraciones de la base de datos:
```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
```

👉 **¡Listo! Accede a:** [http://localhost](http://localhost)

---

## 🤝 Flujo de Trabajo (Git Workflow)
Para mantener el orden y evitar romper el código, utilizamos la siguiente estrategia de ramas. Por favor, léelo con atención.

### Las Ramas Principales
*   🛡️ **main (Producción)**: Es la rama sagrada. El código aquí SIEMPRE funciona. Está protegida: No se puede hacer push directo. Solo recibe cambios mediante Pull Request aprobados desde develop.
*   🛠️ **develop (Desarrollo)**: Aquí integramos el trabajo de todos. Es nuestra rama base para trabajar.

### Cómo trabajar en una nueva tarea (Features)
Cada vez que vayas a arreglar un bug o crear una función nueva:

1.  **Actualízate**: Baja siempre lo último de develop.
    ```bash
    git checkout develop
    git pull origin develop
    ```
2.  **Crea tu rama**: Usa el prefijo feature/.
    ```bash
    git checkout -b feature/nombre-de-la-tarea
    ```
3.  **Trabaja y Guarda**: Haz tus commits normales.
4.  **Publica**: Sube tu rama a GitHub.
    ```bash
    git push origin feature/nombre-de-la-tarea
    ```
5.  **Solicita Fusión (Pull Request)**:
    *   Ve a GitHub y abre un Pull Request de tu rama hacia `develop`.
    *   Avisa al equipo para que revisen tu código.
    *   Una vez aprobado, se fusionará.

---

## 🐳 Comandos de Docker (Sail) Cheatsheet

Como usamos Sail, no ejecutes `php artisan` o `composer` directamente en tu consola. Usa estos comandos:

| Acción | Comando |
| :--- | :--- |
| **Iniciar servidor** | `./vendor/bin/sail up -d` |
| **Detener servidor** | `./vendor/bin/sail stop` |
| **Ver logs** | `./vendor/bin/sail logs -f` |
| **Ejecutar Artisan** | `./vendor/bin/sail artisan [comando]` |
| **Instalar paquete** | `./vendor/bin/sail composer require [paquete]` |
| **Entrar al contenedor** | `./vendor/bin/sail shell` |

> [!TIP]
> **Tip Pro**: Para escribir menos, crea un alias en tu terminal:
> ```bash
> alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
> ```
> Así solo escribirás `sail up`, `sail artisan`, etc.

---

## ⚠️ Solución de Problemas Comunes

### Error: "Permission denied" en storage/
Si ves una pantalla roja de error de permisos, ejecuta esto para dar acceso a las carpetas de caché:
```bash
./vendor/bin/sail exec laravel.test chmod -R 777 storage bootstrap/cache
```

### Error: Base de datos vacía
Si te dice que no encuentra la tabla `sessions` o `users`, olvidaste correr las migraciones:
```bash
./vendor/bin/sail artisan migrate
```
