##
# TALL Stack Development Commands
##

.PHONY: help build up down shell install migrate fresh seed test

help: ## Show this help message
	@echo 'Usage: make [target]'
	@echo ''
	@echo 'Targets:'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## Build Docker containers
	docker-compose build --no-cache

up: ## Start all services
	docker-compose up -d

down: ## Stop all services
	docker-compose down

logs: ## View logs
	docker-compose logs -f

shell: ## Access app container shell
	docker-compose exec app bash

install: ## Install Laravel with Jetstream
	docker-compose exec app bash install-laravel.sh

migrate: ## Run database migrations
	docker-compose exec app php artisan migrate

fresh: ## Fresh migration with seeding
	docker-compose exec app php artisan migrate:fresh --seed

seed: ## Run database seeders
	docker-compose exec app php artisan db:seed

test: ## Run tests
	docker-compose exec app php artisan test

npm-dev: ## Start Vite dev server
	docker-compose --profile dev up node

npm-build: ## Build assets for production
	docker-compose exec app npm run build

cache-clear: ## Clear all caches
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:clear
	docker-compose exec app php artisan view:clear

optimize: ## Optimize for production
	docker-compose exec app php artisan config:cache
	docker-compose exec app php artisan route:cache
	docker-compose exec app php artisan view:cache

status: ## Show container status
	docker-compose ps

restart: ## Restart all services
	docker-compose restart