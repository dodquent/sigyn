FROM mysql:8.0

ADD ./sigyn.sql /docker-entrypoint-initdb.d
RUN chmod +x /docker-entrypoint-initdb.d/sigyn.sql

RUN usermod -u 1000 mysql