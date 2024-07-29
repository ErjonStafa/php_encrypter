## Php Encrypter for laravel

### Usage
Encryption for php files of the laravel project.<br>

<p style="color: red">Please read before using</p>

This is meant to be used only one time when the project is installed.<br>
Modifications inside the folders of this package will result in failure of running the project.<br>
To decrypt the files, date modification of package files is required.<br>
This package prevents copies of the laravel project if used correctly.<br>


<p style="color: red">It does not work with blade files</p>

### First step
````
Create a copy of your project before proceeding
````

### Installation

````
composer require erjon/php_encrypter
````

### Publish config file

````
php artisan vendor:publish --tag=erjon_encrypter
````

Modify this file to include what folders of the project you have worked

### Encrypt files
````
php artisan project:encrypt
````

Only run this once

### That's it you can run your project like always

### If you want to make changes to the project, you can decrypt the files with the following command
````
php artisan project:decrypt key_provided_in_the_encryption_command
````
