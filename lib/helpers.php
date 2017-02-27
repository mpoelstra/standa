<?php

function my_get_post_excerpt( $id ) {
	$content_post = get_post( $id );
	return $content_post->post_excerpt;
}

function excerpt_datebefore($output) {
	global $post;
	if ($post->post_type == 'post' || $post->post_type == 'event' || $post->post_type == 'media') {
		$tags = array("<p>", "</p>");
		$output = str_replace($tags, "", $output);
		if ($post->post_type == 'event') {
			$event_date = get_field('event_date');
            $date = date('d-m-Y H:i', $event_date);
			return '<p>' . $date . ' - ' . $output . '</p>';
		} else {
			return '<p>' . get_the_time('d-m-Y') . ' - ' . $output . '</p>';
		}
	} else {
		return $output;
	}
}

/**
 * get current url
 * 
 * @access public
 * @return string
 */
if ( !function_exists( 'get_current_page_url' ) ) {

	function get_current_page_url() {
		$pageURL = 'http';
		if ( !empty( $_SERVER['HTTPS'] ) ) {
			if ( $_SERVER['HTTPS'] == 'on' ) {
				$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		if ( $_SERVER["SERVER_PORT"] != "80" )
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		else
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

		return $pageURL;
	}

}

//send wp mail with the correct headers
if ( !function_exists( 'sendHTMLemail' ) ) {

	function sendHTMLemail( $html, $from, $fromName, $to, $toName, $cc, $bcc, $subject ) {
		// To send HTML mail, the Content-type header must be set
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'From: ' . $fromName . ' <' . $from . '>' . "\r\n";
		$headers .= 'Cc: ' . $cc . '' . "\r\n";
		$headers .= 'Bcc: ' . $bcc . '' . "\r\n";

		wp_mail( $toName . "<" . $to . ">", $subject, $html, $headers, null );
	}

}

//set correct title tags
function standa_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Zoekresultaten voor %s', TXTDOMAIN ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', TXTDOMAIN ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', TXTDOMAIN ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}

function get_dayofweek($day) {
    $retval = $day;
    switch (strtolower($day)) {
        case 'mon':
            $retval = 'ma';
            break;
        case 'tue':
            $retval = 'di';
            break;
        case 'wed':
            $retval = 'wo';
            break;
        case 'thu':
            $retval = 'do';
            break;
        case 'fri':
            $retval = 'vr';
            break;
        case 'sat':
            $retval = 'za';
            break;
        case 'sun':
            $retval = 'zo';
            break;
    }
    return $retval;

}


function standa_get_featured_image_url( $id, $size = 'large' ) {
	$thumb_array = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
	$thumb_url = (is_array( $thumb_array )) ? $thumb_array[0] : '';
	return $thumb_url;
}

function standa_autolink($message) { 
    //Convert all urls to links
    $message = preg_replace('#([\s|^])(www)#i', '$1http://$2', $message);
    $pattern = '#((http|https|ftp|telnet|news|gopher|file|wais):\/\/[^\s]+)#i';
    $replacement = '<a href="$1" target="_blank">$1</a>';
    $message = preg_replace($pattern, $replacement, $message);

    /* Convert all E-mail matches to appropriate HTML links */
    $pattern = '#([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.';
    $pattern .= '[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)#i';
    $replacement = '<a href="mailto:\\1">\\1</a>';
    $message = preg_replace($pattern, $replacement, $message);
    return $message;
}

function standa_inner_html($element) 
{ 
    $innerHTML = ""; 
    $children = $element->childNodes; 
    foreach ($children as $child) 
    { 
        $tmp_dom = new DOMDocument(); 
        $tmp_dom->appendChild($tmp_dom->importNode($child, true)); 
        $innerHTML.=trim($tmp_dom->saveHTML()); 
    } 
    return $innerHTML; 
} 

function standa_clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}