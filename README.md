# Laravel-Composer-Template

## Startup
1. Docker Composeの起動
~~~sh
$ docker compose up -d
~~~

2. composerのインストール
~~~sh
$ docker compose exec web /usr/bin/composer install
~~~

3. laravelのセットアップ
~~~sh
$ docker compose exec web cp -rip .env.example .env
$ docker compose exec web php artisan key:generate
~~~

## Add installed
### CORSのインストール
~~~sh
$ docker compose exec web php artisan config:publish cors
~~~

### 多言語環境のインストール
~~~sh
$ docker compose exec web php artisan lang:publish
~~~
