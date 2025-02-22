# This is a Makefile
# Run `make <command>` to quickly execute predefined commands
up:
	docker-compose up -d

down:
	docker-compose down

clear:
	docker-compose exec laravel php artisan config:clear
	docker-compose exec laravel php artisan cache:clear

migrate:
	docker-compose exec laravel php artisan migrate

seed:
	docker-compose exec laravel php artisan db:seed

test:
	docker-compose exec -e DB_DATABASE=laravel_test laravel vendor/bin/phpunit
