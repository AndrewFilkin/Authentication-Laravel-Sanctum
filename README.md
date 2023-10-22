run: docker-compose up -d
-------------------------
install laravel: docker-compose run --rm composer create-project laravel/laravel .
-------------------------
run artisan: docker-compose run --rm artisan migrate
-------------------------
Testing
-------------------------
add .env
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
other need to comment out
-------------------------
phpunit.xml
uncomment lines
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>