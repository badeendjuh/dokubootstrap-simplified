<?php
/**
 * Template Functions
 *
 * This file provides template specific custom functions that are
 * not provided by the DokuWiki core.
 * It is common practice to start each function with an underscore
 * to make sure it won't interfere with future core functions.
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/**
 * Create link/button to discussion page and back
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_discussion($discussionPage, $title, $backTitle, $link=0, $wrapper=0) {
    global $ID;

    $discussPage    = str_replace('@ID@', $ID, $discussionPage);
    $discussPageRaw = str_replace('@ID@', '', $discussionPage);
    $isDiscussPage  = strpos($ID, $discussPageRaw) !== false;
    $backID         = str_replace($discussPageRaw, '', $ID);

    if ($wrapper) echo "<$wrapper>";

    if ($isDiscussPage) {
        if ($link)
            tpl_pagelink($backID, $backTitle);
        else
            echo html_btn('back2article', $backID, '', array(), 'get', 0, $backTitle);
    } else {
        if ($link)
            tpl_pagelink($discussPage, $title);
        else
            echo html_btn('discussion', $discussPage, '', array(), 'get', 0, $title);
    }

    if ($wrapper) echo "</$wrapper>";
}

/**
 * Create link/button to user page
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_userpage($userPage, $title, $link=0, $wrapper=0) {
    if (!$_SERVER['REMOTE_USER']) return;

    global $conf;
    $userPage = str_replace('@USER@', $_SERVER['REMOTE_USER'], $userPage);

    if ($wrapper) echo "<$wrapper>";

    if ($link)
        tpl_pagelink($userPage, $title);
    else
        echo html_btn('userpage', $userPage, '', array(), 'get', 0, $title);

    if ($wrapper) echo "</$wrapper>";
}

/**
 * Create link/button to register page
 * @deprecated DW versions > 2011-02-20 can use the core function tpl_action('register')
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_register($link=0, $wrapper=0) {
    global $conf;
    global $lang;
    global $ID;
    $lang_register = !empty($lang['btn_register']) ? $lang['btn_register'] : $lang['register'];

    if ($_SERVER['REMOTE_USER'] || !$conf['useacl'] || !actionOK('register')) return;

    if ($wrapper) echo "<$wrapper>";

    if ($link)
        tpl_link(wl($ID, 'do=register'), $lang_register, 'class="action register" rel="nofollow"');
    else
        echo html_btn('register', $ID, '', array('do'=>'register'), 'get', 0, $lang_register);

    if ($wrapper) echo "</$wrapper>";
}

/**
 * Wrapper around custom template actions
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_action($type, $link=0, $wrapper=0) {
    switch ($type) {
        case 'discussion':
            if (tpl_getConf('discussionPage')) {
                _tpl_discussion(tpl_getConf('discussionPage'), tpl_getLang('discussion'), tpl_getLang('back_to_article'), $link, $wrapper);
            }
            break;
        case 'userpage':
            if (tpl_getConf('userPage')) {
                _tpl_userpage(tpl_getConf('userPage'), tpl_getLang('userpage'), $link, $wrapper);
            }
            break;
        case 'register': // deprecated
            _tpl_register($link, $wrapper);
            break;
    }
}



/* fallbacks for things missing in older DokuWiki versions
********************************************************************/


/* if newer settings exist in the core, use them, otherwise fall back to template settings */

if (!isset($conf['tagline'])) {
    $conf['tagline'] = tpl_getConf('tagline');
}

if (!isset($conf['sidebar'])) {
    $conf['sidebar'] = tpl_getConf('sidebarID');
}

/* these $lang strings are now in the core */

if (!isset($lang['user_tools'])) {
    $lang['user_tools'] = tpl_getLang('user_tools');
}
if (!isset($lang['site_tools'])) {
    $lang['site_tools'] = tpl_getLang('site_tools');
}
if (!isset($lang['page_tools'])) {
    $lang['page_tools'] = tpl_getLang('page_tools');
}
if (!isset($lang['skip_to_content'])) {
    $lang['skip_to_content'] = tpl_getLang('skip_to_content');
}


/**
 * copied from core (available since Adora Belle)
 */
