## Instalación y Ejecución

1. **Requisitos previos**
   - PHP 8.x o superior
   - MySQL/MariaDB
   - Servidor web Apache (recomendado: XAMPP)
   - Composer (opcional, si se agregan dependencias externas)

2. **Pasos de instalación**
   1. Clona o descarga este repositorio en tu servidor local (ejemplo: `c:\xampp\htdocs\VitalCare`).
   2. Crea una base de datos llamada `vitalcare` en tu servidor MySQL.
   3. Importa el esquema de la base de datos (debes crear las tablas necesarias según los modelos).
   4. Configura los parámetros de conexión en `app/config.php` si es necesario.
   5. Inicia Apache y MySQL desde XAMPP.
   6. Accede a la aplicación desde tu navegador:  
      [http://localhost/VitalCare/app/public/](http://localhost/VitalCare/app/public/)

## Estructura de Archivos

- **app/**
  - `app.php` y `config.php`: Inicialización y configuración global.
  - **classes/**: Clases base del sistema (autoloader, DB, router, vistas).
  - **controllers/**: Controladores principales y de autenticación.
  - **models/**: Modelos de datos (ej. `user.php`).
  - **public/**: Archivos públicos, punto de entrada (`index.php`), recursos estáticos (CSS, JS).
    - **assets/**: Archivos estáticos (CSS, JS, imágenes).
  - **resources/**
    - **functions/**: Funciones auxiliares.
    - **layouts/**: Plantillas de cabecera y pie.
    - **views/**: Vistas para cada sección (inicio, login, registro, etc.).

## Notas

- El sistema utiliza sesiones PHP para la autenticación.
- El enrutamiento se maneja mediante `.htaccess` y la clase Router.
- Puedes personalizar los estilos en `public/assets/css/styles.css`.

---