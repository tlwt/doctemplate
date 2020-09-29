FROM alpine:3.12

LABEL MAINTAINER Till Witt <tmail@tillwitt.de> DESC Doxygen and SVN, Git

# installing doxygen
RUN apk --update add doxygen graphviz git subversion make texlive &&  rm -rf /var/cache/apk/*

# installing sphinx-doc
RUN apk --update add py3-sphinx &&  rm -rf /var/cache/apk/*

#CMD doxygen /tmp/Doxygen-source/doxygen-config
WORKDIR /docs
CMD pwd && ls -la /docs && sphinx-build -b html /docs/sphinxdocs-source /docs/sphinxdocs
