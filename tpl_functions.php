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
 * Wrapper around custom template actions
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_action($type, $link=0, $wrapper=0) {
    switch ($type) {
        case 'userpage':
            if (tpl_getConf('userPage')) {
                _tpl_userpage(tpl_getConf('userPage'), tpl_getLang('userpage'), $link, $wrapper);
            }
            break;
    }
}


/* dokubootstrap-yeti related functions
********************************************************************/

function _tpl_toc_to_twitter_bootstrap_event_hander_dump_level($data, $firstlevel=false) {

		
    if (count($data) == 0) {
        return '';
    }

	//dw($data);
    $out = '<div class="bs-sidebar" role="navigation">';
    //$out .= '<ul class="nav nav-pills nav-stacked affix">';
    $out .= '<ul class="nav">';

    $li_open = false;
	$level = $data[0]['level'];

    //Only supports top level links for now.
    foreach($data as $heading) {

		// link or reference?
		isset($heading['hid']) ? $href = '#'.$heading['hid'] : $href = $heading['link'];
		
		if ($heading['level'] == $level) {

			// Close previous open li.
			if($li_open) {
				 $out .= '</li>';
				 $li_open = false;
			}else{
				 $out .= '';
			}
			
        	$out .= '<li><a href="' . $href . '">'. $heading['title'] . '</a>';
        	$li_open = true;

		}else if($heading['level'] > $level) {
        	$out .= '<ul class="nav">';
			$out .= '<li><a href="' . $href . '">'. $heading['title'] . '</a>';
			$li_open = true;
		
		}else if($heading['level'] < $level) {
			
			// Close previous open li.
			if($li_open) {
				 $out .= '</li>';
				 $li_open = false;
			}else{
				 $out .= '';
			}
	        	
			$out .= '</ul>';
			$out .= '<li><a href="' . $href . '">'. $heading['title'] . '</a>';
		}
		
		$level = $heading['level'];
    }
	
	// Close previous open li.
    if($li_open) {
    	$out .= '</li>';
    }

    $out .= '</ul>';
    $out .= '</div>';

    return $out;
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


function _tpl_output_page_tools($showTools = true, $element = 'li'){
    global $lang;

    if ($showTools) {

			echo '<ul class="dropdown-menu">';

            tpl_action('edit', 1, $element);
            tpl_action('revisions', 1, $element);
            tpl_action('backlink', 1, $element);
            tpl_action('subscribe', 1, $element);
            tpl_action('revert', $textonly, $element);
			
			echo '<li class="divider"></li>';
        	tpl_action('recent', 1, 'li');
        	tpl_action('media', 1, 'li');
        	tpl_action('index', 1, 'li');
	
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
    print '<input class="" type="text" placeholder="'.$lang['btn_search'].'" ';
    if($ACT == 'search') print 'value="'.htmlspecialchars($QUERY).'" ';
    if(!$autocomplete) print 'autocomplete="off" ';
    print 'id="qsearch__in" accesskey="f" name="id" class="edit" title="[F]" />';

    print '<button type="submit" value="" class="btn btn-default" title="'.$lang['btn_search'].'">';
    print '<i class="glyphicon glyphicon-search"></i></button>';

    if($ajax) print '<div id="qsearch__out" class="ajax_qsearch JSpopup"></div>';
    print '</div></form>';
    return true;

}

/**
 * Define how the user related content is shown.
 * When not logged in, login / register is shown
 * When logged in the user's name is printed with a dropdown of user related options 
 *
 * @author Paul in 't Hout <badeendjuh@email.com>
 **/

function _tpl_userinfo($element='li') {
	global $INFO;

 	if(isset($_SERVER['REMOTE_USER'])) {
      	echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.hsc($INFO['userinfo']['name']).'<b class="caret"></b></a>';
 		echo '<ul class="dropdown-menu">';
		tpl_action('admin', 1, $element);
 		tpl_action('profile', 1, $element);
		tpl_action('login', 1, $element);
		echo '</ul>';
 		echo '</li>';
	}else{
		tpl_action('login', 1, $element, 0, '', '', 'Login / Register');
	}
}

// debug web
function dw($message) {
        print "<pre>";
        if (is_array($message)) {
                print_r($message);
        }else{
                print $message;
        }
        print "<pre>";
}



