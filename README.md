Desk Framework - Docker
=======

Linked containers for PHP7 and NGINX.

### Install

```
docker-compose build
```

### Run

```
docker-compose up
```

Site will be available at (or check IP by ```boot2docker ip```):

```
http://192.168.59.103/
```

### Configuring

Add below string into your shell config to make the work more comfortable:
```
alias desk-composer="docker-compose run --entrypoint /usr/local/bin/composer php"
```
