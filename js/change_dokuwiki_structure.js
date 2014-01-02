jQuery(".navbar bdi a").each(function () {
    //RC2013-10-28 "Binky" places discussion link in <bdi>.
    //The default Bootstrap CSS therefore won't color the "Discussion" link,
    //since it isn't a direct child of an <li>. So, remove it from the <bdi>
    //and put it in the <li>.
    var destination = $(this).parent().parent();
    var target = jQuery(this).detach();

    jQuery(target).appendTo(destination);
});
