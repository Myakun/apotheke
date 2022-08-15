#!/usr/bin/env sh
set -eu
envsubst "`printf '${%s} ' $(sh -c "env|cut -d'=' -f1")`" < /var/www/app/src/config/params.example.php > /var/www/app/src/config/params.php

exec "$@"