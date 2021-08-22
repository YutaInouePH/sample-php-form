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
```shell
MAIL_MAILER=smtp
MAIL_HOST=mail.smtp.sample
MAIL_PORT=587
MAIL_USERNAME=sample_user@sample.com
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
```

For the ALLOWED_HOST, change it according to the server's domain name.
```shell
# for localhost
ALLOWED_HOST=localhost

# for other domains.
ALLOWED_HOST=www.your-site.com
```

## How to clone privately. 
Clone repositry, but privately.
```bash
# Clone with bare mode.
$ git clone --bare https://github.com/YutaInoueCommudePH/sample-php-form.git

# Change directory to the cloned project.
$ cd sample-php-form.git

# Create a private repository in Bitbucket.
# And push using mirror to the private repository.
$ git push --mirror git@bitbucket.com:yourname/yourrepo # replace here with bitbucket's repository.

# Remove project temporarily as it's still connected to my repository.
$ cd ../
$ rm -rf hoge.git

# Finally clone from your own remote repository.
$ git clone https://username@bitbucket.org/username/bitbucket-private-repository.git
```

## Directory Structure. 
- docker
    - Contains the Dockerfile and docker-compose to setup apache environment.
- htdocs/dist
    - This is where the html file is stored at. Since I only used bootstrap, there's no scss source, but I assume that Web team will be utilizing them. So I created the same strucutre based from other projects.
- htdocs/dist/contact
    - The basic contact page is written here.
- htdocs/dist/vendor
    - The composer library folder. This is not tracked in git, so please follow the "Install composer library" step. When uploading to test server, include the folder as well and it should be the same level with contact.

## Customize form. 
Edit the _function.php's fields function to change the input's data. 
```php
function fields()
{
    // Change array here accordingly to the <input name="">'s name attribute.
    // _token should always be available.
    return [
        '_token', 'field1', 'field2', 'field3', 'field4', 'etc'
    ];
}
```
Make sure that the `_token` stays the same.

For sending the email, please check on `function sendMail()` from _function.php
Out of the box, it will send a simple reply mail for admin and user.
To edit these, you'll need to modify the following code. 
```php
# admin's email address for sending to admin. (Line #26 as of 2021/08/22)
$admin_to = 'admin@sample.com';
```
```php
function mailDetail($input)
{
    // All of Subject, Mail Body is contained here. 

    $subject_admin = "This is the mail's subject that will display on admin side.";

    // From the current code, it's doing <br><br> for every new line. It will depend on the specification from your director.
    // I've concatinated for each input.
    $mail_text_admin = "This is a the mail's body that will display on admin side.";

    $subject_user = "This is the mail's subject that will display on user side.";

    // From the current code, it's doing <br><br> for every new line. It will depend on the specification from your director.
    // I've concatinated for each input.
    $mail_text_user = "This is a the mail's body that will display on user side.";
}
```