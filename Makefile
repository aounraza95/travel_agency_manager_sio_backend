.PHONY: help setup dev serve migrate seed test clean

help: ## Show this help menu
	@echo "Usage: make [target]"
	@echo ""
	@echo "Targets:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}'

setup: ## Full project setup (install deps, config env, migrate, build assets)
	@echo "Starting project setup..."
	composer install
	@php -r "file_exists('.env') || copy('.env.example', '.env');"
	php artisan key:generate
	php artisan migrate:fresh --seed
	npm install
	npm run build
	@echo "Setup complete!"

dev: ## Run development server (Laravel + Vite)
	npm run dev

serve: ## Start Laravel development server
	php artisan serve

migrate: ## Run database migrations
	php artisan migrate

seed: ## Seed the database with sample data
	php artisan db:seed

test: ## Run tests
	php artisan test

clean: ## Clear caches and logs
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
	php artisan cache:clear
	@echo "Caches cleared!"
	rm -f storage/logs/*.log
	@echo "Logs removed!"
