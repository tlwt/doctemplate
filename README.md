# Documentation template

[![SCRATCh - funded by BMBF](https://img.shields.io/badge/part%20of-SCRATCh-yellow)](scratch-itea3.eu/)
![SCRATCh - funded by BMBF](https://img.shields.io/badge/funded%20by-BMBF-blue)
[![ITEA3](https://img.shields.io/badge/supported%20by-ITEA3-orange)](https://www.itea3.org)

[![Documentation Status](https://readthedocs.org/projects/projectdoctemplate/badge/?version=latest)](https://projectdoctemplate.readthedocs.io/en/latest/?badge=latest)
![](https://img.shields.io/docker/image-size/tlwt/doctemplate)
![](https://img.shields.io/github/repo-size/tlwt/doctemplate)

This repository provides help in generating sphinx doc ("user manual") and doxygen ("source code") documentation. It provides a docker setup, which should run on any machine. The first run usually takes a few minutes as the docker containers are build for the first time.

## How do I run this?

If you have a docker-compose in place just add the following lines to it:
make sure that your local directories for the documentation and source code is reflected.

### Integrate into your docker compose

Just add it as a part of your services:

```
version: '2'

services:
  doc:
    image: tlwt/doctemplate
    volumes:
      - ./documentation:/docs
      - ./src:/src
    ports:
      - 8080:80
```

### Run it as docker command

alternatively you can just execute the following docker run command

```
docker run -p 8080:80 -v $(PWD)/documentation:/docs -v $(PWD)/src:/src tlwt/doctemplate
```

You then only need to open http://localhost:8080 and follow the instructions there.
The generation of documents still takes a while - please don't click while it run. I'll need to integrate some kind of indicator that the system is still running.



## additional information

You should probably add the output directories to your `.gitignore` file.

```
docs/sphinxdocs/*
docs/doxygen/*
```


-----
# The tech details

## Folders
#### /docker
holds the docker files, likely no need to change anything

#### /documents
holds both input and output files for the documentation. The system will generate necessary files for you.


## helpful links
* [Doxygen Quick Reference Guide](https://docutils.sourceforge.io/docs/user/rst/quickref.html#external-hyperlink-targets)
