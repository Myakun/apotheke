#!/usr/bin/env sh
set -eu
envsubst "`printf '${%s} ' $(sh -c "env|cut -d'=' -f1")`" < /etc/nginx/conf.d/app.conf.example > /etc/nginx/conf.d/app.conf
exec "$@"