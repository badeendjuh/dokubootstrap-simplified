# About

In this template I attempt a number of things:

 * Make the layout of dokuwiki as simple as possible, striping it from any excess features I do not need, such as .discussions.. Simplyfying the layout further.
 * Fully support Bootstrap 3, with http://bootswatch.com/default/ theme as default, though I prefer ``yeti`` better.
 * My goal is to build a template in which I can easily publish my frequently used text's, commands, action plans etc for my friends a colleagues to use and add to.

# Features

* Back to basics, sharing knowledge and information between peers without collatoral.
* Easily switch template visuals using pre-populated styles from http://bootswatch.com
* Bootstrap 3 ready.
* Automatic sidebar that scrolls along with you, collapsing / opening the main header of where you are in the page
* Dokuwiki Menu functions out of sight, but just 2 clicks away.

# Screenshots

1. [Big width](https://raw.githubusercontent.com/badeendjuh/dokubootstrap-yeti/master/screenshot_big_width.png)
2. [Medium width](https://raw.githubusercontent.com/badeendjuh/dokubootstrap-yeti/master/screenshot_small_width.png)

# Installation from Github

Do something like the following:

1. Install DokuWiki as you normally would. See
   [DokuWiki.org](https://www.dokuwiki.org).
2. ```cd dokuwiki/lib/tpl```
3. ```mkdir dokubootstrapsimplified```
4. ```cd dokubootstrapsimplified```
5. ```git init```
6. ```git pull https://github.com/badeendjuh/dokubootstrap-simplified.git```
7. Using DokuWiki's admin interface, change the wiki's template to
   dokubootstrap-simplified.

# Customization

From the Configuration Manager screen you can change to any of the available bootstrap themes on http://bootswatch.com/

If however you want to substitute the library with your own bootsrap theme you need to be aware of the following files

* css/
    * bootstrap-<theme>.min.css
    * modifications.css: place minor global modifications to the
      bootstrap theme here. See included modifications.css, which enables the use of TOC sidebar. 
* js/
    * bootstrap.min.js: compile all your desired plugins into a single
      minimized javascript file. The included bootstrap.min.js is version 3.0.2 andincludes all
      plugins.
	* modifications.js: Contains all javascript additions, including some client-side fixing of markup, adding the scroll behavior to the TOC etc. 


# Warning

This theme is hard-coded to use minified Bootstrap CSS and Bootstrap javascript. 

Tested with Dokuwiki "Binky" and "Ponder Stibbon".

This theme is intended primarily for small sites that are modified by only a handfull of people. Effort has been made to make public facing things look nice, but non-public interfaces (e.g., edit interfaces, admin, configuration settings) may not have been updated and may appear ugly. These should still be functional.

When making changes, please have a carefull look at js/modifications.js; it contains some client side fixing of markup, which could be done in the Dokuwiki core code, but that's to deep a change to be included in this template. The comments in the .js file should provide suffiecient clarification on the purpose of each statement.

##  Bugs

The only major ``bug`` that I am aware of is that, when attempting to upload a
new file to the median manager, a file upload button might not appear.  Click on
the words "select files..." and the file upload select box will appear.


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

# Acknowledgements

This theme started as a fork from https://github.com/ryanwmoore/dokutwitterbootstrap
So big thanks to Ryan.

Also, this template would not exists without http://getbootstrap.com and http://bootswatch.com

# License

This DokuWiki theme is based off of the [dokutwitterbootstrap Template](https://github.com/ryanwmoore/dokutwitterbootstrap), released
under GPL v2.0. Therefore, this template is also released under that license.

I've modified the template to make even more  use of Twitter Bootstrap
code/functionality. Twitter Bootstrap is licensed under Apache License v2.0.
According to http://www.apache.org/licenses/GPL-compatibility.html , the Free
Software Foundation does not consider GPL2 to be compatible with Apache 2.0. 

I don't really know how much it matters to the average user. Consult a lawyer if you're worried about this potential incompatibility. 

