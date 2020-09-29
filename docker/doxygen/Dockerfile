FROM alpine:3.12

LABEL MAINTAINER Till Witt <tmail@tillwitt.de> DESC Doxygen and SVN, Git

RUN apk --update add doxygen graphviz git subversion make texlive &&  rm -rf /var/cache/apk/*

ENTRYPOINT mkdir -p /tmp/Doxygen/ && mkdir -p /tmp/Doxygen-source/ && mkdir -p /tmp/sources && doxygen -v
