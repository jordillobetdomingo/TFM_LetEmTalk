Project LetEmTalk

Command for starting the services

	sudo docker-compose up -d


Command for installing packages for the project

	sudo docker exec -it project_php_1 composer update -d /code

Command for ending the services

	sudo docker-compose down
