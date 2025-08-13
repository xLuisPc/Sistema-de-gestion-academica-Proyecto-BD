# Sistema de Gestión Académica

## 📋 Descripción

Sistema web desarrollado en PHP para la gestión académica de docentes universitarios. Permite administrar cursos, estudiantes y calificaciones de manera eficiente y organizada.

## ✨ Características Principales

- 🔐 **Sistema de autenticación** para docentes
- 📚 **Gestión de cursos** por año y período académico
- 👥 **Administración de estudiantes** (agregar/eliminar)
- 📊 **Sistema de calificaciones** con porcentajes personalizables
- 📈 **Cálculo automático** de notas definitivas
- 📋 **Reportes** de calificaciones por curso
- 🎨 **Interfaz responsive** con Bootstrap
- 🔔 **Notificaciones** con SweetAlert2

## 🛠️ Tecnologías Utilizadas

- **Backend:** PHP 7.4+
- **Base de Datos:** PostgreSQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Framework CSS:** Bootstrap 4.3.1
- **Notificaciones:** SweetAlert2
- **Hosting DB:** ElephantSQL

## 📁 Estructura del Proyecto

```
Proyectobd/
├── Admin/
│   ├── config/
│   │   └── bd.php                 # Configuración de base de datos
│   ├── template/
│   │   ├── Cabecera.php          # Header común
│   │   ├── Pie.php               # Footer común
│   │   └── Cerrar_S.php          # Cierre de sesión
│   ├── css/
│   │   ├── estilo.css            # Estilos personalizados
│   │   ├── logo.png              # Logo institucional
│   │   └── usuario.png           # Icono de usuario
│   ├── nodos/
│   │   └── sweetalert/           # Librería de notificaciones
│   ├── index.php                 # Página de login
│   ├── Validar.php               # Validación de credenciales
│   ├── Cursos.php                # Panel principal de cursos
│   ├── EdiNota.php               # Gestión de estudiantes y notas
│   ├── AgregarEst.php            # Agregar estudiantes
│   ├── EliminarEst.php           # Eliminar estudiantes
│   ├── AgregarNota.php           # Crear tipos de evaluación
│   ├── EditarNota.php            # Editar tipos de evaluación
│   ├── BorrarNota.php            # Eliminar tipos de evaluación
│   ├── InscribirNota.php         # Registrar calificaciones
│   ├── Tabla_final.php           # Reporte de notas definitivas
│   ├── main.js                   # Funciones JavaScript
│   └── [otros archivos de validación]
└── README.md
```

## 🚀 Instalación

### Requisitos Previos

- Servidor web (Apache/Nginx)
- PHP 7.4 o superior
- PostgreSQL
- Extensión PHP para PostgreSQL habilitada

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone [URL_DEL_REPOSITORIO]
   cd Proyectobd
   ```

2. **Configurar la base de datos**
   - Crear una base de datos PostgreSQL
   - Importar el esquema de base de datos (ver sección Base de Datos)

3. **Configurar la conexión**
   - Editar `Admin/config/bd.php`
   - Actualizar credenciales de conexión:
   ```php
   $conect = pg_connect("host = tu_host dbname = tu_db user = tu_usuario password = tu_password");
   ```

4. **Configurar el servidor web**
   - Apuntar el DocumentRoot al directorio `Admin/`
   - Asegurar permisos de lectura/escritura

5. **Crear usuario administrador**
   - Insertar un docente en la tabla `docentes`:
   ```sql
   INSERT INTO docentes (cod_doc, nomb_doc, correo, clave) 
   VALUES ('DOC001', 'Nombre Docente', 'admin@universidad.edu', 'password123');
   ```

## 🗄️ Base de Datos

### Estructura de Tablas

```sql
-- Tabla de docentes
CREATE TABLE docentes (
    cod_doc VARCHAR(10) PRIMARY KEY,
    nomb_doc VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    clave VARCHAR(100) NOT NULL
);

-- Tabla de cursos
CREATE TABLE cursos (
    cod_cur VARCHAR(10) PRIMARY KEY,
    nomb_cur VARCHAR(100) NOT NULL,
    cod_doc VARCHAR(10) REFERENCES docentes(cod_doc)
);

-- Tabla de estudiantes
CREATE TABLE estudiantes (
    cod_est VARCHAR(10) PRIMARY KEY,
    nomb_est VARCHAR(100) NOT NULL,
    ape_est VARCHAR(100) NOT NULL
);

