# asset-manager

* Steps that were skipped to save time
  * Api documentation was not written to save time. (Would write open api spec, previously known as swagger)
  * Github workflow / actions implementation

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
