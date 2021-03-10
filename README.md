# highway media

1. Установка:
    - docker-compose build && docker-compose up -d
    - docker-compose exec php bash
    - php init --env=Development --overwrite=a
    - php yii migrate --interactive=0
    
2. API на localhost:4080
3. Swagger на localhost:6080
4. Токены в app/api/config/params-local.php (header X-TESTAPI-TOKEN, дефолтные токены 111, 222)