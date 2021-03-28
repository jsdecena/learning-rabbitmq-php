FROM jsdecena/php74-fpm

RUN apt-get update && apt-get install -y \
	sqlite3