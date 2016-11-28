<?php
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