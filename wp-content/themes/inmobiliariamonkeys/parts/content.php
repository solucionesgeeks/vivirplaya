	<?php
		global $post;
		echo get_post_type( get_the_ID() );
		if ( 'servicios' == get_post_type( get_the_ID() ) ) {
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
		} else {
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
				get_the_title()
			) );
		}
		wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
	?>
