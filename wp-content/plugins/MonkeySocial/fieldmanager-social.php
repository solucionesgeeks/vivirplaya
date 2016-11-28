<?php
/*
	Plugin Name: Monkey Social Networks Manager
	Plugin URI: http://www.monkeysweb.com.mx/
	Description: Este plugin permite administrar y mostrar las Redes Sociales (solo agregar [monkeysocial] sonde los desee)
	Version: 0.1
	Author: Eduardo Lopez
	Author URI: http://www.monkeysweb.com.mx/
*/
function setup_monkey_social() {
	if ( defined( 'FM_VERSION' ) ) {
		$dir = dirname( __FILE__ ) . '/lib/';
		require_once( $dir . 'class-fm-monkey-social-structures.php' );
		require_once( $dir . 'class-fm-monkeys-social.php' );
	}
}
function showSocial() {
	ob_start();
	global $post;
	$args = array(
		'post_type' => 'monkeys-social',
		'posts_per_page' => 10,
		'no_found_rows' => true,
		'post_status' => 'publish',
	);
	$social = new WP_Query( $args );
	if ( $social->have_posts() ):
		$html = '<div class="gray"><div class="principal"><div class="row"><div class="col-xs-12 col-sm-12 col-md-12">
				<span>Contáctanos en nuestras redes sociales!</span><br>';
		while( $social->have_posts() ):
			$social->the_post();
			$info = get_post_meta( $post->ID, 'social_information', true );
			if ( strpos( $info[ 'url' ], '@') === false ) {
				$html .= '<a href="' . $info[ 'url' ] . '" target="_blank"><i class="' . $info[ 'network' ] . '"></i></a>';
			} else {
				$html .= '<a href="mailto:' . $info[ 'url' ] . '" target="_blank"><i class="' . $info[ 'network' ] . '"></i></a>';
			}
		endwhile;
		$html .= '</div></div></div></div>';
		echo $html;
	endif;
	wp_reset_postdata();
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_action( 'after_setup_theme', 'setup_monkey_social' );
add_shortcode( 'monkeysocial', 'showSocial');