-- Tabla de inscripciones
CREATE TABLE inscripciones (
    cod_est VARCHAR(10) REFERENCES estudiantes(cod_est),
    cod_cur VARCHAR(10) REFERENCES cursos(cod_cur),
    year VARCHAR(4) NOT NULL,
    periodo INTEGER NOT NULL,
    PRIMARY KEY (cod_est, cod_cur, year, periodo)
);

-- Tabla de tipos de notas
CREATE TABLE notas (
    cod_nota SERIAL PRIMARY KEY,
    cod_cur VARCHAR(10) REFERENCES cursos(cod_cur),
    nomb_nota VARCHAR(100) NOT NULL,
    porcentaje DECIMAL(5,2) NOT NULL
);

-- Tabla de calificaciones
CREATE TABLE calificaciones (
    cod_cal SERIAL PRIMARY KEY,
    cod_est VARCHAR(10) REFERENCES estudiantes(cod_est),
    cod_cur VARCHAR(10) REFERENCES cursos(cod_cur),
    cod_nota INTEGER REFERENCES notas(cod_nota),
    valor_nota DECIMAL(4,2) NOT NULL,
    year VARCHAR(4) NOT NULL,
    periodo INTEGER NOT NULL
);
```

## 📖 Manual de Uso

### 1. Acceso al Sistema

1. Abrir el navegador y dirigirse a la URL del sistema
2. Ingresar credenciales de docente:
   - **Usuario:** Correo electrónico registrado
   - **Contraseña:** Clave asignada

### 2. Gestión de Cursos

1. **Seleccionar curso:** Elegir de la lista desplegable
2. **Configurar período:** Seleccionar año y período académico
3. **Acceder a gestión:** Hacer clic en "Ver Lista de Estudiantes"

### 3. Administración de Estudiantes

#### Agregar Estudiante
1. Hacer clic en "Agregar Estudiante"
2. Seleccionar estudiante de la lista disponible
3. Confirmar registro

#### Eliminar Estudiante
1. En la lista de estudiantes, hacer clic en "Eliminar"
2. Confirmar la acción

### 4. Configuración de Notas

#### Crear Tipo de Evaluación
1. En la sección "Agregar Nota":
   - Ingresar nombre de la evaluación
   - Definir porcentaje (ej: 30%)
2. Hacer clic en "Agregar Nota"

#### Editar/Eliminar Notas
- Usar botones "Editar Nota" o "Borrar Nota" según corresponda

### 5. Registro de Calificaciones

1. Hacer clic en "Registrar Nota" para el tipo de evaluación deseado
2. Ingresar calificaciones para cada estudiante (0.0 - 5.0)
3. Hacer clic en "Insertar" para guardar cada nota

### 6. Generar Reportes

1. Hacer clic en "Reporte de notas"
2. Visualizar tabla con:
   - Notas individuales por evaluación
   - Cálculo automático de definitiva
   - Porcentajes aplicados

## 🔧 Configuración Avanzada

### Personalización de Estilos

Editar `Admin/css/estilo.css` para modificar:
- Colores del tema
- Tipografías
- Layout y espaciado

### Configuración de Notificaciones

Modificar `Admin/main.js` para personalizar:
- Mensajes de éxito/error
- Comportamiento de alertas

## 🐛 Solución de Problemas

### Error de Conexión a Base de Datos
- Verificar credenciales en `config/bd.php`
- Confirmar que PostgreSQL esté ejecutándose
- Verificar permisos de usuario

### Problemas de Sesión
- Verificar configuración de PHP sessions
- Revisar permisos de escritura en directorio temporal

### Errores de Cálculo de Notas
- Verificar que los porcentajes sumen 100%
- Confirmar que todas las notas estén registradas

## 📝 Notas de Desarrollo

### Seguridad
- Implementar sanitización de inputs SQL
- Agregar validaciones de datos
- Considerar encriptación de contraseñas

### Mejoras Futuras
- Panel de administración para gestores
- Exportación de reportes a PDF/Excel
- Notificaciones por email
- API REST para integración con otros sistemas

## 👥 Contribución

1. Fork el proyecto
2. Crear rama para nueva funcionalidad (`git checkout -b feature/nueva-funcionalidad`)
3. Commit cambios (`git commit -am 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crear Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.



