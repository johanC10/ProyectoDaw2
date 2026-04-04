# 🏗️ Arquitectura del Portal de Matrícula - Institut Caparrella

Este documento desglosa toda la estructura de carpetas y archivos que **hemos creado o modificado** a lo largo del desarrollo de la plataforma, omitiendo los archivos nucleares que CodeIgniter 4 trae por defecto y no hemos tocado.

---

## 1. ⚙️ Configuraciones Centrales (`app/Config/`)

*   **`Routes.php`**: El "mapa de carreteras" del sistema. Aquí le indicamos a la web qué archivo cargar dependiendo de la URL (ej. `/private/dashboard` carga el `AdminController`). También hemos definido "Grupos Protegidos" para evitar que alguien sin permisos acceda a rutas de administración.
*   **`Database.php`**: El puente entre nuestro código PHP y tu servidor XAMPP. Aquí definimos que nos conectamos a la base de datos `p_matricula_caparrella` usando el usuario `root`.

---

## 2. 🗄️ Base de Datos (`app/Database/`)

Esta carpeta es vital porque define físicamente cómo se guarda la información, de modo que cualquier programador en el futuro pueda replicar tu sistema con dos comandos.

*   **`Migrations/2026-03-25-..._CaparrellaSchema.php`**: Es el "plano arquitectónico" de tu base de datos. Este archivo mediante código construye las **17 tablas relacionales** súper optimizadas para el instituto (desde `persones`, `cursos`, `matricules` hasta `inventari_taquilles`), interconectadas con claves foráneas para que la base de datos sea indestructible a fallos de consistencia.
*   **`Seeds/MainSeeder.php`**: El "inyector de datos de prueba". Este script purga la base de datos y la rellena automáticamente con tu usuario administrador (`admin_caparrella`), las 4 etapas educativas, los 22 cursos específicos reales que me pasaste, y matricula alumnos falsos al azar en todos ellos para tener datos de prueba.

---

## 3. 🧠 Modelos (`app/Models/`)

Los Modelos son los traductores. Cada archivo representa una tabla de la base de datos. Tu código jamás usa código "SQL puro", sino que usamos estos modelos para hablar con la base de datos en lenguaje seguro.

*   **`UsuarioSecretariaModel.php`**: Gestiona las contraseñas, los roles y las fechas de acceso de la tabla `usuaris_secretaria`.
*   **`PersonaModel.php`**: Se asocia a la tabla `persones`. Gestiona todos los datos biográficos de los alumnos (DNI, nombre, edad, dirección).
*   **`MatriculaModel.php`**: El núcleo de las solicitudes. Gestiona la tabla `matricules`. **Destacado:** En este modelo activamos la función `$useSoftDeletes = true;`, lo que significa que al eliminar una matrícula, no desaparece; solo se oculta para ir a parar a la Papelera.
*   **`EtapaModel.php` & `CursoModel.php`**: Modelos auxiliares para traer la información de la jerarquía escolar.

---

## 4. 🛂 Filtros de Seguridad (`app/Filters/`)

*   **`AuthSecretaria.php`**: Es nuestro portero de discoteca. Este script se ejecuta **antes** de cargar cualquier página que empiece por `/private`. Si el usuario no tiene la sesión activa de secretario, lo bloquea y lo manda de una patada al Login.
*   **`AuthEstudiante.php`**: Creado como barrera paralela para cuando construyamos la zona pública del alumno.

---

## 5. 🕹️ Controladores (`app/Controllers/`)

Son los "cerebros" o "directores de orquesta". Reciben el clic del usuario, recogen datos de los Modelos (BBDD) y deciden qué Vista (HTML) pintar en la pantalla.

