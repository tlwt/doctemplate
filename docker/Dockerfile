FROM mhart/alpine-node

LABEL MAINTAINER Till Witt <tmail@tillwitt.de> DESC Doxygen and SVN, Git

# installing doxygen
RUN apk --update add doxygen graphviz git subversion make texlive && rm -rf /var/cache/apk/*

# installing sphinx-doc
RUN apk --update add py3-sphinx py-pip && rm -rf /var/cache/apk/*

# installing sphinx extensions
RUN pip install sphinx_rtd_theme recommonmark

# webserver
RUN apk --update add lighttpd php-common php-iconv php-json php-gd php-curl php-xml php-fpm php-pgsql php-imap php-cgi fcgi php-pdo php-pdo_pgsql php-soap php-xmlrpc php-posix php-gettext php-ldap php-ctype php-session php-dom && rm -rf /var/cache/apk/*

# creating run dir
RUN mkdir -p /run/lighttpd/

# adding the webserver config
ADD ./config/lighttpd.conf /etc/lighttpd/


EXPOSE 80
VOLUME /var/www

#putting repo content inside container
WORKDIR /repo
ADD . .

ENTRYPOINT php-fpm7 -D && lighttpd -D -f /etc/lighttpd/lighttpd.conf
