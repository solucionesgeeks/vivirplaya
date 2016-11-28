<?php
/*
	Plugin Name: Monkey Service Manager
	Plugin URI: http://www.monkeysweb.com.mx/
	Description: Este plugin permite administrar y crear nuevos Servicios
	Version: 0.1
	Author: Eduardo Lopez
	Author URI: http://www.monkeysweb.com.mx/
*/
function create_location_taxonomies() {
	$labels = array(
		'name'              => 'Ubicacion',
		'singular_name'     => 'Ubicacion',
		'search_items'      => 'Busca Ubicacion',
		'all_items'         => 'Todas las Ubicaciones',
		'parent_item'       => 'Parent Location',
		'parent_item_colon' => 'Parent Location',
		'edit_item'         => 'Edita Ubicación',
		'update_item'       => 'Actualiza Ubicación',
		'add_new_item'      => 'Agrega Ubicación',
		'new_item_name'     => 'Nombre de nueva ubicación',
		'menu_name'         => 'Ubicaciones',
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);
	register_taxonomy( 'monkeys-location', array( 'servicios' ), $args );
}
function create_kind_taxonomies() {
	$labels = array(
		'name'              => 'Tipo de Inmueble',
		'singular_name'     => 'Tipo de Inmueble',
		'search_items'      => 'Busca Tipo de Inmueble',
		'all_items'         => 'Todas los Tipos de Inmueble',
		'parent_item'       => 'Parent Kind',
		'parent_item_colon' => 'Parent Kind',
		'edit_item'         => 'Edita Tipo de Inmueble',
		'update_item'       => 'Actualiza Tipo de Inmueble',
		'add_new_item'      => 'Agrega Tipo de Inmueble',
		'new_item_name'     => 'Nombre de nuevo Tipo de Inmueble',
		'menu_name'         => 'Tipos de Inmuebles',
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);
	register_taxonomy( 'monkeys-kind', array( 'servicios' ), $args );
}
function setup_monkey_service() {
	if ( defined( 'FM_VERSION' ) ) {
		$dir = dirname( __FILE__ ) . '/lib/';
		require_once( $dir . 'class-fm-monkey-service-structures.php' );
		require_once( $dir . 'class-fm-monkeys-service.php' );
	}
	add_action( 'init', 'create_location_taxonomies', 0 );
	add_action( 'init', 'create_kind_taxonomies', 0 );
}

function showService() {
	ob_start();
	global $post;
	$args = array(
		'post_type' => 'servicios',
		'posts_per_page' => 20,
		'no_found_rows' => true,
		'post_status' => 'publish',
	);
	$serv = new WP_Query( $args );
	if ( $serv->have_posts() ):
		$servId = get_the_ID();
		$html = '<div class="principal ct"><div class="row"><div class="spadleft col-xs-12 col-sm-8 col-md-8">';
		while( $serv->have_posts() ):
			$serv->the_post();
			$info = get_post_meta( $post->ID, 'service-info', true );
			$html .= '<h2>' . get_the_title() . '</h2>';
			$mainimage = get_the_guid( $info[ 'img-principal' ] );
			$html .= '<div class="spadleft col-xs-12 col-sm-12 col-md-12"><img src="' . $mainimage . '" class="fullimg"></div>';
			if ( sizeof( $gallery ) > 0 ) {
				$html .= '<div class="spadleft col-xs-12 col-sm-12 col-md-12"><h3>Imágenes Exclusivas</h3>';
				foreach ( $gallery as $imagen ) {
					$imggal = get_the_guid( $imagen[ 'img-gallery' ] );
					$html .= '<div class="spadleft col-xs-12 col-sm-3 col-md-3"><img src="' . $imggal . '" class="fullimg"></div>';
				}
				$html .= '</div>';
			}
			$html .= '<div class="spadleft col-xs-12 col-sm-12 col-md-12"><h3>Detalles</h3><p>' . $info[ 'description' ] . '</p></div>';
			if ( '1' === $info[ 'video' ] ) {
				$html .= '<div class="spadleft col-xs-12 col-sm-4 col-md-4 mtopmini">';
				$video = '<div class="spadleft col-xs-12 col-sm-8 col-md-8 mtopmini">';
				if ( 'youtube' === $info[ 'tvideo' ] ) {
					$video .= '<iframe src="https://www.youtube.com/embed/' . $info[ 'idvideo' ] . '" class="video"></iframe>';
				} else {
					$video .= '<iframe src="https://player.vimeo.com/video/' . $info[ 'idvideo' ] . '?byline=0&potrait=0" class="video"></iframe>';
				}
				$video .= '</div>';
			} else {
				$html .= '<div class="spadleft col-xs-12 col-sm-12 col-md-12 mtopmini">';
				$video = '';
			}
			$category = wp_get_post_terms( $post->ID, 'monkeys-location', array( 'fields' => 'names' ) );
			$html .= '<b>Ubicación</b>: ' . $category[0] . '<br>';
			$html .= '<b>Estatus</b>: ' . $info[ 'status' ] . '<br>';
			$html .= '<b>Año de Construccion</b>: ' . $info[ 'year' ] . '<br>';
			$html .= '<b>Número de Pisos</b>: ' . $info[ 'floor' ] . '<br>';
			$type = wp_get_post_terms( $post->ID, 'monkeys-kind', array( 'fields' => 'names' ) );
			$html .= '<b>Tipo de Propiedad</b>: ' . $type[0] . '<br>';
			$html .= '<b>ID Propiedad</b>: ' . $info[ 'id' ] . '<br>';
			$html .= '<b>Recamaras</b>: ' . $info[ 'rooms' ] . '<br>';
			$html .= '<b>Numero de Unidades</b>: ' . $info[ 'units' ] . '<br>';
			$html .= '</div>' . $video;
			if ( sizeof( $comodities ) > 0 ) {
				$html .= '<div class="spadleft col-xs-12 col-sm-12 col-md-12"><h3>Imágenes Exclusivas</h3>';
				foreach ( $comodities as $comodidades ) {
					$html .= '<div class="spadleft col-xs-12 col-sm-4 col-md-4"><div class="comodidades"><i class="fa fa-check"></i>' . $comodidades[ 'comodidad' ] . '</div></div>';
				}
				$html .= '</div>';
			}
			if ( '' !== $info[ 'map' ] ) {
				$html .=
					'<div class="spadleft col-xs-12 col-sm-12 col-md-12">
						<h3>Ubicación</h3>
						<iframe src="' . $info[ 'map' ] . '" class="mapa"></iframe>
					</div>';
			}
		endwhile;
		$html .= '</div></div></div>';
		echo $html;
	endif;
	wp_reset_postdata();
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_action( 'after_setup_theme', 'setup_monkey_service' );
add_shortcode( 'monkeyservice', 'showService');
add_filter('single_template', 'showService');