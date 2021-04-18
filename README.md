BankApi
This project is the backend of the WEB <a href="https://github.com/igormarti/bank_frontend">back</a>  application that was developed with VueJS

- [Setup](#setup)
- [Run the application](#run the application)

Requirements:
   <ul> 
    <li><a href="https://getcomposer.org/">Composer</a></li>
   </ul>
   
Recommendations:
   <ul> 
    <li><a href="https://www.sqlite.org/index.html">Sqlite</a></li>
   </ul

## Setup
1 - Inside your project folder do:
```shell
composer install
```
2 - Create sqlite database database file, execute the following command in database folder:
```shell
sudo touch database.sqlite
```
3 - Run the following command in root folder to migrate the tables:
```shell
php artisan migrate
```
4 - Run the following command in root folder to create fake data:
```shell
php artisan db:seed
```
## Run the application
Run the following command for start application:
```shell
php artisan serve
```
