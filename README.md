# Setup
## Start localhost (first time)
```bash
$ cd docker
$ docker-compose up -d
```

access localhost:8080 in your browser

## Stop localhost
```bash
$ cd docker
$ docker-compose stop
```

## Start localhost once again
```bash
$ cd docker
$ docker-compose start
```

## Install composer library
```bash
$ docker ps (check for the container name)
$ docker exec -it sample-php-form.apache bash (change the sample-php-form with the container name)
```
```bash
/var/www/html# composer install
```

## Create .env file
```bash
/var/www/html# cd contact
/var/www/html/contact# cp .env.example .env
```
Edit the copied .env file with your SMTP credentails.