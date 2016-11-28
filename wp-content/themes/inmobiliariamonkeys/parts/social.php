<?php
	global $post;
	$args = array(
		'post_type' => 'monkeys-social',
		'posts_per_page' => 10,
		'no_found_rows' => true,
		'post_status' => 'publish',
	);
	$social = new WP_Query( $args );
	if ( $social->have_posts() ):
		$html = '';
		while( $social->have_posts() ):
			$social->the_post();
			$info = get_post_meta( $post->ID, 'social_information', true );
			if ( strpos( $info[ 'url' ], '@') === false ) {
				$html .= '<a href="' . $info[ 'url' ] . '" target="_blank"><i class="' . $info[ 'network' ] . '"></i></a>';
			} else {
				$html .= '<a href="mailto:' . $info[ 'url' ] . '" target="_blank"><i class="' . $info[ 'network' ] . '"></i></a>';
			}
		endwhile;
		echo $html;
	endif;
	wp_reset_postdata();