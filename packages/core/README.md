# Setup package core to project
### 1. Add repositories to file composer.json
```angular2html
"repositories": [
        {
            "type": "path",
            "url": "./packages/core"
        }
    ]
```

### 2. Run command
```composer require messi/core```

# Setup api
 ```run command: php artisan jwt:secret```