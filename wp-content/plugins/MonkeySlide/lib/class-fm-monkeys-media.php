<?php
if ( !class_exists( 'FM_Monkey_Media' ) ) :
	class FM_Monkey_Media {
		private static $instance;
		private function __construct() {
		}
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new FM_Monkey_Media;
				self::$instance->setup();
			}
			return self::$instance;
		}
		public function setup() {
			Monkey_Slide_Structure() -> add_post_type( 'monkeys-media', array( 'singular' => 'Monkey Slide' ) );
			add_action( 'fm_post_monkeys-media', array( $this, 'init' ) );
		}
		public function init() {
			$fm = new Fieldmanager_Media( array(
					'name' => 'basic_media',
					'button_label' => 'Elegir Imagen',
					'modal_title' => 'Elije la Imagen del Slide',
					'label' => 'Elije la Imagen para el Slide',
					'modal_button_label' => 'Usar imagen para Slide',
			) );
			$fm->add_meta_box( 'Imagen de Slide', 'monkeys-media' );
		}
	}
	FM_Monkey_Media::instance();
endif;