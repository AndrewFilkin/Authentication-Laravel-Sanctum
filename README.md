run: docker-compose up -d
-------------------------
install laravel: docker-compose run --rm composer create-project laravel/laravel .
-------------------------
run artisan: docker-compose run --rm artisan migrate
-------------------------
Redis
-------------------------
docker-compose run --rm composer require predis/predis <br/>
--.env-- <br/>
REDIS_HOST=redis
REDIS_PASSWORD=null
`#REDIS_PORT=6379` <br/>
--config/database.php-- <br/>
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
-------------------------
Testing
-------------------------
add .env <br/>
DB_CONNECTION=sqlite <br/>
DB_DATABASE=:memory: <br/>
other need to comment out
-------------------------
phpunit.xml <br/>
uncomment lines <br/>
`<env name="DB_CONNECTION" value="sqlite"/>` <br/>
`<env name="DB_DATABASE" value=":memory:"/>` <br/>
