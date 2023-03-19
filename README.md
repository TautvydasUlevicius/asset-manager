# asset-manager

Goal of this task is not to spend to much time but write the application
in such a way that it would showcase how would I implement such functionality.

* Steps that were skipped to save time
  * Application was not dockerized to save time.
  * Api documentation was not written to save time. (Would write open api spec, previously known as swagger)

# prerequisites
* php installed in local machine
* composer installed in local machine
* symfony cli installed in local machine
* docker installed in local machine

# running the application
1. Pull the application from github
2. Copy .env.dist to .env 
3. Run composer install 
4. To run linter run ```composer php-cs-fixer```
5. Start database by running ```docker-compose up -d```
6. Run migrations by executing ```bin/console doctrine:migrations:migrate```
7. Start the application by running symfony server:start
