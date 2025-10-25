# TPEspecial-web2-2025


### Nombres de los integrantes del grupo (emails):
 - Lucia Moreira -> lulii.moreira96@gmail.com
 - Manuel Montoya -> montoya.christensen@outlook.com


<img width="636" height="339" alt="Diagrama Entidad-Relacion" src="./DER tienda.jpg" />

# TPE - Parte 2: Sitio Web Dinámico

- Este proyecto en un sitio web dinámico que permite la visualización y administración de ventas y vendedores. Los usuarios pueden acceder a un listado de ellos sin necesidad de iniciar sesión, mientras que solo los usuarios autenticados tiene acceso a una sección restringida que puede modificar, editar o eliminar un item.

 ##### la tabla vendedor tiene:
 - un id, un nombre, un telefono, un email y una imagen
 ##### la tabla venta tiene:
 - un id, un producto, un precio, una fecha de venta, y el id del vendedor que realizo la venta

##### el sitio permite adjuntar imagenes al momento de registrar un nuevo vendedor, si no se adjunta una se le asigna una imagen predefinida.
###### - tambien se puede editar la imagen de cada vendedor existente. 


En el home para usuario no logueados, o logueados sin ser rol=administrador se muestran las ventas con su producto y valor, en la seccion de vendedores, su nombre, mail y telefono.


Cuando el administrador ingresa con el usuario admin y la contraseña webadmin puede agregar, editar y eliminar ítems, ya que vera los botones para realizar dichas acciones.

- Se uso [Apache](https://www.apachefriends.org/), Base de Datos: MySQL, Estructura de Archivos: MVC y plantillas en phtml para la generación de vistas. URLs Semánticas: Todas las rutas son semánticas para mejorar la usabilidad y SEO.

## Instrucciones para importar la base de datos en PHPMyAdmin

- Abre [phpMyAdmin](http://localhost/phpmyadmin/) en tu navegador.
- Crea una nueva base de datos llamada db_tiendaComputacion.
- Selecciona la base de datos db_tiendComputacion.
- Haz clic en la pestaña Importar.
- Haz clic en Seleccionar archivo y elige el archivo database/db_tiendaComputacion.sql de este proyecto.
Presiona Continuar para importar las tablas y datos.

### Usuario: webadmin
### Contraseña: admin

-  Este sitio esta configurado para realizar un auto deploy de la base de datos, por lo que para acceder al sitio solo es necesario tener corriendo [Apache](https://www.apachefriends.org/) y clonar este repositorio en la carpeta htdocs.