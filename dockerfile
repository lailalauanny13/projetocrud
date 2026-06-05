# 1. Usando a imagem oficial do PHP com Apache (perfeita para projetos com páginas .php soltas)
FROM php:8.2-apache

# 2. Habilita o módulo de reescrita do Apache (muito útil para rotas amigáveis no futuro)
RUN a2enmod rewrite

# 3. Instala extensões necessárias para o PHP se conectar ao banco MySQL (Crucial para o seu CRUD)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# 4. Define o diretório padrão onde o Apache procura os arquivos do site
WORKDIR /var/www/html

# 5. Copia todos os arquivos do seu projeto para dentro do container
COPY . /var/www/html/

# 6. O Apache por padrão já expõe a porta 80, então não precisamos forçar o comando CMD de inicialização
EXPOSE 80