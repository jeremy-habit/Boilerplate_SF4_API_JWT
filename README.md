# Boilerplate SF4 API with JWT

## Get Started

### Clone the project

```bash
$ git clone https://github.com/jeremy-habit/Boilerplate_SF4_API_JWT.git
```

### Install dependencies

```bash
$ cd Boilerplate_SF4_API_JWT
$ composer install
```

### Create the database schema

* Start by configure Doctrine's params in the .env file :
> DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name

* Next type these commands :
```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
```

> or with migrations method
```bash
$ php bin/console doctrine:database:create
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
```

### Generate the SSH keys (from LexikJWTAuthenticationBundle

```bash
$ mkdir -p config/jwt # For Symfony3+, no need of the -p option
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

In case first openssl command forces you to input password use following to get the private key decrypted

```bash
$ openssl rsa -in config/jwt/private.pem -out config/jwt/private2.pem
$ mv config/jwt/private.pem config/jwt/private.pem-back
$ mv config/jwt/private2.pem config/jwt/private.pem
```

## Usage

### Run the web server

```bash
$ php bin/console server:run
```

### Register a new user

> Params example

```json
{
	"username" : "John Doe",
	"password" : "myPassword",
	"email" : "john.doe@gmail.com",
	"last_name" : "Doe",
	"first_name" : "John"
}
```

> With curl

````bash
$ curl -X POST http://localhost:8000/register -d "{\"username\":\"john\",\"password\":\"doe\",\"email\":\"john.doe@gmail.com\",\"last_name\":\"Doe\",\"first_name\":\"John\"}" -H "Content-Typ
e: application/json"
````

> Or use fixtures

```bash
$ php bin/console doctrine:fixtures:load
```

### Get a JWT token


> Params example

```json
{
	"username" : "John.Doe@gmail.com",
	"password": "myPassword"
}
```

> With curl

Note that in this case the username key target the email's value of the user because I configured it in the secrutiy.yml with the tag "\<property>" inside the entity_provider section. Remove it if you want to target the username and not the email.

````bash
$ curl -X POST http://localhost:8000/login_check -d "{\"username\":\"john.doe@gmail.com\",\"password\":\"myPassword\"}" -H "Content-Typ
e: application/json"
````

### Access a secured route

````bash
$ curl -H "Authorization: Bearer <token here>" http://localhost:8000/api
````