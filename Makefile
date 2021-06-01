delete_all:
	docker-compose down 
	docker rm -f $(docker ps -a -q)
	docker volume rm $(docker volume ls -q)

rm_vols:
	docker volume rm $(docker volume ls -q)

start:
	docker-compose up -d

shell:
	 docker exec -it recipebook_www_1 bash

dbshell:
	 docker exec -it recipebook_db_1 bash

sql:
	 docker exec -it recipebook_db_1 mysql -uroot -p

populate:
	docker exec -it recipebook_db_1 apt-get update && docker exec -it recipebook_db_1 apt-get install -y python3 python3-pip && docker exec -it recipebook_db_1 pip3 install mysql-connector-python && docker exec -it -w /data recipebook_db_1 python3 populate.py

build:
	docker compose up -d
