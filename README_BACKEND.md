# ⚙️ Documentación del Backend (SICI-ISI)

Este documento describe la lógica del servidor, el esquema de base de datos y el flujo de datos dinámicos.

## 🗄️ Esquema de Base de Datos

El sistema utiliza **MySQL** y cuenta con dos entidades principales además de los usuarios:

### 1. Tabla `publications`
Almacena noticias y artículos.
- `title`, `slug`: Identificadores del post.
- `content`, `excerpt`: Contenido completo y resumen.
- `image_path`: Ruta relativa a la imagen en `public/`.
- `is_published`: Booleano para control de borradores.
- `published_at`: Fecha de ordenamiento.

### 2. Tabla `events`
Almacena actividades académicas.
- `event_date`: DateTime para orden cronológico.
- `type`: Categoría (Taller, Conferencia, Competencia).
- `location`: Ubicación física.

---

## 🧠 Lógica de Controladores

Toda la lógica pública y administrativa reside en `app/Http/Controllers/SiteController.php`:

| Método | Vista Retornada | Datos Inyectados |
| :--- | :--- | :--- |
| `home()` | `welcome` | Las 3 publicaciones más recientes. |
| `publications()` | `publications` | Separa la noticia más nueva (`$featured`) del resto (`$others`). |
| `events()` | `events` | Lista completa de eventos ordenada por fecha. |
| `dashboard()` | `dashboard` | Contadores (`count()`) de usuarios, eventos y noticias para las métricas. |

---

## 🌱 Seeders y Datos de Prueba

Para facilitar el desarrollo y la presentación, no utilizamos Factories aleatorios.
El archivo `database/seeders/DatabaseSeeder.php` contiene **datos estáticos controlados**:
1.  Crea el Usuario Admin.
2.  Inserta 4 noticias con títulos y fechas específicas.
3.  Inserta 3 eventos (Bootcamp, Hackathon, Conferencia).

> **Nota:** Al ejecutar `migrate:fresh --seed`, estos datos se restauran automáticamente, permitiendo pruebas consistentes de la interfaz.