if (!function_exists('tpl_getMediaFile')) {
    function tpl_getMediaFile($search, $abs = false, &$imginfo = null) {
        $img     = '';
        $file    = '';
        $ismedia = false;
        // loop through candidates until a match was found:
        foreach($search as $img) {
            if(substr($img, 0, 1) == ':') {
                $file    = mediaFN($img);
                $ismedia = true;
            } else {
                $file    = tpl_incdir().$img;
                $ismedia = false;
            }

            if(file_exists($file)) break;
        }

        // fetch image data if requested
        if(!is_null($imginfo)) {
            $imginfo = getimagesize($file);
        }

        // build URL
        if($ismedia) {
            $url = ml($img, '', true, '', $abs);
        } else {
            $url = tpl_basedir().$img;
            if($abs) $url = DOKU_URL.substr($url, strlen(DOKU_REL));
        }

        return $url;
    }
}

/**
 * copied from core (available since Angua)
 */
if (!function_exists('tpl_favicon')) {
    function tpl_favicon($types = array('favicon')) {

        $return = '';

        foreach($types as $type) {
            switch($type) {
                case 'favicon':
                    $look = array(':wiki:favicon.ico', ':favicon.ico', 'images/favicon.ico');
                    $return .= '<link rel="shortcut icon" href="'.tpl_getMediaFile($look).'" />'.NL;
                    break;
                case 'mobile':
                    $look = array(':wiki:apple-touch-icon.png', ':apple-touch-icon.png', 'images/apple-touch-icon.png');
                    $return .= '<link rel="apple-touch-icon" href="'.tpl_getMediaFile($look).'" />'.NL;
                    break;
                case 'generic':
                    // ideal world solution, which doesn't work in any browser yet
                    $look = array(':wiki:favicon.svg', ':favicon.svg', 'images/favicon.svg');
                    $return .= '<link rel="icon" href="'.tpl_getMediaFile($look).'" type="image/svg+xml" />'.NL;
                    break;
            }
        }

        return $return;
    }
}

/**
 * copied from core (available since Adora Belle)
 */
if (!function_exists('tpl_includeFile')) {
    function tpl_includeFile($file) {
        global $config_cascade;
        foreach(array('protected', 'local', 'default') as $config_group) {
            if(empty($config_cascade['main'][$config_group])) continue;
            foreach($config_cascade['main'][$config_group] as $conf_file) {
                $dir = dirname($conf_file);
                if(file_exists("$dir/$file")) {
                    include("$dir/$file");
                    return;
                }
            }
        }

        // still here? try the template dir
        $file = tpl_incdir().$file;
        if(file_exists($file)) {
            include($file);
        }
    }
}

/**
 * copied from core (available since Adora Belle)
 */
if (!function_exists('tpl_incdir')) {
    function tpl_incdir() {
        global $conf;
        return DOKU_INC.'lib/tpl/'.$conf['template'].'/';
    }
}

function _tpl_toc_to_twitter_bootstrap_event_hander_dump_level($data, $firstlevel=false) {

	
	if(tpl_getConf('sidebar_choice') == 'tocify') {
		return '<div id="tocify"></div>';
	}
	// echo '<pre>';
	// print_r($data);
	// echo '</pre>';
		
    if (count($data) == 0) {
        return '';
    }

    if (tpl_getConf('sidebar_choice') == 'bootchevrons') {
        $chevronHTML = '<i class="glyphicon glyphicon-chevron-right"></i> ';
    } elseif (tpl_getConf('sidebar_choice') == 'bootdefault') {
        $chevronHTML = '';
    }

    $ret = '<div class="sidebar" role="navigation">';
    $ret .= '<ul class="nav nav-pills nav-stacked">';
    $ret .= '<li class="divider"></li>';

    $first = true;
    $li_inner = ' class ="active"';

    //Only supports top level links for now.
    foreach($data as $heading)
    {
        $ret .= '<li' . $li_inner . '><a href="#' . $heading['hid'] . '">'. $chevronHTML . $heading['title'] . '</a></li>';

        $li_inner = '';
    }

    $ret .= '<li class="divider"></li>';
    $ret .= '</ul>';
    $ret .= '</div>';

    return $ret;
}

