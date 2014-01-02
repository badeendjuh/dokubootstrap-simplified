# About

This is a fork from https://github.com/ryanwmoore/dokutwitterbootstrap
So big thanks to Ryan.

In this template I attempt two things:
 -  make the layout of dokuwiki as simple as possible, striping it from any excess features I do not need, such as "discussions". Simplyfying the layout further.
 - Fully support Bootstrap 3, with http://bootswatch.com/yeti/ theme as default. 


See template.info.txt for main info

See COPYING for license info

# Goal

My goal is to build a templete in which I can easily publish my frequently used text's, commands, action plans etc for my friends a colleagues to use and add too.

## Screenshots

Perhaps later when i am more satified with my progress.

# Installation from Github

Do something like the following:

1. Install DokuWiki as you normally would. See
   [DokuWiki.org](https://www.dokuwiki.org).
2. ```cd dokuwiki/lib/tpl```
3. ```mkdir dokubootstrap-yeti```
4. ```cd dokubootstrap-yeti```
5. ```git init```
6. ```git pull git://github.com/badeendjuh/dokubootstrap-yeti.git```
7. Using DokuWiki's admin interface, change the wiki's template to
   dokubootstrap-yeti.

# Customization

This DokuWiki theme will get you started with a very basic Twitter Boostrap
theme. Then, replace the following files with your own Bootstrap files:

* css/
    * bootstrap.min.css
    * modifications.css: place minor global modifications to the
      bootstrap theme here. See included modifications.css, which enables the
      use of the floating top navbar 
* img/
    * glyphicons-halflings.png
    * glyphicons-halflings-white.png
* js/
    * bootstrap.min.js: compile all your desired plugins into a single
      minimized javascript file. The included bootstrap.min.js includes all
      plugins 

# Warning

This theme is hard-coded to use minified Bootstrap CSS and Bootstrap javascript. 

Tested with Dokuwiki "Binky" only.

This theme is intended primarily for small sites that are modified by one or so
people. Effort has been made to make public facing things look nice, but
non-public interfaces (e.g., edit interfaces, admin, configuration settings)
may not have been updated and may appear ugly. These should still be
functional.

DokuWiki's "Binky" release puts some links in <bdi> tags. This causes some links
to look unstyled. This could be fixed by modifying how DokuWiki generates these
links. Instead, the file js/change_dokuwiki_structure.js dynamically modifies
the DOM structure to fix this by detaching and reattaching such links. Yes, that
"solution" seems a bit hacky. But, I'd rather not require that people modify
DokuWiki's source code just to get this theme to work.

##  Bugs

The only major ``bug'' that I am aware of is that, when attempting to upload a
new file to the median manager, a file upload button might not appear.  Click on
the words "select files..." and the file upload select box will appear.

# Theme Resources

Here's some good free themes to start with: http://bootswatch.com/
That site also has a swatch maker so you can make your own style.

# DokuWiki Specifics

This template supports the use of a ```nav.html``` file (a sample is included).
Add any Wiki-wide links that you would like to, with each link being inside an
li element. I tried adding support for a Wiki-based navigation page, instead of
raw HTML, but due to how DokuWiki outputs lists, the output clashed with
existing CSS and was unusable.

This template does support a ```footer.html``` file, which will be output after
the page information and site license.

This template does support a ```meta.html``` file, which will be output right
before the head element is closed.

# License

This DokuWiki theme is based off of the [DokuWiki Starter
template](https://github.com/selfthinker/dokuwiki_template_starter/), released
under GPL v2.0. Therefore, this template is also released under that license.
I've modified the starter template to make use of Twitter Bootstrap
code/functionality. Twitter Bootstrap is licensed under Apache License v2.0.
According to http://www.apache.org/licenses/GPL-compatibility.html , the Free
Software Foundation does not consider GPL2 to be compatible with Apache 2.0. I
don't really know how much it matters to the average user. Consult a lawyer if
you're worried about this potential incompatibility. 


# Disclaimer

I'm not intimately familiar with either DokuWiki template coding or Bootstrap.
I may have done stupid things. If so, please make appropriate changes and
send a pull request.

