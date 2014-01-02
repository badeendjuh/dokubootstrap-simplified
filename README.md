# About

*EARLY BOOTSTRAP 3 SUPPORT ADDED*: Still a bit buggy. See warnings section for
information on using Bootstrap 2.3.2.

See template.info.txt for main info

See COPYING for license info

This "theme" is actually intended to be modified with a Twitter Bootstrap theme
of your choice. Twitter Bootstrap is a framework to create websites that work
and look great in a range of devices and browsers.  It's quite customizable and
there's many themes available for free and/or pay. A basic theme would require
only that you overwrite a few files included in this theme. More radical
changes would require changing the actual template layout (mostly in main.php).

Effort has been put into making the template's public facing content look okay.
Some back end functionality (e.g., the admin interface) may look distorted, but
should still be functional.

# Why This Theme?

The [official Bootstrap page](http://twitter.github.com/bootstrap/) has many
reasons why you might want your site to be based on Bootstrap. Bootstrap
contains many useful components for building websites, including a responsive
grid layout and excellent plug-in support.

[DokuWiki](https://www.dokuwiki.org/) is an excellent file-based, open-source
wiki software. It lets you easily edit and organize pages without requiring a
database server.

Combining the above two (via this theme), we get an excellent content editor
(DokuWiki) and an excellent system to control the layout and look of the
content (Bootstrap).

## Screenshots

Here's what the theme looks like by default. Multiple screenshots in different
screen resolutions show how the site changes as the amount of screen real
estate changes.

1. [320x480](https://raw.github.com/ryanwmoore/dokutwitterbootstrap/master/screenshot_320x480.png)
2. [768x1024](https://raw.github.com/ryanwmoore/dokutwitterbootstrap/master/screenshot_768x1024.png)
3. [980x1280](https://raw.github.com/ryanwmoore/dokutwitterbootstrap/master/screenshot_980x1280.png)

# Installation from Github

Do something like the following:

1. Install DokuWiki as you normally would. See
   [DokuWiki.org](https://www.dokuwiki.org).
2. ```cd dokuwiki/lib/tpl```
3. ```mkdir dokutwitterbootstrap```
4. ```cd dokutwitterbootstrap```
5. ```git init```
6. ```git pull git://github.com/ryanwmoore/dokutwitterbootstrap.git```
7. Using DokuWiki's admin interface, change the wiki's template to
   dokutwitterbootstrap.

# Customization

This DokuWiki theme will get you started with a very basic Twitter Boostrap
theme. Then, replace the following files with your own Bootstrap files:

* css/
    * bootstrap.min.css
    * bootstrap-theme.min.css
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

It automatically includes jQuery 1.9.1 via the Google CDN.

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


# Base Version

This theme is based off of Twitter Bootstrap 3. This theme's migration to
Bootstrap 3 is recent and, honestly, still a bit buggy. I felt it better to put
it out on the Internet, mostly working, than to not have any Bootstrap 3 support
at all.

Older versions of this theme used Twitter Bootstrap 2.3.2. See [the last
Bootstrap 2.3
commit](https://github.com/ryanwmoore/dokutwitterbootstrap/commit/41397bf3351972cb917415827c6945536e1a77ca).

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

