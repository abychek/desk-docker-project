FROM ubuntu:latest

MAINTAINER Karabutin Alex <karabutinalex@gmail.com>

RUN apt-get -y update
RUN apt-get -y install nginx

RUN rm /etc/nginx/sites-enabled/default
COPY nginx.conf /etc/nginx/nginx.conf
COPY nginx.project.conf /etc/nginx/sites-enabled/project.conf

EXPOSE 80

CMD nginx
