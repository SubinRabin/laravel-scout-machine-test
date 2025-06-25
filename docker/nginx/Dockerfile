# Use the official NGINX image
FROM nginx:latest
# Remove default NGINX configuration
RUN rm -f /etc/nginx/nginx.conf
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

RUN rm -f /etc/nginx/conf.d/default.conf

COPY  ./nginx/sites-enabled/ /etc/nginx/sites-enabled/


# Copy your custom NGINX configuration