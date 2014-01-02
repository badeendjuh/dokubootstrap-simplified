jQuery(function() {
         //var toc = jQuery('#tocify').tocify();
       var $toc =  jQuery('#tocify').tocify({context: "#dokuwiki__content",
											theme: "bootstrap3",
											selectors: "h3,h4,h5"}).data("toc-tocify");
});

