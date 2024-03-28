FROM yiisoftware/yii-php:8.0

# Set environment variables and working directory
ENV ENV_FILE=.env \
    ENV_NAME=prod \
    YII_ENV=${ENV_NAME} \
    APP_ENV=${ENV_NAME}

WORKDIR /app

# Remove the default entrypoint and copy our entrypoint
RUN rm /usr/local/bin/docker-entrypoint.sh

# Copy the entrypoint file to the container
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Copy the .env file and remove it from the image
COPY .env /app/.env
RUN rm .env

# Copy application files
COPY . /app

# Fix permissions
RUN find /app -type d -exec chmod 755 {} \; && \
    find /app -type f -exec chmod 644 {} \;

# Install composer dependencies
RUN composer install --ignore-platform-reqs --no-scripts --prefer-source --optimize-autoloader

# Set local environmental variables; if you use non-local environment variables,
# uncomment this line and create an appropriate file
# ENV-F .env

# Run the application
CMD ["sh", "/usr/local/bin/docker-entrypoint.sh"]