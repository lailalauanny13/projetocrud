# 1. Usando a imagem oficial do PHP com Apache (perfeita para projetos com páginas .php soltas)
FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql