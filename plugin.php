<?php
/*
Plugin Name:	Super Simple Social Sharing Buttons
Plugin URI:		https://github.com/ThePopularizer/popularizer-social
Description:	Light-weight (scriptless) social sharing buttons.
Version:		1.0
Author:			ThePopularizer
Author URI:		https://thepopularizer.// COMBAK:
License:		GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

function add_social_stylesheet() {
	wp_enqueue_style( 'social-button', plugin_dir_url( __FILE__ ) . 'css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'add_social_stylesheet', 10);

function social_share_buttons( $atts ){
	$url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}";
	$title = get_the_title();
	$a = shortcode_atts( array(
			'colour' => 'light',
			'placement' => 'top',
			'title' => 'Share This Page!',
			'orientation' => 'vertical',
			'position' => 'fixed',
	), $atts );
	?>
	<ul class="social-share <?php echo $a['display'] ?> flex-<?php echo $a['orientation'] ?> <?php echo $a['position'] ?>" data-toggle="tooltip" data-colour="<?php echo $a['colour'] ?>" data-placement="<?php echo $a['placement'] ?>" data-original-title="<?php echo $a['title'] ?>">
	  <li class="facebook">
	    <a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank">
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>icons/facebook.svg"/>
	  </a></li>
	  <li class="twitter">
			<a rel="nofollow" href="https://twitter.com/intent/tweet?text=Auckland%20Store&amp;url=<?php echo $url; ?>" target="_blank">
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>icons/twitter.svg"/>
	  </a></li>
	  <li class="linkedin">
			<a rel="nofollow" href="https://www.linkedin.com/shareArticle?url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>&amp;mini=true" target="_blank">
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>icons/linkedin.svg"/>
	  </a></li>
	  <li class="email">
			<a rel="nofollow" href="mailto:?subject=Auckland%20Store&amp;body=<?php echo $url; ?>" target="_blank">
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>icons/mail.svg"/>
	  </a></li>
	</ul>
	<?php
}
add_action('wp_footer', 'social_share_buttons');
add_shortcode( 'social-share', 'social_share_buttons' );
