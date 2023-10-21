run: docker-compose up -d
-------------------------
install laravel: docker-compose run --rm composer create-project laravel/laravel .
-------------------------
run artisan: docker-compose run --rm artisan migrate
-------------------------