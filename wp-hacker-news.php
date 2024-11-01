<?php
/*
 * Plugin Name: WP Hacker News
 * Version: 0.4
 * Description: Adds a "Sumbit to Hacker News" button to your posts.
 * Author: Jack Slingerland
 * Author URI: http://www.re-cycledair.com/blog
 * Plugin URI: http://www.re-cycledair.com/wp-hacker-news
 */

//Version check.
global $wp_version;
$exit_msg = "WP Hacker News requires Wordpress 2.5 or higher.";
$exit_msg .= "  <a href='http://codex.wordpress.org/Upgrading_Wordpress'>Please Update! </a>";
if(version_compare($wp_version, "2.5", "<")) {
    exit($exit_msg);
}

//Add the filter
add_filter ('the_content', 'WPHackerNews_ContentFilter');

//Function to show the HN Link.
function WPHackerNews_link() {
    global $post;
    $link = urlencode(get_permalink($post->ID));
    $title = urlencode($post->post_title);
    $formattedLink = "
        <div align='center' style='float:right;margin-left:10px;margin-bottom:4px;'>
        <a href='http://news.ycombinator.com/submitlink?u=$link&t=$title'>
        <img src='http://www.re-cycledair.com/wp-content/uploads/2010/03/hn.jpg' /><br />
        <span style='font-size: 9px;'>Submit to HN</span>
        </a>
        </div>
   ";

   return $formattedLink;
}

//Integrate with Wordpress.
function WPHackerNews_ContentFilter($content) {
        if(is_single()) {
            return WPHackerNews_link().$content;
        } else {
            return $content;
        }
}
?>
