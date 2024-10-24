# Load the .env file and set the HEROKU_APP_NAME variable
include .env
export $(shell sed 's/=.*//' .env)

# Define a deployment target
deploy:
	@echo "Deploying to Heroku app: $(HEROKU_APP_NAME)"
	git push heroku feature/qr-codes:main
	heroku run "npm install" --app $(HEROKU_APP_NAME)
	heroku run "npm run build" --app $(HEROKU_APP_NAME)
	heroku run "php artisan migrate --seed" --app $(HEROKU_APP_NAME)
