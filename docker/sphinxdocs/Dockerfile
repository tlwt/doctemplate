# in your Dockerfile
FROM sphinxdoc/sphinx
LABEL MAINTAINER Till Witt <tmail@tillwitt.de> DESC Sphinx docs

WORKDIR /docs
ADD requirements.txt /docs
RUN pip3 install -r requirements.txt
