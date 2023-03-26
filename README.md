# asset-manager

* To do's
  1. Api documentation (Write open api spec, previously known as swagger)
  2. Implement github workflow / actions
  3. User auth. Now lets asume auth is happening somewhere else and after succesful auth request gets 
  directed to this service and we just receive header which helps identify the user trying to reach a resource
  4. Listeners: Add listener so that instead of handeling ApiException in controller, from controller we could
  throw this exception, this would be caught by listener and handeled properly.
  5. Proper handling of request object to controller.
  6. Request validators

In this application I allow myself to edit commited migration files. Normally after migrations are 
commited and merged you would not touch them, you would create new migration files. But let us assume
that this application is in its initial setup faze and even infrastructure is not prepared.

# prerequisites
* docker installed in local machine

# running the application
1. Pull the application from github
2. Copy .env.dist to .env 
3. Run `docker-compose up -d --build`
   * This will start PHP, NGINX, Database containers
4. In container asset-manager-php run ```composer install```
5. In container asset-manager-php run ```bin/console doctrine:migrations:migrate```
6. To run linter run ```composer php-cs-fixer```
