FROM  yiisoftware/yii2-php:8.1-apache

COPY . /app

RUN composer update
RUN chmod -R 777 /app