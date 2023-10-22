run: docker-compose up -d
-------------------------
install laravel: docker-compose run --rm composer create-project laravel/laravel .
-------------------------
run artisan: docker-compose run --rm artisan migrate
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