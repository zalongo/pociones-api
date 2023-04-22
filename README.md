# API de Posiones en Laravel

Este proyecto es una API de pociones construida en Laravel que se conecta a una base de datos MySQL. Puede utilizarse para gestionar y controlar pociones y remedios naturales, sus ingredientes, clientes y ventas.

## Requisitos previos

Antes de empezar, asegúrese de tener instalado lo siguiente en su sistema:

-   [PHP](https://www.php.net/downloads)
-   [Composer](https://getcomposer.org/download/)
-   [MySQL](https://www.mysql.com/downloads/)
-   [Laravel](https://laravel.com/docs/8.x/installation)

## Instalación

1. Clonar este repositorio en su máquina local:

```bash
git clone https:   //github.com/zalongo/pociones-api
```

2. Entrar en el directorio del proyecto:

```bash
cd pociones-api
```

3. Instalar las dependencias de Laravel utilizando Composer:

```bash
composer install
```

4. Crear un archivo `.env` utilizando el archivo de ejemplo `.env.example`:

```bash
cp .env.example .env
```

5. Generar una clave de aplicación en el archivo `.env`:

```bash
php artisan key: generate
```

6. Configurar las variables de entorno en el archivo `.env`, incluyendo los detalles de conexión a la base de datos MySQL:

```bash
DB_CONNECTION = mysql
DB_HOST       = 127.0.0.1
DB_PORT       = 3306
DB_DATABASE   = nombre_de_la_base_de_datos
DB_USERNAME   = nombre_de_usuario
DB_PASSWORD   = contraseña
```

7. Ejecutar las migraciones de la base de datos para crear las tablas necesarias:

```bash
php artisan migrate
```

8. Iniciar el servidor de desarrollo de Laravel:

```bash
php artisan serve
```

9. La API estará disponible en `http://127.0.0.1:8000/`.

## Uso

Cada endpoint acepta y devuelve datos en formato JSON.

## Endpoints

### Login

- Método HTTP       : POST
- URI               : /api/auth/login
- Descripción       : Este endpoint permite a los usuarios iniciar sesión en la aplicación.
- Ejemplo de entrada:

```json
{
  "email"   : "user@test.cl",
  "password": "12345678"
}
```

Returns: A token.


### Logout

- Método HTTP: POST
- URI        : /api/auth/logout
- Descripción: Este endpoint permite a los usuarios cerrar sesión en la aplicación.

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A confirmation message.

### User

- Método HTTP: GET
- URI        : /api/user
- Descripción: Este endpoint permite a los usuarios obtener sus datos de usuario autenticados.

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A user data.

### Get Clients

Retrieves a list of all clients in the database.

Endpoint: GET /api/clients

Optional Filters: ?limit=10&page=1
Params   Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A list of all clients.

### Show Client

Retrieves a specific client's data by providing their ID.

Endpoint: GET /api/clients/{client_id}

Params Example:

```json
{
 	"Authorization": "Bearer xxxtokenxxx"
}
```

Returns: The client's data.

### Store Client

Adds a new client to the database.

Endpoint: POST /api/clients

Params Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx",
	"body": {
		"name" : "Guacolda",
		"email": "guacolda@test.cl"
	}
}
```

Returns: A confirmation message and the client's data.

### Update Client

Updates an existing client in the database by providing their ID.

Endpoint: PUT /api/clients/{client_id}

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx",
	"body": {
		"name" : "Guacolda esposa de Lautaro",
		"email": "guacolda@test.cl"
	}
}
```

Returns: A confirmation message and the updated client's data.

### Delete Client

Deletes an existing client from the database by setting their status to inactive.

       Endpoint: DELETE /api/clients/{client_id}

Params Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A confirmation message.

### Get Ingredients

Retrieves a list of all ingredients in the database.

Endpoint: GET /api/ingredients

Optional Filters: ?limit=10&page=1
Params   Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A list of all ingredients.

### Show Ingredient

Retrieves a specific ingredient's data by providing their ID.

Endpoint: GET /api/ingredients/{ingredient_id}

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx"
}
```

Returns: The client's data.

### Store Ingredient

Adds a new ingredient to the database.

Endpoint: POST /api/ingredients

Params Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx",
  "body": {
    {
		 "name" : "Limón",
		 "price": 1200,
		 "stock": 500
	 }
  }
}
```

Returns: A confirmation message and the ingredient's data.

### Update Ingredient

Updates an existing ingredient in the database by providing their ID.

Endpoint: PUT /api/ingredients/{ingredient_id}

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx",
	"body": {
		"name" : "Limón",
		"price": 1200,
		"stock": 30
	}
}
```

Returns: A confirmation message and the updated ingredient's data.

### Delete Ingredient

Deletes an existing ingredient from the database by setting their status to inactive.

Endpoint: DELETE /api/ingredients/{ingredient_id}

Params Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A confirmation message.

### Get Potions

Retrieves a list of all potions in the database.

Endpoint: GET /api/potions

Optional Filters: ?limit=10&page=1
Params   Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A list of all potions.

### Show Potion

Retrieves a specific potion's data by providing their ID.

Endpoint: GET /api/potions/{potion_id}

Params Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: The client's data.

### Store Potion

Adds a new potion to the database.

Endpoint: POST /api/potions

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx",
	"body": {
		"name": "Agua Para Resfrio",
		"ingredients": [
			{
				"ingredient_id": 11,
				"quantity"     : 0.3
			},
			{
				"ingredient_id": 12,
				"quantity"     : 0.1
			},
			{
				"ingredient_id": 13,
				"quantity"     : 0.4
			}
		]
	}
}
```

Returns: A confirmation message and the potion's data.

### Update Potion

Updates an existing potion in the database by providing their ID.

Endpoint: PUT /api/potions/{potion_id}

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx",
	"body": {
		"name": "Agua Para Resfrio",
		"ingredients": [
			{
				"ingredient_id": 11,
				"quantity"     : 0.3
			},
			{
				"ingredient_id": 12,
				"quantity"     : 0.1
			}
		]
	}
}
```

Returns: A confirmation message and the updated potion's data.

### Delete Potion

Deletes an existing potion from the database by setting their status to inactive.

Endpoint: DELETE /api/potions/{potion_id}

Params Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A confirmation message.

### Get Sales

Retrieves a list of all sales in the database.

Endpoint: GET /api/sales

Optional Filters: ?limit=10&page=1&client=1
Params   Example:

```json
{
  "Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A list of all sales.

### Show Sale

Retrieves a specific sale's data by providing their ID.

Endpoint: GET /api/sales/{sale_id}

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx"
}
```

Returns: The client's data.

### Store Sale

Adds a new sale to the database.

Endpoint: POST /api/sales

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx",
	"body": {
		"client_id": 5,
		"potions"  : [
			{
				"potion_id": 1,
				"quantity" : 3
			},
			{
				"potion_id": 2,
				"quantity" : 1
			}
		]
	}
}
```

