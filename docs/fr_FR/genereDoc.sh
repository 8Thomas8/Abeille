for f in *.adoc; do echo "Processing $f file.."; asciidoc -a icons $f; done
mv *.html html/

