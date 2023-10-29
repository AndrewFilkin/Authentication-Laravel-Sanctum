# Run Laravel with Docker Compose

Copy git repository
```
git clone https://github.com/AndrewFilkin/docker-laravel.git name_project
```

`cd` project folder and run docker 

```bash
docker-compose up -d
```

Install laravel 

```
docker-compose run --rm composer create-project laravel/laravel .
```

run artisan command <br/>
```bash
docker-compose run --rm artisan migrate
```

## Redis
Download library

```bash
docker-compose run --rm composer require predis/predis
```

Change `.env` <br/>

```
REDIS_HOST=redis
REDIS_PASSWORD=null
#REDIS_PORT=6379
```

Change config/database.php <br/>

```
'redis' => [
        'client' => env('REDIS_CLIENT', 'predis'),
        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_'),
        ],
        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],
        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],
    ],
```

## Testing

Change `.env` <br/>

```
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```
Other connection need to comment out <br/>

In file `phpunit.xml` uncomment lines <br/>

```
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```


