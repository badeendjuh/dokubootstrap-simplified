//DokuWiki is occasionally incompatible with the latest jQuery (depending on release versions, etc).
//Here, we restore the original version of jQuery that DokuWiki was using. This
//should be the last script loaded by a page.
var jQuery_Bootstrap = jQuery;
jQuery.noConflict(true);