*   **`Auth_secretaria.php`**: El cerebro del Login. Captura las credenciales, encripta la contraseña escrita con `password_verify()` para compararla con seguridad y, si coinciden, crea la Sesión. También contiene tu mecanismo de simulación de "Recuperar Contraseña".
*   **`AdminController.php`**: El controlador más grande y complejo. Controla absolutamente todo lo que hace secretaría:
    *   Genera las estadísticas globales para pintar el Dashboard interactivo.
    *   Busca y agrupa formaciones con un algoritmo complejo tipo JOIN.
    *   Se encarga de procesar la validación/rechazo de un alumno cambiando sus estados.
    *   Maneja la lógica de mandar elementos a la Papelera y Restaurarlos.
*   **`IdiomaController.php`**: Un script pequeñito pero matón. Cuando alguien clica en cambiar de idioma (Catalán, Español, Inglés), este controlador intercepta la solicitud, cambia la variable de sesión y recarga la página.

---

## 6. 🌍 Traducciones (`app/Language/`)

Tienen subcarpetas para `ca/`, `es/`, `en/`. Aquí "escondemos" el texto para no ponerlo en sucio en el diseño web. Tu diseño invoca palabras como `lang('Dashboard.vista_general')` y CodeIgniter busca automáticamente la traducción según el idioma seleccionado.

*   **`Cursos.php`**: Contiene la traducción para los nombres larguísimos de los ciclos superiores de FP, la ESO y las familias profesionales.
*   **`Dashboard.php`**: Textos generales del panel inicial (Totales, pendients, barra de búsqueda).
*   **`LoginAdmin.php`**: Diccionario entero de la pantalla de Login y mensajes de error (Recuperar cuenta, credenciales inválidas).
*   **`ListadoMatriculas.php`**: Traducciones exclusivas de las tablas (DNI, botones, alertas de borrado).

---

## 7. 🎨 Vistas / Interfaces (`app/Views/private/`)

Cualquier archivo con la extensión `.php` que tenga HTML y CSS pertenece aquí. Es lo que realmente ve el secretario en su navegador, y está impregnado con comandos `<?php ?>` muy ligeros para imprimir los datos reales.

*   **`auth/login_gestion.php`**: La hermosa pantalla con el logo redondo centrado, tarjeta redondeada estilo macOS moderna, y un Modal de Bootstrap que programamos para la recuperación de cuentas.
*   **`dashboard/dashboard_formaciones.php`**: El panel general "wow". Contiene sistema de grillas dinámicas (las tarjetas de cada curso), los indicadores amarillos y verdes de alumnos pendientes, un **Buscador ultrarrápido** implementado en puro JavaScript, y una lógica que usando el `LocalStorage` del navegador "clava" (favoritos/pin) formaciones en la cabecera.
*   **`gestion/listado_estudiantes_curso.php`**: La tabla. Cuando entras en un curso particular, aquí se pintan las filas limpias con el DNI, Nombre, iconitos de si han subido PDFs, el estado coloreado (pendiente/validada), y los botones de Revisar o enviar a Papelera.
*   **`gestion/validacion_detalle.php`**: El "Expediente". La ficha técnica completa y aislada de UN solo estudiante. Muestra toda la trazabilidad recogida en `persones` y `matricules` y tiene una barra inferior fija (sticky) muy amigable para que el administrador dicte sentencia (Validar o Rechazar).
*   **`gestion/papelera.php`**: Visualmente igual al listado de estudiantes, pero modificado para leer sólo archivos con fecha de borrado (`deleted_at`), ofreciendo botones de "Restaurar" permanentemente en verde.

## 8. 🖼️ Archivos Públicos Estáticos (`public/`)
*   **`assets/img/logomini.png`**: Tu ícono de branding de *Institut Caparrella* que hemos introducido orgánicamente a lo largo de todas las vistas administrativas.

---

### En Resumen
Es el paradigma perfecto del patrón **MVC (Model-View-Controller)**:
1. Las bases de datos (`Database/`) alojan la infraestructura.
2. Los `Models/` recogen datos de esas tablas.
3. Los `Controllers/` enlazan todo aplicando lógica y seguridad (`Filters/`).
4. Las `Views/` reciben los datos empaquetados y limpios, que gracias al `Language/` adaptan su texto de inmediato. Todo esto despachando maravillas bajo nuestro mando.
