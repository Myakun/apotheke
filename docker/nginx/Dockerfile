FROM nginx:latest

COPY nginx.conf /etc/nginx/nginx.conf

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint
ENTRYPOINT ["/usr/local/bin/docker-entrypoint"]

CMD ["nginx", "-g", "daemon off;"]