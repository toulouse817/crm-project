# Produx CRM - Sistema de Gestión de Clientes y Productos

Produx CRM es una aplicación web de página única (SPA) interactiva de alta fidelidad. Permite a las empresas gestionar su directorio de clientes comerciales (CRM) y asociar de forma dinámica el catálogo de productos que distribuyen en el mercado global.

El proyecto está diseñado bajo un enfoque fullstack que combina el poder de **Laravel 13** en el backend y la velocidad de **JavaScript Vanilla (ES6)** con **CSS Grid y Flexbox** en el frontend, sin dependencias de frameworks externos.

---

## 🚀 Características Principales

1. **Dashboard de Doble Panel (SPA)**: Navegación instantánea mediante pestañas del lado del cliente:
   - **Clientes (CRM)**: Tarjetas interactivas de socios comerciales, número de productos activos, datos geográficos y catálogo de ventas del distribuidor.
   - **Catálogo de Productos**: Listado de productos con su precio, miniatura y el distribuidor asignado.
2. **Integración con API Pública (REST Countries)**: Al registrar o editar un cliente, se consume en tiempo real la API `https://restcountries.com/v3.1/all`. Al seleccionar el país, el sistema autocompleta el prefijo internacional de llamada (ej. `+58` para Venezuela) y despliega su respectiva bandera nacional.
3. **Placeholders "Nano Banana"**: Integrados directamente en el código JavaScript a través de gráficos vectoriales SVG personalizados. Esto asegura que la aplicación tenga una identidad visual única e independiente de problemas de red externos:
   - *Avatar del Cliente*: Un divertido plátano animado con mejillas sonrosadas y lentes.
   - *Miniatura de Producto*: Un dispositivo tecnológico de color amarillo plátano.
4. **Temas Claro / Oscuro Inteligentes**: Soporte nativo a través de variables CSS (HSL) que se guarda y persiste en la sesión del navegador mediante la API de `localStorage`.
5. **Acciones CRUD en Tiempo Real**: Creación, consulta (con relaciones eager loading en Laravel), edición y eliminación en cascada utilizando Fetch API con manejo de Toasts para retroalimentación visual al usuario.
6. **Buscador y Ordenamiento Dinámico**: Búsqueda interactiva por texto en tiempo real y ordenamientos por nombre o precio.

---

## 🌐 Integración de API Pública Externa (REST Countries)

La aplicación consume de forma dinámica e interactiva la API pública de **REST Countries** para automatizar el ingreso de información de ubicación y contacto de los clientes.

### Endpoint Utilizado
- **URL**: `https://restcountries.com/v3.1/all?fields=name,cca2,idd,flags`
- **Campos Solicitados**: Nombre oficial del país (`name`), código de dos letras ISO (`cca2`), prefijo de marcado internacional (`idd`), y bandera oficial (`flags`).

