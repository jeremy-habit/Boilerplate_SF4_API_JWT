# Boilerplate SF4 API with JWT

## Get Started

### Clone the project :

```bash
$ git clone https://github.com/jeremy-habit/Boilerplate_SF4_API_JWT.git
```

### Install dependencies :

```bash
$ cd Boilerplate_SF4_API_JWT
$ composer install
```

### Create the database schema :

* Start by configure Doctrine's params in the .env file :
> DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name

* Next type these commands :
```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
```

### Load fixtures :

```bash
$ php bin/console doctrine:fixtures:load
```

Note that you can add an user via the following route : \<ServerAddress>/register. (The server must be running !)
You have to post some params, let's see an example :

```json
{
	"username" : "John Doe",
	"password": "myPassword",
	"email": "John.Doe@gmail.com"
}
```

### Generate the SSH keys (from LexikJWTAuthenticationBundle):

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

## Usage :

### Run the web server :

```bash
$ php bin/console server:run
```

### Get a JWT token :

\<ServerAddress>/login_check. You have to post some params, let's see an example :
Note that in this case the username key target the email's value of the user because I configured it in the secrutiy.yml with the tag "\<property>" inside the entity_provider section. Remove it if you want to target the username and not the email.
```json
{
	"username": "John.Doe@gmail.com",
	"password": "myPassword"
}
```

### Access a secured route :

--coming soon--