# TPEspecial-web2-2025


## Nombres de los integrantes del grupo (emails):
 - Lucia Moreira -> lulii.moreira96@gmail.com
 - Manuel Montoya -> montoya.christensen@outlook.com
   
##Temática del TPE -> Breve descripción de la temática:
 - venta de productos informaticos, incluye vendedor y ventas. relacion 1 -> N
 #### la tabla vendedor tiene:
 - un id, un nombre, un telefono y un email
 #### la tabla venta tiene:
 - un id, un producto, un precio, una fecha de venta, y el id del vendedor que realizo la venta


## El diagrama entidad relación (DER) del modelo de datos planteado (archivo jpeg o pdf):

<img width="636" height="339" alt="Diagrama Entidad-Relacion" src="./DER tienda.jpg" />

TPE - Parte 2: Sitio Web Dinámico

Este proyecto en un sitio web dinámico que permite la visualización y administración de ventas y vendedores. Los usuarios pueden acceder a un listado de ellos sin necesidad de iniciar sesión, mientras que solo el administrador tiene acceso a una sección restringida que puede modificar, editar o eliminar un item.

usuario:webadmin HASH: $2y$10$3lLnMvtZDc6XmA1p34CgoekFeWzk6RfIApomoH4JR3Z8tzeVOWxPK Contraseña: admin

En el home para usuario no logueados, o logueados sin ser rol=administrador se muestran las ventas con su producto y valor, en la seccion de vendedores, su nombre, mail y telefono. Hay una seccion para buscar una venta por nombre del producto.


Cuando el administrador ingresa con el usuario admin y la contraseña webadmin puede agregar, editar y eliminar ítems, ya que vera los botones para realizar dichas acciones.

Se uso Apache, Base de Datos: MySQL, Estructura de Archivos: MVC y plantillas en phtml para la generación de vistas. URLs Semánticas: Todas las rutas son semánticas para mejorar la usabilidad y SEO.

