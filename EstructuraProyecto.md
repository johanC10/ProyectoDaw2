# 🏗️ Arquitectura del Portal de Matrícula - Institut Caparrella

Este documento desglosa toda la estructura de carpetas y archivos que **hemos creado o modificado** a lo largo del desarrollo de la plataforma, omitiendo los archivos nucleares que CodeIgniter 4 trae por defecto y no hemos tocado.

---

## 1. ⚙️ Configuraciones Centrales (`app/Config/`)

*   **`Routes.php`**: El "mapa de carreteras" del sistema. Aquí le indicamos a la web qué archivo cargar dependiendo de la URL (ej. `/private/dashboard` carga el `AdminController`). También hemos definido "Grupos Protegidos" para evitar que alguien sin permisos acceda a rutas de administración.
*   **`Database.php`**: El puente entre nuestro código PHP y tu servidor XAMPP. Aquí definimos que nos conectamos a la base de datos `p_matricula_caparrella` usando el usuario `root`.
*   **`Auth.php` & `AuthGroups.php`**: *(Nuevos con Shield)* Controlan toda la seguridad nativa del programa. En `AuthGroups` configuramos los 3 roles inquebrantables: `admin`, `secretaria` y `estudiante` (registro invisible de alumnos).
---

## 2. 🗄️ Base de Datos (`app/Database/`)

Esta carpeta es vital porque define físicamente cómo se guarda la información, de modo que cualquier programador en el futuro pueda replicar tu sistema con dos comandos.

*   **`Migrations/2026-03-25-..._CaparrellaSchema.php`**: Es el "plano arquitectónico" de tu base de datos. Construye **16 tablas relacionales** súper optimizadas para el instituto (cursos, matricules, inventari_taquilles). *(Nota: La antigua tabla `usuaris_secretaria` fue demolida y reemplazada por las 6 tablas profesionales que inyecta CodeIgniter Shield, vinculando la tabla `persones` mediante la clave foránea `id_user` para lograr el Expediente Único).*
*   **`Seeds/MainSeeder.php`**: El "inyector de datos de prueba". Purga la base de datos y la rellena automáticamente invocando a la API de Shield para crear el usuario administrador (`admin_caparrella`), las 4 etapas educativas, los 22 cursos específicos, y cientos de alumnos falsos generados algorítmicamente.

---

## 3. 🧠 Modelos (`app/Models/`)

Los Modelos son los traductores. Cada archivo representa una tabla de la base de datos. Tu código jamás usa código "SQL puro", sino que usamos estos modelos para hablar con la base de datos en lenguaje seguro.

*   **`UserModel.php` (Nativo de Shield)**: Sustituye a tu antiguo script manual. Gestiona de forma encriptada las identidades, los inicios de sesión, y la protección contra ataques de fuerza bruta.
*   **`PersonaModel.php`**: Se asocia a la tabla `persones`. Gestiona todos los datos biográficos de los alumnos (DNI, nombre, edad, dirección) y los enlaza a su *Cuenta Invisible* de Shield.
*   **`MatriculaModel.php`**: El núcleo de las solicitudes. Gestiona la tabla `matricules`. **Destacado:** En este modelo activamos la función `$useSoftDeletes = true;`, lo que significa que al eliminar una matrícula, no desaparece; solo se oculta para ir a parar a la Papelera.
*   **`EtapaModel.php` & `CursoModel.php`**: Modelos auxiliares para traer la información de la jerarquía escolar.

---

## 4. 🛂 Filtros de Seguridad (`app/Filters/`)

*   **`AuthSecretaria.php`**: Nuestro antiguo filtro manual, ahora reescrito e integrado con los filtros nativos de **Shield** (`session`, `tokens`). Bloquea sin compasión a los usuarios que no han validado su sesión.
*   **`AuthEstudiante.php`**: Filtro paralelo que gobernarán las *Cuentas Invisibles* de los alumnos cuando entren a mirar el estado de sus trámites públicos.

---

## 5. 🕹️ Controladores (`app/Controllers/`)

Son los "cerebros" o "directores de orquesta". Reciben el clic del usuario, recogen datos de los Modelos (BBDD) y deciden qué Vista (HTML) pintar en la pantalla.

*   **`Auth_secretaria.php`**: El cerebro del Login de administración. Ahora en lugar de validar a mano con `password_verify`, usa la potente función `auth()->attempt()` de Shield, lo que nos brinda seguridad de nivel militar (autobloqueo de IP, control de roles inyectados directamente a las variables de sesión).
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
*   **`LoginAdmin.php`**: Diccionario entero de la pantalla de Login y mensajes de recuperación de cuenta invisible.
*   **`ListadoMatriculas.php`**: Traducciones exclusivas de las tablas (DNI, botones, alertas de borrado).
*   **`FichaValidacion.php`**: *(Nuevo)* Contiene absolutamente todas las claves textuales requeridas por la vista `validacion_detalle`, permitiendo que la ficha médica, académica y los tooltips cambien fluidamente de idioma.

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
