#!/bin/bash
if ! mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -h"db" -e "USE $MYSQL_DATABASE"; then
	mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -h"db" "$MYSQL_DATABASE" </docker-entrypoint-initdb.d/wordpress.sql
fi
