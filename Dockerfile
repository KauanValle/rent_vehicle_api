# Imagem base com PHP 8.0
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar o Composer
COPY --from=composer:2.7.7 /usr/bin/composer /usr/bin/composer

# Configurar o diretório do aplicativo
WORKDIR /var/www/html

# Copiar os arquivos do projeto (se houver)
COPY . /var/www/html

# Alterar permissões
RUN chown -R www-data:www-data /var/www/html

# Expor a porta padrão
EXPOSE 9000

# Iniciar o PHP-FPM
CMD ["php-fpm"]