### Flujo de Funcionamiento en el Frontend
La lógica está implementada de manera centralizada en el script del archivo principal [index.html](file:///c:/laragon/www/mi-primer-proyecto/public/index.html):

1. **Carga Inicial (`apiFetchCountries`)**:
   Al inicializar la SPA, se ejecuta una petición asíncrona mediante `fetch()`. Los resultados se ordenan alfabéticamente por su nombre oficial y se guardan en el estado global (`AppState.paises`), poblando la lista de selección del formulario.
2. **Autocompletado del Prefijo de Llamada (`handleCountryChange`)**:
   Cuando el usuario selecciona un país en el formulario del cliente, se dispara un evento de cambio que localiza el código telefónico concatenando la raíz y el sufijo (`idd.root` + `idd.suffixes[0]`) y lo inyecta automáticamente en el campo de prefijo (`#cliente-phone-code`).
3. **Renderizado de Banderas**:
   Al pintar las tarjetas de los clientes en el grid, se recupera el enlace de la bandera (`flags.png` o `flags.svg`) y se añade una miniatura de la bandera al lado de la ciudad y el nombre del país del cliente.

---

## 🛠️ Arquitectura y Stack Tecnológico

- **Backend**:
  - **Framework**: Laravel 13.x (PHP 8.3)
  - **Base de Datos**: MySQL (Laragon) o SQLite.
  - **ORM**: Eloquent con relaciones de Uno a Muchos (`HasMany` / `BelongsTo`).
  - **Middleware**: Exclusión selectiva de tokens CSRF en rutas API internas para permitir peticiones asíncronas desde la SPA.
- **Frontend**:
  - **Estructura**: HTML5 Semántico
  - **Hoja de Estilos**: CSS3 de Alta Fidelidad (Custom Properties, CSS Grid, Flexbox, Glassmorphism con `backdrop-filter`, animaciones de fotogramas clave y transiciones elásticas en hover).
  - **Lógica**: ECMAScript 6+ nativo (Módulos asíncronos, Fetch API, manipulación avanzada del DOM y JSDoc).

---

## 📁 Estructura del Proyecto

*   📂 `app/`
    *   📂 `Http/Controllers/`
        *   📄 `ClienteController.php` - Controlador del CRUD de clientes y eager loading de productos.
        *   📄 `ProductoController.php` - Controlador del CRUD de productos y relación de vendedor.
    *   📂 `Models/`
        *   📄 `Cliente.php` - Definición del modelo cliente y relación `hasMany`.
        *   📄 `Producto.php` - Definición del modelo producto y relación `belongsTo`.
*   📂 `bootstrap/`
    *   📄 `app.php` - Configuración de exclusiones de verificación CSRF del middleware.
*   📂 `database/`
    *   📂 `migrations/`
        *   📄 `2026_07_01_000000_create_clientes_table.php` - Estructura de clientes.
        *   📄 `2026_07_02_215338_create_productos_table.php` - Estructura de productos y clave foránea.
*   📂 `public/`
    *   📂 `css/`
        *   📄 `styles.css` - Hoja de estilos con variables, diseño adaptativo HSL y animaciones.
    *   📄 `index.html` - Punto de entrada de la SPA, formularios modales y lógica JavaScript Vanilla (JSDoc).
*   📂 `routes/`
    *   📄 `web.php` - Registro de rutas del SPA y endpoints API del CRUD.

---

## 💻 Instalación y Configuración Local

### Prerrequisitos
- Laragon u otro entorno local con soporte de PHP 8.3+ y MySQL.
- Composer.

### 1. Clonar y Configurar Entorno
1. Descarga o clona el proyecto en tu carpeta de servidor local (ej. `C:/laragon/www/mi-primer-proyecto`).
2. Crea una base de datos vacía en MySQL llamada `mi_proyecto_db`.
3. Renombra o edita el archivo `.env` configurando la base de datos de tu elección.

#### Para usar MySQL (Configuración por Defecto):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mi_proyecto_db
DB_USERNAME=root
DB_PASSWORD=
```

#### Para usar SQLite (Sin dependencias externas):
```env
DB_CONNECTION=sqlite
```
*(Nota: Asegúrate de crear un archivo vacío en `database/database.sqlite` si usas esta opción).*

### 2. Instalación de Dependencias y Migraciones
Abre una terminal en el directorio del proyecto y ejecuta:

```bash
# Instalar dependencias de PHP
composer install

# Limpiar caché de configuraciones de Laravel
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# Ejecutar las migraciones de base de datos
php artisan migrate:fresh
```

### 3. Iniciar el Servidor de Desarrollo
Si estás usando la consola, ejecuta:
```bash
php artisan serve --port=8000
```
Y accede desde tu navegador web a:
👉 [http://localhost:8000](http://localhost:8000)

Si estás usando Laragon, asegúrate de iniciar todos los servicios e ingresa a:
👉 [http://mi-primer-proyecto.test](http://mi-primer-proyecto.test)

---

## 🎓 Créditos e Institución
Desarrollado como parte del material evaluativo de formación profesional bajo las directrices del:

**Curso de Nivelación para la Certificación de Desarrolladores Fullstack**  
*Universidad Nacional Experimental del Táchira (UNET)*

**Profesor Gabriel Ramírez**
