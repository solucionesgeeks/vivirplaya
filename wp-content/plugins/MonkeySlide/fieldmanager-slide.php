<?php
/*
	Plugin Name: Monkey Slide Manager
	Plugin URI: http://www.monkeysweb.com.mx/
	Description: Este plugin permite alimentar y mostrar un Slider dentro del sitio, solo coloque [monkeyslide] donde lo requiere dentro del sitio
	Version: 0.1
	Author: Eduardo Lopez
	Author URI: http://www.monkeysweb.com.mx/
*/
function setup_monkey_slide() {
	if ( defined( 'FM_VERSION' ) ) {
		$dir = dirname( __FILE__ ) . '/lib/';
		require_once( $dir . 'class-fm-monkey-slide-structures.php' );
		require_once( $dir . 'class-fm-monkeys-media.php' );
	}
}
function showSlide() {
	ob_start();
	global $post;
	$args = array(
		'post_type' => 'monkeys-media',
		'posts_per_page' => 10,
		'no_found_rows' => true,
		'post_status' => 'publish',
	);
	$slides = new WP_Query( $args );
	if ( $slides->have_posts() ):
		$html =
			'<script type="text/javascript">
				$( document ).ready( function() {
					$(\'.shome\').bxSlider( { auto: true } );
				} );
			</script>
			<div class="monkeys-slide" id="main-slide">
				<ul class="bxslider shome">';
		while( $slides->have_posts() ):
			$slides->the_post();
			$attachments = get_posts( array(
				'post_type' => 'attachment',
				'post_parent' => get_the_ID()
			) );
			if ( $attachments ) {
				foreach ( $attachments as $attachment ) {
					$html .=
						'<li>' . wp_get_attachment_image( $attachment->ID, 'full' ) . '</li>';
				}
			}
		endwhile;
				$html .=
					'</ul>
				</div>';
		echo $html;
	endif;
	wp_reset_postdata();
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_action( 'after_setup_theme', 'setup_monkey_slide' );
add_shortcode( 'monkeyslide', 'showSlide');