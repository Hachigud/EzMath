From php:8.0.6-apache-buster
RUN apt-get update
COPY web/ /var/www/html
MAINTAINER rafa
RUN apt-get update && docker-php-ext-install pdo_mysql
EXPOSE 80
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]