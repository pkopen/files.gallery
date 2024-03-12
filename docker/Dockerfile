FROM bitnami/php-fpm:8.2.12
RUN apt-get update && apt-get install -y --no-install-recommends ffmpeg && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY --chown=daemon:daemon app .
EXPOSE 9000
