# doctemplate
project documentation template

## Sphinx-Doc generate output

Edit the documents in `./documents/source` directory.

### generate output
To generate output as HTML, EPUB or PDF run the following commands. In case you get some error like `*** No rule to make target '...'.  Stop.` then you have the directory settings wrong.

Output HTML

```
docker run --rm -v $(PWD)/documents:/docs sphinxdoc/sphinx make html
```

Output PDF (*watch out - the container is sphinx-latex and not sphinx here*)

```
docker run --rm -v /path/to/documents:/docs sphinxdoc/sphinx-latexpdf make latexpdf
```
