# docker version

Image for files.gallery PHP program with ffmpeg extension, built on the bitnami/php-fpm base image.

Replace the relevant paths and other sections as needed.

## build

Run this command and replace it with the desired tag:

```shell
docker build --tag name:version .
```

Such as

```shell
docker build -t gallery:dev .
# or this
docker buildx build --tag gallery:dev .
```

## compose

If you use an Nginx container, you can directly refer to most tutorials.

compose.yaml

```yaml
version: '3'
services:
  app:
    image: gallery:dev
    container_name: gallery
    ports:
      - 9000:9000
    volumes:
      - ./container:/app/static
    # tty: true
```

Resolve permission issues manually for write access (read access is already fine) by setting the permissions of the /app directory in the container to daemon:daemon.

```shell
docker exec -it gallery chown 1:1 -R /app
```

nginx config (This is for the scenario where PHP and Nginx are separated. It would be simpler to configure the same root directory directly.)

```conf
    server {
        listen 443 ssl;
        server_name gallery.kazusa.cc;
        root /srv/docker/gallery/app/static;
        index index.php index.html;
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location = / {
            rewrite ^ /index.php last;
        }

        location /static {
            alias /srv/docker/gallery/container;
        }

        location ~ \.php$ {
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_index index.php;
            fastcgi_buffers 16 16k;
            fastcgi_buffer_size 32k;
            fastcgi_param SCRIPT_FILENAME /app$fastcgi_script_name;
            include fastcgi_params;
        }
    }
```

## Supplementary note

The base image is built on Debian 11, with the default PHP runtime user is daemon:daemon (1:1), and the FPM runtime user is root. For more details, refer to <https://github.com/bitnami/containers/blob/main/bitnami/php-fpm>
Configuration files are located at `/opt/bitnami/php/etc/php-fpm.conf` and `/opt/bitnami/php/etc/php.ini`.
