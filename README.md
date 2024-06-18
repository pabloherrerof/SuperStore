
# SuperStore

Proyecto elaborado con Laravel, React, Inertia y MySQL para la gestión de productos, clientes y categorias. Tiene un servicio API REST para el consumo de los productos asociados para cada cliente.




## Run Locally

Clone the project

```bash
  git clone https://github.com/pabloherrerof/SuperStore.git
```

Go to the project directory

```bash
  cd SuperStore
```

Run docker
```bash
  ./vendor/bin/sail up
```

Run migrations
```bash
  ./vendor/bin/sail php artisan migrate
```


Run database seeders
```bash
  ./vendor/bin/sail php artisan db:seed
```



## Authentication Info

Admin: 

    email: admin@admin.admin 

    password: admin

User: 

    email: user@user.user 

    password: user





## API Reference

#### API login

```http
  POST /api/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. |
| `password` | `string` | **Required**. |

#### Get Products (Token Bearer Auth) and Accept: application/json

```http
  GET /api/products
```

#### Get Product (Token Bearer Auth) and Accept: application/json

```http
  GET /api/product/{product}
```

#### Get Categories and products (Token Bearer Auth) and Accept: application/json

```http
  GET /api/categories
```

#### Get Category (Token Bearer Auth) and Accept: application/json

```http
  GET /api/categories/{category}
```




## Authors

- [@pabloherrerof](https://github.com/pabloherrerof)

