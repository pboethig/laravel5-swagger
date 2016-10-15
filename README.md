 #Project Laravel REST API with Swagger Api-Doc 
### Create a api documentation for you webservice from swagger annotations

##Prerequits:
* node.js istalled
* npm installed
* laravel >=5.3 installed
* apache =>2.4 or ngjnx intalled
* composer installed

##Installation:
* simply clone this repository

* ```
composer install
```

##Install swagger-ui
* 
[visit homepage to install](http://swagger.io/swagger-ui/)

##Usage
###Search-API
Surf to <your pojectroot>/Api/public/Api/search/4

###API
Surf to <your pojectroot>/Api/public/Api/search/4

### Swagger-Ui 
Open dist/index.html with your browser 

The Url to your swagger.json is 
<laravelroot>/storage/api-docs/api-docs.json

###Modify Apache vhost
To prevent CORS Problems you can simply activate CORS Requests like that
* open your sites-enabled and add the header configuration like so:


```
<Directory /var/www/html>
                Header set Access-Control-Allow-Origin "*"
                Options Indexes FollowSymLinks
                AllowOverride All
                Require all granted
</Directory>
```

* restart apache

