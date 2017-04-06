FROM ubuntu:16.10

RUN apt-get -y update && apt-get install -y \
    apache2 \
    apache2-utils \
    php7.0 \
    libapache2-mod-php7.0 \
    php7.0-json \
    php7.0-mysql \
    php7.0-mcrypt \
    mcrypt \
    php7.0-mbstring \
    curl \
    wget \
    git \
    gcc \
    make \
    re2c \
    libpcre3-dev \
    php7.0-dev

# Compile specific Phalcon version
ENV PHALCON_VERSION=3.1.1

RUN set -xe && curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
	tar xzf v${PHALCON_VERSION}.tar.gz && cd cphalcon-${PHALCON_VERSION}/build && ./install && \
	echo "extension=phalcon.so" >> /etc/php/7.0/apache2/conf.d/30-phalcon.ini && \
	echo "extension=phalcon.so" >> /etc/php/7.0/cli/conf.d/30-phalcon.ini && \
	cd ../.. && rm -rf v${PHALCON_VERSION}.tar.gz cphalcon-${PHALCON_VERSION}

RUN git clone http://github.com/phalcon/phalcon-devtools.git \
        && phalcon-devtools/phalcon.sh \
        && ln -s ./phalcon-devtools/phalcon.php /usr/local/bin/phalcon

RUN { \
		echo '<FilesMatch \.php$>'; \
		echo '\tSetHandler application/x-httpd-php'; \
		echo '</FilesMatch>'; \
		echo; \
		echo 'DirectoryIndex disabled'; \
		echo 'DirectoryIndex index.php index.html'; \
		echo; \
		echo '<Directory /var/www/>'; \
		echo '\tOptions -Indexes'; \
		echo '\tAllowOverride All'; \
		echo '</Directory>'; \
	} | tee "/etc/apache2/conf-available/docker-php.conf" \
	&& a2enconf docker-php

RUN a2enmod rewrite
RUN usermod -u 1000 www-data

CMD ["/usr/sbin/apache2ctl","-DFOREGROUND"]
