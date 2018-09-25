# BiciAPP

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

Se puede ejecutar el rapidamente el cliente con el comando

php artisan serve

o de lo contrario se tiene que crear un host virtual mediante nginx.

## Dev Server

El servidor de ejemplo se encuentra en Amazon, en el siguiente dominio.

[biciapp.muuyal.net](http://biciapp.muuyal.net)

También existe una vista de ejemplo donde se listan los productos, 
se pueden actualizar, eliminar y crear.

[biciapp.muuyal.net/home](http://biciapp.muuyal.net/home)



## REST API

### GET Items

- Route: /api/accessory
- Method: GET

### Create Item

- Route: /api/accessory
- Method: POST

Response (Example)
```json
    {
        "code": 200,
        "status": "ok",
        "message": "All Accessories",
        "data": {...},
        "catalogues": {...}
    }
```

Send: 
```json
    {
      "sku":string,
      "description":string,
      "category_id":int,
      "country_id":int,
      "producer_id":int
    }
```
Response (Example)
```json
    {
        "code": 200,
        "status": "ok",
        "message": "Show Created!",
        "data": {
        "id": 5,
        "sku": "HGJ1230",
        "description": "Luces de colores",
        "category_id": 1,
        "country_id": 1,
        "producer_id": 1,
        "images":{...},
        "pdfs":{...},
        "deleted_at": null,
        "created_at": "2018-09-25 01:54:42",
        "updated_at": "2018-09-25 01:54:42"
    }
```

### Update Item

- Route: /api/accessory/{{id}}
- Method: PUT

Send: 
```json
    {
      "id":int,
      "sku":string,
      "description":string,
      "category_id":int,
      "country_id":int,
      "producer_id":int
    }
```
Response (Example)
```json
    {
        "code": 200,
        "status": "ok",
        "message": "Accessory Updated!!",
        "data": {
        "id": 5,
        "sku": "HGJ1230",
        "description": "Luces de colores",
        "category_id": 1,
        "country_id": 1,
        "producer_id": 1,
        "images":{...},
        "pdfs":{...},
        "deleted_at": null,
        "created_at": "2018-09-25 01:54:42",
        "updated_at": "2018-09-25 01:54:42",
    }
```

### Update Item

- Route: /api/accessory/{{id}}
- Method: DELETE

Response (Example)
```json
    {
        "code": 200,
        "status": "ok",
        "message": "Accessory Deleted!"
    }
```

## Mejoras

Si bien el proyecto cumple con la función aquí hay una lista de las mejoras que se podrían tener:

- Tener un bucket dedicado para archivos (imágenes, pdfs)
- Cada accesorio podría tener una carpeta en el bucket (s3) donde se guarden las imágenes y pdfs
- Se podrían eliminar las tablas en la BD de los archivos (images, pdfs) y se podría agregar en el modelo un append para traer los archivos directo del bucket
- Se podría mejorar la el ui/ux para cargar directamente pdf e imágenes.