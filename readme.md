# BiciAPP

REST Api
## About Laravel

Un cliente, que distribuye accesorios para bicicleta, ha solicitado que otros proveedores pueden acceder a la información de los productos que se encuentran su sitio web. Por lo tanto, se nos ha pedido que desarrollemos el método que cualquiera pueda usar para consultar esta información.
Los accesorios que maneja cuentan con las siguientes características:

- SKU
- Descripción
- País de origen
- Fabricante

Categoría de accesorio (luces, frenos, bocinas, canastas o asientos).
Cada producto cuenta con una colección de imágenes y al menos un documento pdf donde se muestran las características del producto.
La aplicación requiere de un método para actualizar cualquiera de los datos de un producto determinado y un método para eliminar los productos que dejen de estar a la venta.

## Instalación

Para el siguiente ejercicio se usaron las siguientes tecnologías

- Laravel 5.7
- MariaDB
- NginX
- VueJS

Para instalar el proyecto primero es necesario copiar el archivo .env.example y nombrarlo .env. 
En este archivo se deben de poner las variables de la base de datos a la que se va a conectar. 

- composer install
- php artisan migrate
- yarn install
- yarn run prod

## REST API

