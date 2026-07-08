# Skill: Laravel SPA Fullstack CRM (Clientes y Productos)

## 1. Stack Tecnológico
- **Backend:** Laravel 13.x (PHP 8.3)
- **Frontend:** Single Page Application (HTML5 + CSS3 + Vanilla JS ES6)
- **Database:** MySQL o SQLite (conexión local persistente)
- **API Externa:** REST Countries API (`https://restcountries.com/v3.1/all`) para geolocalización y prefijos telefónicos.
- **Gráficos:** Placeholders vectoriales SVG integrados de "Nano Banana" para avatares y dispositivos.

## 2. Configuración del Backend (Laravel)
- **Modelos y Relaciones:**
  - `Cliente.php`: Relación de Uno a Muchos (`hasMany(Producto::class)`).
  - `Producto.php`: Relación inversa (`belongsTo(Cliente::class)`).
- **Controladores:**
  - `app/Http/Controllers/ClienteController.php`: CRUD completo (`index`, `store`, `update`, `destroy`) retornando respuestas JSON y eager loading de productos.
  - `app/Http/Controllers/ProductoController.php`: CRUD completo con asignación relacional de `cliente_id` e `imagen`.
- **Middleware:**
  - Desactivación de validación CSRF para `/clientes-data*` y `/productos-data*` en el archivo `bootstrap/app.php`.
- **Rutas (`routes/web.php`):**
  - Registro de vistas de entrada de la SPA e inicialización de endpoints CRUD independientes para clientes y productos.

## 3. Configuración del Frontend (SPA Premium)
- **Estructura (`public/index.html`):**
  - Sistema de doble pestaña: Clientes (CRM) y Catálogo de Productos.
  - Consumo reactivo de REST Countries API para autocompletar prefijos telefónicos y renderizar banderas de países.
  - Formulario modal reutilizado dinámicamente para flujos de creación y edición.
  - Alerta de confirmación antes de la eliminación de registros en cascada.
  - Persistencia de selección de tema (Claro / Oscuro) mediante `localStorage`.
  - Toasts flotantes para notificaciones e indicaciones visuales de carga (shimmers).

## 4. CSS (Estética Vistosa & Glassmorphism)
- **Estilos (`public/css/styles.css`):**
  - Variables de colores (HSL) adaptativas para temas Claro y Oscuro.
  - Diseños modulares mediante Flexbox para formularios y CSS Grid (`.grid-container`) para las tarjetas.
  - Efectos visuales de desenfoque de fondo (`backdrop-filter`) y sombras suaves (`box-shadow`).
  - Microanimaciones interactivas (transiciones elásticas en hover y animaciones de entrada).

## 5. Comandos de Verificación (QA)
- `php artisan migrate:fresh` (Restablecer tablas relacionales).
- `php artisan route:list` (Verificar registro de rutas CRUD).
- `php artisan config:clear` / `php artisan route:clear` (Limpiar cachés locales).
- `php artisan serve --port=8000` (Iniciar servidor local).