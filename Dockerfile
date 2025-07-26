# Usa una imagen oficial de PHP con servidor embebido
FROM php:8.2-cli

# Copia los archivos de tu proyecto al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Expone el puerto 8080
EXPOSE 8080

# Inicia el servidor embebido de PHP
CMD ["php", "-S", "0.0.0.0:8080"]