function _tpl_toc_to_twitter_bootstrap_event_hander(&$event, $param)
{
    global $conf;
    //This is tied to the specific format of the DokuWiki TOC.
    echo _tpl_toc_to_twitter_bootstrap_event_hander_dump_level($event->data, true);
}

function _tpl_toc_to_twitter_bootstrap()
{
    //Force generation of TOC, request that the TOC is returned as HTML, but then ignore the returned string. The hook will instead dump out the TOC.
    global $EVENT_HANDLER;
	$EVENT_HANDLER->register_hook('TPL_TOC_RENDER', 'AFTER', NULL, '_tpl_toc_to_twitter_bootstrap_event_hander');
    
	tpl_toc(true);
}


//Output various links to user tools wrapped in a user-specified element.
function _tpl_output_tools_twitter_bootstrap($showTools = true, $element = 'li') {
	
    if ($showTools) {
	echo '<ul class="dropdown-menu">';
        //Separate whatever was there from these links.
        tpl_action('recent', 1, 'li');
        tpl_action('media', 1, 'li');
        tpl_action('index', 1, 'li');

        echo '<li class="divider"></li>';

        tpl_action('admin', 1, $element);
        _tpl_action('userpage', 1, $element);
        tpl_action('profile', 1, $element);
        tpl_action('register', 1, $element);
        tpl_action('login', 1, $element);
	echo '</ul>';
    }
}

function _tpl_output_page_tools($showTools = true, $element = 'li'){
    global $lang;

    $textonly = true;
    $spandivider = '';
    $elementbegin = "<$element>";
    $elementend = "</$element>";

    if ($showTools) {

			echo '<ul class="dropdown-menu">';

            $content = tpl_action('edit', $textonly, '', true);
            if ($content != '') { echo $elementbegin.$content.$spandivider.$elementend; }

            echo $elementbegin;
            //Notice the use of _tpl_action instead of tpl_action. This doesn't
            //actully return the string and instead automatically prints it
            //out.
            _tpl_action('discussion', $textonly, '', true);
            echo $spandivider;
            echo $elementend;

            $content = tpl_action('revisions', $textonly, '', true);
            if ($content != '') { echo $elementbegin.$content.$spandivider.$elementend; }

            $content = tpl_action('backlink', $textonly, '', true);
            if ($content != '') { echo $elementbegin.$content.$spandivider.$elementend; }

            $content = tpl_action('subscribe', $textonly, '', true);
            if ($content != '') { echo $elementbegin.$content.$spandivider.$elementend; }

            $content = tpl_action('revert', $textonly, '', true);
            if ($content != '') { echo $elementbegin.$content.$spandivider.$elementend; }
		
			echo '</ul>';
    }
}

function _tpl_output_search_bar()
{
    //Modified from the official tpl_searchform function.
    global $lang;
    global $ACT;
    global $QUERY;

    // don't print the search form if search action has been disabled
    if(!actionOk('search')) return false;

    print '<form action="'.wl().'" accept-charset="utf-8" class="search" id="dw__search" method="get"><div class="no">';
    print '<input type="hidden" name="do" value="search" />';
    print '<input type="text" placeholder="'.$lang['btn_search'].'" ';
    if($ACT == 'search') print 'value="'.htmlspecialchars($QUERY).'" ';
    if(!$autocomplete) print 'autocomplete="off" ';
    print 'id="qsearch__in" accesskey="f" name="id" class="edit" title="[F]" />';

    print '<button type="submit" value="" class="btn btn-default" title="'.$lang['btn_search'].'">';
    print '<i class="glyphicon glyphicon-search"></i></button>';

    if($ajax) print '<div id="qsearch__out" class="ajax_qsearch JSpopup"></div>';
    print '</div></form>';
    return true;

}

function _tpl_userinfo() {
	global $lang, $INFO;
 	if(isset($_SERVER['REMOTE_USER'])) {
      	echo '<p class="navbar-text">';
 		echo $lang['loggedinas'].': <bdi>'.hsc($INFO['userinfo']['name']).'</bdi> (<bdi>'.hsc($_SERVER['REMOTE_USER']).'</bdi>)';
 		echo '</p>';
	}else{
		tpl_action('login', 1, '');
 	}
}
