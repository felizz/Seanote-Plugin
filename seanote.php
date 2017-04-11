<?php
/**
 * Plugin Name: Social Polls by Seanote.com
 * Plugin URI:  http://seanote.com
 * Description: Seanote are polls you can embed on your WordPress page. 
 * Version:     1.0.0
 * Author:      Seanote Team
 * Author URI:  https://www.seanote.com
 * License: GPLv2 or later
 *
 * @package   Seanote_Shortcode
 * @copyright Copyright (C) 2017 Seanote
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
*/
 
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

function seanote_scripts() {
  wp_enqueue_style('seanote-css','https://dev.seanote.com/static/css/embed.css');
  wp_enqueue_script( 'seanote-plugin','https://dev.seanote.com/static/js/plugin.js', array('jquery'),'',true);
}

add_action('wp_enqueue_scripts', 'seanote_scripts' );

function seanote_shortcode($atts) {
  $embed = sprintf(
      '
      <div id="seanote_post">{"type":"post", "id": "%s"}</div>
      <script type="text/javascript">
          console.error = (function() {
            var error = console.error;
            return function(exception) {
              if ((exception + "").indexOf("Warning: A component is contentEditable") != 0) {
                  error.apply(console, arguments)
              }
            }
          })()
      </script>',
      $atts['id']
    );
 
  return $embed;
}
add_shortcode('seanote','seanote_shortcode');


