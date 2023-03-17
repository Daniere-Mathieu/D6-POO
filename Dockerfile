FROM php:8.0-cli

RUN apt-get update && docker-php-ext-install pdo pdo_mysql

COPY ./tp/ /usr/src/myapp/

WORKDIR /usr/src/myapp/


EXPOSE 80

# CMD ["php", "-S", "0.0.0.0:80", "-t", "/usr/src/myapp/"]

CMD ["php", "-S", "0.0.0.0:80","/usr/src/myapp/index.php"]
