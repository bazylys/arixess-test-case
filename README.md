
## Run Locally

Clone the project

```bash
  git clone https://github.com/bazylys/arixess-test-case my-folder
```

Go to the project directory

```bash
  cd my-folder
```

Init env file

```bash
  cp .env.example .env
```

Install dependecies

```bash
  docker run --rm \
    -v "$(pwd)":/opt \
    -w /opt \
    laravelsail/php81-composer:latest \
    composer install
```


To run this project, you will need to add the following environment variables to your .env file
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

Start container

```bash
  ./vendor/bin/sail up
```

### Open another terminal tab

Make laravel configuration

```bash
  ./vendor/bin/sail artisan key:generate
  ./vendor/bin/sail artisan migrate
  ./vendor/bin/sail artisan storage:link
  ./vendor/bin/sail npm install
  ./vendor/bin/sail npm run dev
  ./vendor/bin/sail artisan queue:work          // should be working
```

### Manager user

If you want to create default manager user with credentials

| Email | Password     |
| :-------- | :------- |
| `manager@arixess` | `Arixess1` |

run:
```bash
./vendor/bin/sail artisan db:seed --class=ManagerSeeder
```

OR you can create it by yourself using:

```bash
./vendor/bin/sail artisan manager:create
```
### 🚀 Your project located:

**Main page:** http://localhost

**Mailhog:** http://localhost:8025/
