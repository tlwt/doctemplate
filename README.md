# doctemplate

This repository provides help in generating sphinx doc user manual and doxygen source code documentation.




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
