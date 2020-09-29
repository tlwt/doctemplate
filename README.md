# Documentation template

This repository provides help in generating sphinx doc user manual and doxygen source code documentation. It provides a docker setup, which should run on any machine. The first run usually takes a few minutes as the docker containers are build for the first time.

## How do I run this?

1. git clone this project to your machine
2. run `docker-compose up` (again first run will take a few minutes)
3. open `/documents/index.html` and enjoy your documentation.


## How do I run this on my code?
Repeat the previous steps but:
1. make sure your source code is in the `/sources` directory (or point it to the right location within the `docker-compose.yml` ==> see line `- ./sources/:/tmp/sources`)
2. adapt the `/documents/document-variables.env` to reflect your project settings.
3. run `docker-compose up` (this time it should run faster)

### The tech details

#### /docker
holds the docker files, likely no need to change anything

#### /documents
holds both input and output files for the documentation


##### /documents/sphinxdocs-sources
Modify these files to generate your user manual


## helpful links
https://docutils.sourceforge.io/docs/user/rst/quickref.html#external-hyperlink-targets
