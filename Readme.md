Para ejecutar el docker compose. Primero levantar los servicios

	sudo docker-compose up -d

Ejecutar composer para instalar los componentes necesarios

	sudo docker exec -it project_php_1 composer update -d /code

Ejecutar el servidor de symfony

	sudo docker exec -it project_php_1 symfony server:start --dir=/code

Aturar las maquinas del docker compose.

	sudo docker-compose down
