


http://localhost:8000/

```
% docker-compose ps   
     Name                    Command               State          Ports        
-------------------------------------------------------------------------------
101_db_1          docker-entrypoint.sh mysqld      Up      3306/tcp, 33060/tcp 
101_wordpress_1   docker-entrypoint.sh apach ...   Up      0.0.0.0:8000->80/tcp

```

Error establishing a database connection



docker-compose rm


docker exec -it [コンテナ名] /bin/bash
docker exec -it 0f9e582d9a49 /bin/bash

vi入ってねーの。


version: "3.7" # docker-composeの書式のバージョン
services: # 以下にサーバ情報を記載
  db: 
    image: mysql:5.6 
    container_name: wp_mysql
    #restart: always 
    environment: 
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: wp_db
      MYSQL_USER: wp_user
      MYSQL_PASSWORD: root

  wp: 
    image: wordpress:latest 
    container_name: wp
    #restart: always 
    depends_on: 
     - db
    ports:
     - "10090:80" 
    environment:
      WORDPRESS_DB_HOST: db:3306 
      WORDPRESS_DB_USER: wp_user 
      WORDPRESS_DB_PASSWORD: root 
      WORDPRESS_DB_NAME: wp_db 
      WORDPRESS_DEBUG : 1  
    volumes:
       - ./html:/var/www/html






