ENV_FILE=.env

include $(ENV_FILE)

all: $(DOCKER_ENV)

long-wait:
	@echo "Take a long sleep..."
	sleep 20

short-wait:
	@echo "Take a short sleep..."
	sleep 5

dev-seed:
	docker-compose exec church_management_api_app php artisan db:seed

storage-link:
	docker-compose exec church_management_api_app php artisan storage:link

route-list:
	docker-compose exec church_management_api_app php artisan route:list

migrate:
	docker-compose exec church_management_api_app php artisan migrate

rollback:
	docker-compose exec church_management_api_app php artisan migrate:rollback

autoload:
	docker-compose exec church_management_api_app composer dump-autoload -o

app-key:
	docker-compose exec church_management_api_app php artisan key:generate

install:
	composer install

up:
	docker-compose up -d

build-dev:
	docker-compose build

dev: build-dev up install app-key storage-link long-wait migrate short-wait dev-seed

down:
	docker-compose down

down-v:
	docker-compose down -v

pull-prod:
	git pull origin master

pull-staging:
	git pull origin staging

build:
	docker-compose -f docker-compose.$(DOCKER_ENV).yml down -v \
	&& docker-compose -f docker-compose.$(DOCKER_ENV).yml build \
	&& docker-compose -f docker-compose.$(DOCKER_ENV).yml up -d \
	&& docker-compose -f docker-compose.$(DOCKER_ENV).yml exec church_management_api_app php artisan storage:link

cache:
	docker-compose -f docker-compose.$(DOCKER_ENV).yml exec church_management_api_app php artisan config:cache \
	&& docker-compose -f docker-compose.$(DOCKER_ENV).yml exec church_management_api_app php artisan route:cache

prod: pull-$(DOCKER_ENV) build cache

staging: pull-$(DOCKER_ENV) build cache
