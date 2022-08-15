composer-update:
	docker exec my-apotheke-php /usr/local/bin/composer update -d /var/www/app/src --prefer-dist
	docker exec my-apotheke-php /usr/local/bin/composer dump-autoload -d /var/www/app/src -o

docker-rebuild:
	docker-compose -f docker-compose.yml stop
	docker-compose -f docker-compose.yml build
	docker-compose -f docker-compose.yml up -d --remove-orphans

docker-rebuild-local:
	docker-compose -f docker-compose-local.yml stop
	docker-compose -f docker-compose-local.yml build
	docker-compose -f docker-compose-local.yml up -d --remove-orphans

reinstall-demo-data:
	docker exec my-apotheke-php /usr/local/bin/php /var/www/app/src/yii.php migrate/down all --interactive=0
	docker exec my-apotheke-php /usr/local/bin/php /var/www/app/src/yii.php migrate/up --interactive=0
	docker exec my-apotheke-php /usr/local/bin/php /var/www/app/src/yii.php install-demo-data

yii-migrate-down:
	docker exec my-apotheke-php /usr/local/bin/php /var/www/app/src/yii.php migrate/down --interactive=0

yii-migrate-down-all:
	docker exec my-apotheke-php /usr/local/bin/php /var/www/app/src/yii.php migrate/down all --interactive=0

yii-migrate-up:
	docker exec my-apotheke-php /usr/local/bin/php /var/www/app/src/yii.php migrate/up --interactive=0