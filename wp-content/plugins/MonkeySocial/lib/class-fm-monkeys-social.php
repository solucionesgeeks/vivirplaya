<?php
if ( !class_exists( 'FM_Monkey_Social' ) ) :
	class FM_Monkey_Social {
		private static $instance;
		private function __construct() {
		}
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new FM_Monkey_Social;
				self::$instance->setup();
			}
			return self::$instance;
		}
		public function setup() {
			Monkey_Social_Structure() -> add_post_type( 'monkeys-social', array( 'singular' => 'Monkey Redes' ) );
			add_action( 'fm_post_monkeys-social', array( $this, 'init' ) );
		}
		public function init() {
			$fm = new Fieldmanager_Group( array(
				'name' => 'social_information',
				'children' => array(
					'url' => new Fieldmanager_Textfield( 'URL de la Red Social / Email de Contacto' ),
					'network' => new Fieldmanager_Select( array(
						'options' => array(
							'fa fa-facebook face' => 'Facebook',
							'fa fa-twitter twit' => 'Twitter',
							'fa fa-instagram insta' => 'Instagram',
							'fa fa-youtube youtube' => 'Youtube',
							'fa fa-envelope mail' => 'Mail',
							'fa fa-google-plus gmas' => 'Google +',
						),
					) ),
				),
			) );
			$fm->add_meta_box( 'Información de la Red Social a enlazar', 'monkeys-social' );
		}
	}
	FM_Monkey_Social::instance();
endif;