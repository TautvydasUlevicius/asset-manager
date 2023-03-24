# asset-manager

Goal of this task is not to spend to much time but write the application
in such a way that it would showcase how would I implement such functionality.

* Steps that were skipped to save time
  * Api documentation was not written to save time. (Would write open api spec, previously known as swagger)

# prerequisites
* docker installed in local machine

# running the application
1. Pull the application from github
2. Copy .env.dist to .env 
3. Run `docker-compose up -d --build`
4. To run linter run ```composer php-cs-fixer```
5. Start database by running ```docker-compose up -d```
6. Run migrations by executing ```bin/console doctrine:migrations:migrate```
