# Documentation template

This repository provides help in generating sphinx doc user manual and doxygen source code documentation. It provides a docker setup, which should run on any machine. The first run usually takes a few minutes as the docker containers are build for the first time.

## How do I run this?

1. git clone this project to your machine
2. run `docker-compose up` (again first run will take a few minutes)
3. open `/documents/index.html` and enjoy your documentation.


## How do I run this on my code?
Repeat the previous steps but:
1. make sure your source code is in the `sources` directory (or point it to the right location within the `docker-compose.yml`)
2. adapt the `/documents/document-variables.env` to reflect your project settings.
3. run `docker-compose up` (this time it should run faster)



### The tech details



## Sphinx-Doc generate output

Edit the documents in `./documents/sphinxdocs-source` directory. Make sure the conf.py contains your project name.

## Doxygen output
Edit the documents in `./documents/doxygen-source` directory. Make sure the doxygen-conf contains your project name.


# execute

just run

```
docker-compose up
```

output will be created in the `documents` folder under `/doxygen` and `/sphinxdocs`


# additional material

https://docutils.sourceforge.io/docs/user/rst/quickref.html#external-hyperlink-targets
