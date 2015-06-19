FROM ubuntu:latest

MAINTAINER Karabutin Alex <karabutinalex@gmail.com>

RUN apt-get -y install software-properties-common
RUN add-apt-repository -y ppa:ubuntu-toolchain-r/test
RUN apt-get -y update
RUN apt-get -y install gcc-4.9 git make autoconf gcc g++

RUN cd /tmp && \
    git clone https://github.com/php/php-src.git

RUN apt-get install -y \
    bison \
    libxml2-dev \
    openssl libssl-dev \
    libvpx-dev \
    libjpeg62 libjpeg62-dev \
    libcurl4-openssl-dev \
    libpng12-0 libpng12-dev \
    libfreetype6-dev \
    libgmp-dev \
    libc-client-dev \
    libicu-dev \
    libmcrypt-dev \
    libpspell-dev \
    libreadline-dev \
    libtidy-dev \
    libxslt-dev

RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h

RUN cd /tmp/php-src && \
    ./buildconf && \
    ./configure --disable-debug       \
                --enable-zend-signals --with-gd \
                --without-pear        --with-jpeg-dir=/usr \
                --with-png-dir=/usr   --with-vpx-dir=/usr \
                --with-freetype-dir=/usr \
                --enable-exif         --enable-gd-native-ttf \
                --with-zlib           --with-gmp \
                --with-zlib-dir=/usr \
                --with-gettext        --with-kerberos \
                --with-imap-ssl       --with-mcrypt=/usr/local \
                --with-iconv          --enable-sockets \
                --with-openssl        --with-pspell \
                --with-pdo-sqlite     --with-pdo-mysql=mysqlnd \
                --enable-soap         --enable-xmlreader \
                --enable-phar=shared  --with-xsl \
                --enable-ftp          --enable-cgi \
                --with-curl=/usr      --with-tidy \
                --with-xmlrpc         --enable-mbstring \
                --enable-sysvsem      --enable-sysvshm \
                --enable-shmop        --with-readline \
                --enable-pcntl        --enable-fpm \
                --enable-intl         --enable-zip \
                --with-imap           --with-mysqli=mysqlnd \
                --enable-calendar     --prefix=/usr/local \
                --with-mysql-sock=/var/run/mysqld/mysqld.sock \
                --with-config-file-scan-dir=/etc/php7/conf.d \
                --with-config-file-path=/etc/php7

RUN cd /tmp/php-src && \
    make && \
    make install

COPY php-fpm.conf /usr/local/etc/php-fpm.conf
COPY php-fpm.www.conf /usr/local/etc/php-fpm.d/www.conf

EXPOSE 9000

RUN mkdir /icc
VOLUME ["/icc"]

ENTRYPOINT ["/usr/local/sbin/php-fpm", "-F"]