Returns: A confirmation message and the sale's data.

### Update Sale

Updates an existing sale in the database by providing their ID.

Endpoint: PUT /api/sales/{sale_id}

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx",
	"body": {
		"client_id": 5,
		"potions"  : [
			{
				"potion_id": 1,
				"quantity" : 3
			},
			{
				"potion_id": 2,
				"quantity" : 1
			}
		]
	}
}
```

Returns: A confirmation message and the updated sale's data.

### Delete Sale

Deletes an existing sale from the database by setting their status to inactive.

Endpoint: DELETE /api/sales/{sale_id}

Params Example:

```json
{
	"Authorization": "Bearer xxxtokenxxx"
}
```

Returns: A confirmation message.

## Uso de los archivos en /SCRIPTS/requests

En la carpeta /SCRIPTS/requests se encuentran los archivos que permiten realizar las consultas a los distintos endpoints. Estos archivos funcionan con el plugin "REST Client" por Huachao Mao para VSCode.

Para utilizar estos archivos, abra VSCode y abra el archivo correspondiente al endpoint que desea probar. Luego, haga clic en el botón "Send Request" que aparece en la parte superior derecha del editor. La respuesta de la API aparecerá en la pestaña "Response" en la parte inferior del editor.

## Tests

La API fue desarrollada utilizando TDD (Desarrollo Dirigido por Pruebas). Para ejecutar los tests, ejecute el siguiente comando:

```bash
php artisan test
```
