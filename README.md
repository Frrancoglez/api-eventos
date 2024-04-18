# API EVENTOS

Gracias por revisar mi proyecto desarrollado en Laravel. A continuación, encontrarás las instrucciones para ejecutar la solución y las evidencias que demuestran su funcionamiento. 
  
Este proyecto consiste en el desarrollo de un servicio que simula la gestión de tickets para eventos artísticos, exponiendo una API REST a través de HTTP para el registro/asignación de turnos.

## Instalacion

- Clona este repositorio en tu máquina local.
- Ejecuta composer install para instalar las dependencias de Laravel.
- Ejecuta ***php artisan migrate*** para ejecutar las migraciones y crear las tablas en la base de datos.

  
## Uso 

- Inicia el servidor ejecutando ***php artisan serve***.
- Descarga la colección de Postman.
- Importa la colección en Postman para interactuar con la API.

## Colección POSTMAN

- **https://github.com/Frrancoglez/colecci-n-POSTMAN**

## Imagenes y Funcionamiento

- Con el metodo **GET** y el endpoint **/empleados** la API devuelve un listado de empleados registrados en la base de datos: [Imagen Empleados](https://github.com/Frrancoglez/im-genes/blob/main/empleados.png)    
- Con el Metodo **GET** el endpoint **/turnos** la API devuelve un listado de turnos registrados en la base de datos: [Imagen Turnos](https://github.com/Frrancoglez/im-genes/blob/main/turnos.png)  
- Con el metodo **GET** y el endpoint **/oncall** la API compara el ID de los empleados y con el ID de los empleados que estan en turno para devolver un listado de empleados que no se encuentran en turno para ser llamados: [Imagen onCall](https://github.com/Frrancoglez/im-genes/blob/main/onCall.png)  
- Con el metodo **POST** y el endpoint **/assign** la API valida la fecha y el ID del empleado para crear el nuevo turno. Si se proporciona un ID no valida la API devolvera un error **400**. Si el empleado existe en la base de datos, la API recupera los datos del empleado correspondiente al ID proporcionado y registra el nuevo turno en la base de datos: [Imagen Assign](https://github.com/Frrancoglez/im-genes/blob/main/assign.png) - [Imagen Assign Error](https://github.com/Frrancoglez/im-genes/blob/main/assignError.png)  
- Con el metodo **GET** y el endpoint **/all** la API compara la columna fecha de los registros de turnos con el mes de la fecha actual. Filtra los turnos que coinciden con el mes actual y recupera el ID de los empleados asignados a dichos turnos: [Imagen All](https://github.com/Frrancoglez/im-genes/blob/main/all.png)
