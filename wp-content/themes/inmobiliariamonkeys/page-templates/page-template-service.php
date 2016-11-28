<?php
/*
Template Name: Monkeys Inmueble Template
*/
	get_header();

	global $post;
	$args = array(
		'post_type' => 'servicios',
		'posts_per_page' => 20,
		'no_found_rows' => true,
		'post_status' => 'publish',
	);
	$serv = new WP_Query( $args );
	$colors = array( 'venta' => '#00B97B', 'preventa' => '#D26D00', 'renta' => '#FCCE00', 'renta vacacional' => '#7B16AF', 'venta y renta' => '#FF9933' );
	if ( $serv->have_posts() ):
		$servId = get_the_ID();
		$html =
			'<div class="principal ct">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8">';
		while( $serv->have_posts() ):
			$serv->the_post();
			$info = get_post_meta( $post->ID, 'service-info', true );
			$mainimage = get_the_guid( $info[ 'img-principal' ] );
			$html .=
				'<div class="row masmar">
					<div class="col-xs-12 col-sm-8 col-md-8">
						<a href="' . esc_url( get_permalink() ) . '"><h2>' . get_the_title() . '</h2></a>';
			$category = wp_get_post_terms( $post->ID, 'monkeys-location', array( 'fields' => 'names' ) );
			$type = wp_get_post_terms( $post->ID, 'monkeys-kind', array( 'fields' => 'names' ) );
			$html .= '<b>Ubicación</b>: ' . $category[0] . ' | <b>Estatus</b>: ' . $info[ 'status' ] . '<br>';
			$html .= '<p>' . substr( strip_tags( $info[ 'description' ] ), 0, 200 ) . '...</p>';
			$html .=
					'</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="imagen">
							<span style="background-color: ' . $colors[ strtolower( $info[ 'status' ] ) ] . ';">' . $info[ 'status' ] . '</span>
							<img src="' . $mainimage . '" class="fullimg">
							<div>' . $type[0] . '</div>
						</div>
					</div>
				</div>';
		endwhile;
		$html .= '</div></div>
					<div class="col-xs-12 col-sm-4 col-md-4">
					</div>
				</div>';
		echo $html;
	endif;
	wp_reset_postdata();

	get_footer();
?>