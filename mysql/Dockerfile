FROM mysql:8.0

ADD ./mydoctor.sql /docker-entrypoint-initdb.d
RUN chmod +x /docker-entrypoint-initdb.d/mydoctor.sql

RUN usermod -u 1000 mysql