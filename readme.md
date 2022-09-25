# Información General
- Versión PHP: 7.3.33

**NOTA:** Puede correr sobre muchas otras versiones de `PHP`, lo anterior es la versión sobre la cual se desarrollo y probo.  

# Instalación
Se debe descomprimir el proyecto "test" y dejar en la carpeta "test" o con el nombre que se desee:
- En la ruta física donde tiene el servidor, ejemplo: `C:\wamp64\www\test`
- En el navegador se cargaria algo parecido a esto: `http://localhost/test`

# Configuración config/database.php
1. Ya tiene una configuración por defecto, las pruebas se realizaron sobre esta configuración inicial pero el proyecto esta hecho para cambiar dinamicamente, es decir se acompla a la configuración que requiera el usuario.

# Información directorio `database`
1. Se entrega vacia la carpeta database pero a medida que el usuario comience a utilizar la aplicación se crearan los archivos JSON planos necesarios y los datos.

# Estructura de directorios
- `config`: Aquí van los archivos de configuración de la base de datos, globales, etc.
- `controllers`: Aquí van los controladores para conservar la arquitectura MVC. Estos se encargan de recibir y filtrar datos que le llegan de las vistas, llamar a los modelos y pasar los datos de estos a las vistas.
- `core`: Aquí se colocan las clases base de las que heredarán por ejemplo controladores y modelos, y también podríamos colocar más librerías hechas por nosotros o por terceros, esto sería el núcleo.
- `database`: Aquí se colocan los archivos planos JSON que se van creando a medida que se utiliza el aplicativo.
- `models`: Aquí van los modelos, para ser fieles al paradigma orientado a objetos se tiene una clase por cada tabla o entidad de la base de datos y estas clases sirven para crear objetos de ese tipo de entidad. También se tienen validaciones.
- `resources`: Aquí van los recursos del aplicativo que se utilizan desde las vistas, bien sea extensiones, archivos js, css y otros.
- `views`: Aquí van las vistas, es decir, donde se imprimen los datos y lo que verá el usuario.
index.php será el controlador frontal por el que pasará absolutamente todo en la aplicación.

**NOTA:** Cada archivo se encuentra documentado para hacer más sencillo el seguimiento del código.