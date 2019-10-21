## Installation

- Après clone de ce projet
```
    composer install
    docker-compose up
```

- Importer le fichier upgrade.sql
```
    docker-compose exec mysql mysql -uroot -proot
    use crm;
    source ./upgrade.sql
```

- Tests fonctionnels et unitaires du web service
```
    composer test-validator
```

- Se rendre à l'adresse
```
    http://localhost:1025
```
