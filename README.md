## Setup source

### Step 1
- Clone source from github
- cd to root source
- Run command ```composer install --ignore-platform-req```

### Step 2
- Create file .env from file .env.example
- Run command ```php artisan key:generate```
- Setup data and change config in file .env

### Step 3
- Import file sample.sql to database

### Step 4
- Run command ```php artisan storage:link```

### Step 5
- Goto link /admin/login
- Login with account ```admin@admin.com / 111111```
