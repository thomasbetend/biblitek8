PHONY: help

help:

install:
	symfony composer install
	symfony console doctrine:database:create
	make rebuild

rebuild:
	symfony console doctrine:database:drop -f
	symfony console doctrine:database:create
	symfony console doctrine:schema:update -f
	symfony console doctrine:fixtures:load -n