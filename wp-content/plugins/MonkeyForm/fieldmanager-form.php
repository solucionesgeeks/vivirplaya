<?php
/*
	Plugin Name: Monkey Form Manager
	Plugin URI: http://www.monkeysweb.com.mx/
	Description: Este plugin permite administrar y crear nuevos formularios
	Version: 0.1
	Author: Eduardo Lopez
	Author URI: http://www.monkeysweb.com.mx/
*/
function crearId( $cadena ) {
	$texto = strtolower( preg_replace( '[\s+]', '-', $cadena ) );
    return preg_replace( '/[^A-Za-z0-9\-]/', '', $texto );
}
function setup_monkey_form() {
	if ( defined( 'FM_VERSION' ) ) {
		$dir = dirname( __FILE__ ) . '/lib/';
		require_once( $dir . 'class-fm-monkey-form-structures.php' );
		require_once( $dir . 'class-fm-monkeys-form.php' );
	}
}
function showForm() {
	ob_start();
	global $post;
	$args = array(
		'post_type' => 'monkeys-form',
		'posts_per_page' => 10,
		'no_found_rows' => true,
		'post_status' => 'publish',
	);
	$form = new WP_Query( $args );
	if ( $form->have_posts() ):
		$formulario = 'formulario-' . get_the_ID();
		$capId = get_the_ID();
		$html = '<div class="principal"><form id="' . $formulario . '">';
		while( $form->have_posts() ):
			$form->the_post();
			$info = get_post_meta( $post->ID, 'form_fields', true );
			$forms = get_post_meta( $post->ID, 'config-data', true );
			$mail = $forms[ 'contact-mail' ];
			$i = 0;
			foreach ( $info as $field ) {
				$id = crearId( $field[ 'name-field' ] );
				if ( 0 === $i ) {
					$html .= '<div class="row">';
				}
				$class = '';
				if ( $field[ 'obligatorio' ] ) {
					$class = 'class="obligatorio"';
				}
				if ( 'textarea' === $field[ 'type-field' ] ) {
					$html .=
						'<div class="col-xs-12 col-sm-12 col-md-12">
							<span class="chico">' . $field[ 'name-field' ] . '</span>
							<textarea placeholder="' . $field[ 'name-field' ] . '" id="' . $id . '" name="' . $id . '" ' . $class . '></textarea>
						</div>';
					$i = $i + 2;
				} else {
					$html .= '<div class="col-xs-6 col-sm-6 col-md-6"><span class="chico">' . $field[ 'name-field' ] . '</span>';
						if ( 'email' === $field[ 'type-field' ] ) {
							$html .= '<input type="text" id="email" name="email" ' . $class . ' placeholder="' . $field[ 'name-field' ] . '">';
						} else {
							$html .= '<input type="text" id="' . $id . '" name="' . $id . '" ' . $class . ' placeholder="' . $field[ 'name-field' ] . '">';
						}
					$html .= '</div>';
					$i++;
				}
				if ( 2 === $i ) {
					$html .= '</div>';
					$i = 0;
				}
			}
			if ( $forms[ 'captcha' ] ) {
				$html .=
					'<script type="text/javascript">
						function captcha( cual ) {
							var aLetras = new Array( \'a\',\'b\',\'c\',\'d\',\'e\',\'f\',\'g\',\'h\',\'i\',\'j\',\'k\',\'l\',\'m\',\'n\',\'o\',\'p\',\'q\',\'r\',\'s\',\'t\',\'u\',\'v\',\'w\',\'x\',\'y\',\'z\' );
							var aNumeros = new Array( \'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'0\' );
							var valor="";
							while( valor.length < 6 ) {
								valor += aLetras[ Math.floor( Math.random() * aLetras.length ) ] + aNumeros[ Math.floor( Math.random() * aNumeros.length ) ];
							}
							localStorage.setItem( \'captcha\', valor );
							$( \'#info-\' + cual ).html( valor );
							$( \'#captcha-\' + cual ).val( \'\' );
						}
						$( document ).ready( function() {
							captcha( ' . $capId . ' );
						} );
					</script>';
				$html .= '<div class="row"><div class="col-xs-12 col-sm-6 col-md-6"><input type id="captcha-' . $capId . '" placeholder="Ingresa el Código que se muestra" class="inputcaptcha"></div><div class="col-xs-12 col-sm-6 col-md-6"><div class="captcha"><span id="info-' . $capId . '"></span><i class="icon-retweet" onclick="captcha( ' . $capId . ' )"></i></div></div></div></div>';
			} else {
				$html .=
					'<script type="text/javascript">
						localStorage.setItem( \'captcha\', null );
					</script>';
			}
			$html .= '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12"><a class="boton botoncontact" onclick="enviar( \'' . $formulario . '\', \'' . $mail . '\' )">Enviar</a></div></div>';
		endwhile;
		$html .= '</form></div>';
		echo $html;
	endif;
	wp_reset_postdata();
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_action( 'after_setup_theme', 'setup_monkey_form' );
add_shortcode( 'monkeyform', 'showForm');