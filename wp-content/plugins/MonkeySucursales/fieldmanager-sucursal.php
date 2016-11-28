<?php
/*
	Plugin Name: Monkey Sucursales Manager
	Plugin URI: http://www.monkeysweb.com.mx/
	Description: Este plugin administra nombre e información de contacto de las sucursales (solo agregar shortcode [monkeysucursal])
	Version: 0.1
	Author: Eduardo Lopez
	Author URI: http://www.monkeysweb.com.mx/
*/
function setup_monkey_sucursal() {
	if ( defined( 'FM_VERSION' ) ) {
		$dir = dirname( __FILE__ ) . '/lib/';
		require_once( $dir . 'class-fm-monkey-sucursal-structures.php' );
		require_once( $dir . 'class-fm-monkeys-sucursal.php' );
	}
}
function showSucursal() {
	ob_start();
	global $post;
	$args = array(
		'post_type' => 'monkeys-sucursal',
		'posts_per_page' => 10,
		'no_found_rows' => true,
		'post_status' => 'publish',
	);
	$sucursal = new WP_Query( $args );
	if ( $sucursal->have_posts() ):
		$html = '';
		while( $sucursal->have_posts() ):
			$sucursal->the_post();
			$info = get_post_meta( $post->ID, 'sucursal_information', true );
			$html .=
				'<h3>' . $info[ 'nombre' ] . '</h3>
					Telefono:<br>' . $info[ 'telefono' ] . '<br>
					E-mail:<br><a href="mailto:' . $info[ 'email' ] . '">' . $info[ 'email' ] . '</a><br><br>';
		endwhile;
		echo $html;
	endif;
	wp_reset_postdata();
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_action( 'after_setup_theme', 'setup_monkey_sucursal' );
add_shortcode( 'monkeysucursal', 'showSucursal');